<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->name('admin.')
    ->prefix('admin')
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::post('/users/{user}/ban', 'ban')->name('users.ban');
        Route::post('/users/{user}/unban', 'unban')->name('users.unban');
});
