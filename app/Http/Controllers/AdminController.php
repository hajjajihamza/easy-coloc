<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function (Builder $q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->whereNull('banned_at');
            } elseif ($request->status === 'banned') {
                $query->whereNotNull('banned_at');
            }
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.dashboard', compact(
            'users'
        ));
    }

    public function ban(User $user): RedirectResponse
    {
        if ($user->is_admin) {
            return back()->with('error', 'Vous ne pouvez pas bannir un administrateur.');
        }

        $user->update(['banned_at' => now()]);

        return back()->with('success', "L'utilisateur {$user->name} a été banni.");
    }

    public function unban(User $user): RedirectResponse
    {
        $user->update(['banned_at' => null]);

        return back()->with('success', "L'utilisateur {$user->name} a été débanni.");
    }
}
