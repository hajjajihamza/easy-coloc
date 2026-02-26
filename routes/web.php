<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'check-banned'])
    ->name('dashboard');

Route::get('/banned', static function () {
    return view('auth.banned');
})->middleware(['auth'])->name('banned');


require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
require __DIR__.'/admin.php';
require __DIR__.'/colocation.php';
require __DIR__.'/invitation.php';
require __DIR__.'/category.php';
