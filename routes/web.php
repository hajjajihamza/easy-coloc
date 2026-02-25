<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'check-banned'])->name('dashboard');

Route::get('/banned', function () {
    return view('auth.banned');
})->middleware(['auth'])->name('banned');


require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
require __DIR__.'/admin.php';
