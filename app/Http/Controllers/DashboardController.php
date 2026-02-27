<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $colocation = auth()->user()->activeColocation();
        $categories = $colocation ? $colocation->categories : collect();
        return view('dashboard', compact('colocation', 'categories'));
    }
}
