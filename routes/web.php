<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MikrotikController;
use App\Http\Controllers\VpnAccountController;

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Route Area Terproteksi (Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ✅ Halaman utama dashboard (fix bug)
    Route::get('/', [RoutingController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Modul Pelanggan ISP (CRUD)
    |--------------------------------------------------------------------------
    */
    Route::resource('customers', CustomerController::class);

    /*
    |--------------------------------------------------------------------------
    | Modul Router Mikrotik
    |--------------------------------------------------------------------------
    */
    Route::get('/mikrotik/test-koneksi/{id}', [MikrotikController::class, 'testKoneksi'])->name('mikrotik.test');
    Route::resource('mikrotik', MikrotikController::class);

    /*
    |--------------------------------------------------------------------------
    | Modul VPN (L2TP, PPTP, SSTP)
    |--------------------------------------------------------------------------
    */
    Route::get('vpn/logs', [VpnAccountController::class, 'logs'])->name('vpn.logs');
    Route::resource('vpn', VpnAccountController::class);

    /*
    |--------------------------------------------------------------------------
    | Routing Dinamis Konrix (3 level)
    |--------------------------------------------------------------------------
    */
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{first}', [RoutingController::class, 'root'])->name('any');
});

