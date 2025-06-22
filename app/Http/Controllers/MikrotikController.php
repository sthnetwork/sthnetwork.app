<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mikrotik;
use App\Models\VpnAccount;
use RouterOS\Client;
use RouterOS\Query;
use Throwable;

class MikrotikController extends Controller
{
    public function index()
    {
        $routers = Mikrotik::orderBy('cluster')->paginate(10); // gunakan paginate()

        // tambahkan status koneksi manual
        foreach ($routers as $router) {
            try {
                $this->connectToRouter($router);
                $router->status_koneksi = true;
            } catch (Throwable $e) {
                $router->status_koneksi = false;
            }
        }

        return view('pages.mikrotik.index', compact('routers'));
    }

    public function create()
    {
        $availableVpnIps = VpnAccount::whereNull('mikrotik_id')
            ->whereNotNull('ip_address')
            ->where('status', 'active')
            ->pluck('username', 'ip_address');

        return view('pages.mikrotik.create', compact('availableVpnIps'));
    }

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

    public function edit($id)
    {
        $mikrotik = Mikrotik::findOrFail($id);
        return view('pages.mikrotik.edit', compact('mikrotik'));
    }

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

    public function destroy($id)
    {
        $router = Mikrotik::findOrFail($id);
        VpnAccount::where('mikrotik_id', $router->id)->update(['mikrotik_id' => null]);
        $router->delete();
        return redirect()->route('mikrotik.index')->with('success', 'Router berhasil dihapus.');
    }

    public function testKoneksi($id)
    {
        try {
            $router = Mikrotik::findOrFail($id);
            $client = $this->connectToRouter($router);
            $client->connect();

            logger()->info('Berhasil terhubung ke router ' . $router->ip_address);

            // Tes ringan ke router
            $query = new Query('/system/resource/print');
            $response = $client->query($query)->read();

            logger()->info('Hasil query:', $response);

            return response()->json([
                'status' => true,
                'message' => 'Router berhasil terhubung ke API Mikrotik.',
            ]);
        } catch (Throwable $e) {
            logger()->error('Gagal koneksi Mikrotik', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => false,
                'message' => 'Gagal koneksi: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function connectToRouter($router)
    {
        return new Client([
            'host'    => $router->ip_address,
            'user'    => $router->username,
            'pass'    => $router->password,
            'port'    => $router->port_api ?: env('VPN_PORT', 8728),
            'timeout' => 3,
        ]);
    }
}

