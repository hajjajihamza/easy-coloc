<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $colocation = auth()->user()->activeColocation();
        return view('dashboard', compact('colocation'));
    }
}
