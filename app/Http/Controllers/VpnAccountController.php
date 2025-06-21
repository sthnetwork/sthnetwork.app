<?php

namespace App\Http\Controllers;

use App\Models\VpnAccount;
use App\Models\Mikrotik;
use App\Models\VpnLog;
use App\Models\VpnIpPool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RouterOS\Client;
use RouterOS\Query;

class VpnAccountController extends Controller
{
    public function index()
    {
        $vpnAccounts = VpnAccount::with('mikrotik')->latest()->get();
        return view('pages.vpn.index', compact('vpnAccounts'));
    }

    public function create()
    {
        $mikrotiks = Mikrotik::all();
        return view('pages.vpn.create', compact('mikrotiks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mikrotik_id' => 'nullable|exists:mikrotiks,id',
            'username'    => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $full = $value . '@sthnetwork';
                    if (VpnAccount::where('username', $full)->exists()) {
                        $fail('Username sudah digunakan.');
                    }
                },
            ],
            'password'    => 'required|string',
            'vpn_type'    => 'required|in:L2TP,PPTP,SSTP',
        ]);

        // Ambil IP dari pool
        $ipPool = VpnIpPool::where('used', false)->first();
        if (!$ipPool) {
            return back()->with('error', 'IP pool habis. Silakan tambahkan IP baru.');
        }

        $assignedIp = $ipPool->ip_address;
        $username = $request->username . '@sthnetwork';
        $script   = $this->generateScript($username, $request->password, $request->vpn_type);

        try {
            $client = new Client([
                'host' => env('VPN_SERVER'),
                'user' => env('VPN_USER'),
                'pass' => env('VPN_PASS'),
                'port' => (int) env('VPN_PORT', 8282),
            ]);

            // Tambahkan ke Mikrotik CHR
            $client->query((new Query('/ppp/secret/add'))
                ->equal('name', $username)
                ->equal('password', $request->password)
                ->equal('service', strtolower($request->vpn_type))
                ->equal('profile', 'default-encryption')
                ->equal('remote-address', $assignedIp)
            )->read();
        } catch (\Exception $e) {
            \Log::error('Gagal koneksi CHR: ' . $e->getMessage());
            return back()->with('error', 'Gagal koneksi ke CHR: ' . $e->getMessage());
        }

        $vpn = VpnAccount::create([
            'mikrotik_id' => $request->mikrotik_id,
            'username'    => $username,
            'password'    => Crypt::encryptString($request->password),
            'vpn_type'    => $request->vpn_type,
            'script'      => $script,
            'ip_address'  => $assignedIp,
            'status'      => 'active',
        ]);

        $ipPool->used = true;
        $ipPool->save();

        VpnLog::create([
            'vpn_account_id' => $vpn->id,
            'action' => 'created',
            'ip_address' => $assignedIp,
        ]);

        return redirect()->route('vpn.index')->with('success', 'Akun VPN berhasil dibuat.');
    }

    public function edit($id)
    {
        $vpn = VpnAccount::findOrFail($id);
        return view('pages.vpn.edit', compact('vpn'));
    }

    public function update(Request $request, VpnAccount $vpn)
    {
        $request->validate([
            'password' => 'required|string',
            'status'   => 'required|in:active,inactive',
        ]);

        $vpn->password = Crypt::encryptString($request->password);
        $vpn->status   = $request->status;
        $vpn->save();

        VpnLog::create([
            'vpn_account_id' => $vpn->id,
            'action' => 'updated',
            'ip_address' => $vpn->ip_address,
        ]);

        // Auto Disconnect jika dinonaktifkan
        if ($vpn->status === 'inactive') {
            try {
                $client = new Client([
                    'host' => env('VPN_SERVER'),
                    'user' => env('VPN_USER'),
                    'pass' => env('VPN_PASS'),
                    'port' => (int) env('VPN_PORT', 8282),
                ]);

                $query = new Query('/ppp/active/print');
                $query->where('name', $vpn->username);
                $activeSessions = $client->query($query)->read();

                if (!empty($activeSessions)) {
                    $activeId = $activeSessions[0]['.id'];
                    $client->query((new Query('/ppp/active/remove'))->equal('.id', $activeId))->read();

                    VpnLog::create([
                        'vpn_account_id' => $vpn->id,
                        'action' => 'disconnected',
                        'ip_address' => $vpn->ip_address,
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('Gagal disconnect VPN user ' . $vpn->username . ': ' . $e->getMessage());
            }
        }

        return redirect()->route('vpn.index')->with('success', 'Akun VPN berhasil diperbarui');
    }

    public function destroy($id)
    {
        $vpn = VpnAccount::findOrFail($id);

        VpnLog::create([
            'vpn_account_id' => $vpn->id,
            'action' => 'deleted',
            'ip_address' => $vpn->ip_address,
        ]);

        // Kembalikan IP ke pool
        VpnIpPool::where('ip_address', $vpn->ip_address)->update(['used' => false]);

        try {
            $client = new Client([
                'host' => env('VPN_SERVER'),
                'user' => env('VPN_USER'),
                'pass' => env('VPN_PASS'),
                'port' => (int) env('VPN_PORT', 8282),
            ]);

            $secrets = $client->query(
                (new Query('/ppp/secret/print'))->where('name', $vpn->username)
            )->read();

            if (!empty($secrets) && isset($secrets[0]['.id'])) {
                $client->query(
                    (new Query('/ppp/secret/remove'))->equal('.id', $secrets[0]['.id'])
                )->read();
            }
        } catch (\Exception $e) {
            \Log::error('Gagal hapus akun di CHR: ' . $e->getMessage());
            return back()->with('error', 'Gagal hapus akun di CHR: ' . $e->getMessage());
        }

        $vpn->delete();

        return redirect()->route('vpn.index')->with('success', 'Akun VPN berhasil dihapus.');
    }

    protected function generateScript($username, $password, $type)
    {
        $server = env('VPN_SERVER', 'vpn.sthnetwork.com');
        $type   = strtolower($type);

        return "/interface {$type}-client add connect-to={$server} user={$username} password={$password} name={$username} disabled=no";
    }

    public function logs()
    {
        $logs = VpnLog::with('vpnAccount')->latest()->get();
        return view('pages.vpn.logs', compact('logs'));
    }
}

