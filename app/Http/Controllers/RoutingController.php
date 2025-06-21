<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoutingController extends Controller
{
    public function __construct()
    {
        // Middleware sudah diterapkan via route group di web.php
    }

    /**
     * Halaman utama dashboard (root)
     */
    public function index(Request $request)
    {
        return view('index', [
            'title' => 'Dashboard',
            'sub_title' => 'Menu',
            'sidenav' => 'hover',
            'mode' => $request->query('mode'),
            'demo' => $request->query('demo')
        ]);
    }

    /**
     * Route satu level
     */
    public function root(Request $request, $first)
    {
        $mode = $request->query('mode');
        $demo = $request->query('demo');

        // Redirect jika ada permintaan ke folder assets
        if ($first === "assets") {
            return redirect('/');
        }

        // Redirect khusus untuk /home ke index view
        if ($first === "home") {
            return $this->index($request);
        }

        return view($first, [
            'mode' => $mode,
            'demo' => $demo,
            'title' => ucfirst($first),
            'sub_title' => '',
            'sidenav' => 'hover'
        ]);
    }

    /**
     * Route dua level
     */
    public function secondLevel(Request $request, $first, $second)
    {
        $mode = $request->query('mode');
        $demo = $request->query('demo');

        if ($first === "assets") {
            return redirect('/');
        }

        return view("$first.$second", [
            'mode' => $mode,
            'demo' => $demo,
            'title' => ucfirst($second),
            'sub_title' => ucfirst($first),
            'sidenav' => 'hover'
        ]);
    }

    /**
     * Route tiga level
     */
    public function thirdLevel(Request $request, $first, $second, $third)
    {
        $mode = $request->query('mode');
        $demo = $request->query('demo');

        if ($first === "assets") {
            return redirect('/');
        }

        return view("$first.$second.$third", [
            'mode' => $mode,
            'demo' => $demo,
            'title' => ucfirst($third),
            'sub_title' => ucfirst($second),
            'sidenav' => 'hover'
        ]);
    }
}

