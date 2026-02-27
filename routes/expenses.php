<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;

Route::middleware(['auth', 'check-banned'])
    ->controller(ExpenseController::class)
    ->prefix('expenses')
    ->name('expenses.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::delete('/{expense}', 'destroy')->name('destroy');
        Route::post('/{payment}/mark-as-paid', 'markAsPaid')->name('mark-as-paid');
    });
