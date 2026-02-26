<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'check-banned'])
    ->controller(CategoryController::class)
    ->prefix('categories')
    ->name('categories.')
    ->group(function () {
        Route::post('/', 'store')->name('store');
        Route::delete('/{category}', 'destroy')->name('destroy');
    });
