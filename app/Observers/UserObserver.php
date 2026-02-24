<?php

namespace App\Observers;

use App\Enums\UserRole;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if(User::count() === 1) {
            $user->role = UserRole::ADMIN;
            $user->save();
        }
    }
}
