<?php

namespace App\Observers;

use App\Models\Expense;

class ExpenseObserver
{
    /**
     * Handle the Expense "created" event.
     */
    public function created(Expense $expense): void
    {
        $colocation = $expense->colocation;
        $amount = $expense->amount / $colocation->members->count();

        foreach ($colocation->members as $user) {
            $expense->payments()->create([
                'user_id' => $user->id,
                'amount' => $amount,
                'paid_at' => $user->id === auth()->id() ? now() : null,
            ]);
        }
    }
}
