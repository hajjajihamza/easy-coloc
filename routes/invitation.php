<?php

use App\Http\Controllers\InvitationController;

Route::middleware('guest')
    ->controller(InvitationController::class)
    ->prefix('invitations')
    ->name('invitations.')
    ->group(function () {
        Route::get('/{token}/accept', 'accept')->name('accept');
        Route::get('/{token}/reject', 'reject')->name('reject');
    });
