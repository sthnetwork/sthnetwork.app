<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Mikrotik;
use App\Models\Package;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->get();

        return view('customers.index', [
            'customers' => $customers,
            'title' => 'Pelanggan',
            'sub_title' => 'Daftar Pelanggan ISP',
        ]);
    }
    public function create()
{
    $mikrotiks = \App\Models\Mikrotik::all();
    $packages = \App\Models\Package::all(); // pastikan ada model Package

    return view('customers.create', compact('mikrotiks', 'packages'));
}

    // method lainnya nanti di sini (create, store, edit, update, destroy)
}

