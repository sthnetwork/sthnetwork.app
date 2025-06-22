<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mikrotik;
use App\Models\VpnAccount;
use RouterOS\Client;
use Exception;

class MikrotikController extends Controller
{
    /**
     * Tampilkan semua router Mikrotik dengan status koneksi.
     */
    public function index()
    {
        $mikrotiks = Mikrotik::orderBy('cluster')->get()->map(function ($router) {
            try {
                $client = $this->connectToRouter($router);
                $router->status_koneksi = true;
            } catch (Exception $e) {
                $router->status_koneksi = false;
            }
            return $router;
        });

        $routers = $mikrotiks;

        return view('pages.mikrotik.index', compact('routers'));
    }

    /**
     * Form tambah router.
     */
    public function create()
    {
        $availableVpnIps = VpnAccount::whereNull('mikrotik_id')
            ->whereNotNull('ip_address')
            ->where('status', 'active')
            ->pluck('username', 'ip_address');

        return view('pages.mikrotik.create', compact('availableVpnIps'));
    }

    /**
     * Simpan router baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'router_name' => 'required|string',
            'ip_address'  => 'required|ip',
            'port_api'    => 'required|numeric',
            'username'    => 'required|string',
            'password'    => 'required|string',
            'cluster'     => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        $router = Mikrotik::create($request->all());

        VpnAccount::where('ip_address', $request->ip_address)
            ->update(['mikrotik_id' => $router->id]);

        return redirect()->route('mikrotik.index')->with('success', 'Router berhasil ditambahkan.');
    }

    /**
     * Form edit router.
     */
    public function edit($id)
    {
        $mikrotik = Mikrotik::findOrFail($id);
        return view('pages.mikrotik.edit', compact('mikrotik'));
    }

    /**
     * Update router.
     */
    public function update(Request $request, $id)
    {
        $mikrotik = Mikrotik::findOrFail($id);

        $data = $request->validate([
            'router_name' => 'required|string',
            'ip_address'  => 'required|ip',
            'port_api'    => 'required|numeric',
            'username'    => 'required|string',
            'password'    => 'nullable|string',
            'cluster'     => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $mikrotik->update($data);

        return redirect()->route('mikrotik.index')->with('success', 'Router berhasil diperbarui.');
    }

    /**
     * Hapus router.
     */
    public function destroy($id)
    {
        $router = Mikrotik::findOrFail($id);
        VpnAccount::where('mikrotik_id', $router->id)->update(['mikrotik_id' => null]);
        $router->delete();
        return redirect()->route('mikrotik.index')->with('success', 'Router berhasil dihapus.');
    }

    /**
     * Tes koneksi ke Mikrotik dan kembalikan response JSON.
     */
    public function testKoneksi($id)
    {
        try {
            $router = Mikrotik::findOrFail($id);
            $client = $this->connectToRouter($router);

            return response()->json([
                'status' => 'success',
                'message' => 'Router berhasil terhubung ke API Mikrotik.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal terhubung: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fungsi privat untuk membuat koneksi ke Mikrotik.
     */
    private function connectToRouter($router)
    {
        return new Client([
            'host'    => $router->ip_address,
            'user'    => $router->username,
            'pass'    => $router->password,
            'port'    => (int)($router->port_api ?? 8728),
            'timeout' => 3,
        ]);
    }
}

