<?php

namespace App\Http\Controllers\Auth;

use App\Enums\InvitationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        $invitation = null;
        if ($request->filled('token'))
        {
            $invitation = Invitation::where('token', $request->token)->firstOrFail();
        }
        return view('auth.register', compact('invitation'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        if ($request->filled('token')) {
            $invitation = Invitation::where('token', $request->token)->firstOrFail();
            $user->colocations()->syncWithoutDetaching([
                $invitation->colocation_id => [
                    'joined_at' => now()
                ]
            ]);

            $invitation->update([
                'status' => InvitationStatus::ACCEPTED
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
