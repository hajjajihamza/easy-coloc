<?php

namespace App\Http\Controllers;

use App\Enums\InvitationStatus;
use App\Enums\MembershipRole;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function accept(string $token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        if ($invitation->status !== InvitationStatus::PENDING) {
            $message = ['error', 'Invitation déjà acceptée ou rejetée.'];
            return view('invitation', compact('message'));
        }

        $user = User::where('email', $invitation->email)->first();
        if ($user) {
            $user->colocations()->syncWithoutDetaching([
                $invitation->colocation_id => [
                    'joined_at' => now()
                ]
            ]);

            $invitation->update([
                'status' => InvitationStatus::ACCEPTED
            ]);

            $message = ['success', 'Invitation acceptée avec succès.'];
            return view('invitation', compact('message'));
        }

        return redirect()->route('register', ['token' => $token]);
    }

    public function reject(string $token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        if ($invitation->status !== InvitationStatus::REJECTED) {
            $invitation->update([
                'status' => InvitationStatus::REJECTED,
            ]);
        }

        $message = ['success', 'Invitation rejetée avec succès.'];
        return view('invitation', compact('message'));
    }
}
