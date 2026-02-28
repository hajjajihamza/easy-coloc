<?php

use App\Http\Controllers\ColocationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'check-banned'])
    ->group(function () {
        Route::controller(ColocationController::class)
            ->prefix('colocations')
            ->name('colocations.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::put('/{colocation}', 'update')->name('update');
                Route::patch('/{colocation}/members/{user}/toggle-owner', 'toggleOwner')->name('members.toggle-owner');
                Route::delete('/{colocation}/members/{user}', 'leaving')->name('members.leaving');
                Route::get('/{colocation}', 'show')->name('show');
                Route::patch('/{colocation}', 'cancel')->name('cancel');
                Route::post('/{colocation}/invitations', 'invite')->name('invite');
            });
    });
