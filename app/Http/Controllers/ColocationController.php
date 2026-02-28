<?php

namespace App\Http\Controllers;

use App\Enums\ColocationStatus;
use App\Enums\MembershipRole;
use App\Http\Requests\Colocation\ColocationRequest;
use App\Mail\InvitationMail;
use App\Models\Colocation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ColocationController extends Controller
{
    public function index()
    {
        $colocations = Colocation::userColocation()->paginate(10);

        return view('colocation.index', compact('colocations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColocationRequest $request): RedirectResponse
    {
        $colocation = Colocation::create($request->validated());

        // Ajouter l'utilisateur connecté en tant qu'administrateur de la colocation
        $colocation->members()->syncWithoutDetaching([
            auth()->id() => [
                'joined_at' => now(),
                'role' => MembershipRole::OWNER,
            ],
        ]);

        return redirect()->route('colocations.show', $colocation)->with('success', 'Colocation créée avec succès');
    }

    public function update(ColocationRequest $request, Colocation $colocation): RedirectResponse
    {
        $colocation->update($request->validated());

        return redirect()->route('colocations.show', $colocation)->with('success', 'Colocation mise à jour avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Colocation $colocation)
    {
        if ($colocation->isLeavingAuth()) {
            return redirect()->route('colocations.index')->with('error', 'Vous n\'avez pas accès à cette colocation.');
        }

        return view('colocation.show', compact('colocation'));
    }

    public function cancel(Colocation $colocation): RedirectResponse
    {
        if (! $colocation->is_active) {
            return redirect()->back()->with('error', 'Colocation non active.');
        }

        if ($colocation->expenses()->whereRelation('payments', 'paid_at', null)->exists()) {
            return redirect()->back()->with('error', 'Ne pouvez pas annuler une colocation avec des dépenses non payées.');
        }

        $colocation->update([
            'status' => ColocationStatus::CANCELLED,
        ]);

        return redirect()->route('colocations.index')->with('success', 'Colocation annulée avec succès.');
    }

    public function toggleOwner(Colocation $colocation, User $user): RedirectResponse
    {
        $colocation->members()
            ->newPivotQuery()
            ->where('role', MembershipRole::OWNER)
            ->update([
                'role' => MembershipRole::MEMBER,
            ]);

        $colocation->members()->updateExistingPivot($user->id, [
            'role' => MembershipRole::OWNER,
        ]);

        return redirect()->route('colocations.show', $colocation)->with('success', 'Le propriétaire de la colocation a mis à jour avec succès.');
    }

    public function leaving(Colocation $colocation, User $user): RedirectResponse
    {
        $user->payments()
            ->whereNull('paid_at')
            ->get()
            ->each(function ($payment) {
                $payment->update(array_merge(
                    ['user_id' => auth()->id()],
                    $payment->expense->user_id === auth()->id() ? ['paid_at' => now()] : []
                ));
            });

        $colocation->members()->updateExistingPivot($user->id, [
            'left_at' => now(),
        ]);

        return redirect()->route('colocations.show', $colocation)->with('success', 'Colocation quitte avec succès.');
    }

    public function invite(Request $request, Colocation $colocation)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $token = time().Str::random(60).Str::uuid();
        $invitation = $colocation->invitations()->create([
            'email' => $request->email,
            'token' => $token,
        ]);

        Mail::to($request->email)->send(new InvitationMail($invitation));

        return redirect(route('colocations.show', $colocation))->with('success', 'Invitation envoyée avec succès.');
    }
}
