<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'paid_at',
        'expense_id',
        'user_id',
    ];

    protected $appends = [
        'is_paid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'float',
        'paid_at' => 'datetime',
    ];

    // Accessors
    public function isPaid(): Attribute
    {
        return Attribute::get(fn() => $this->paid_at !== null);
    }

    // Relationships
    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    #[Scope]
    protected function unpaid(Builder $query): void
    {
        $query->whereNull('paid_at')
            ->with(['expense.payer', 'user'])
        ;
    }

    //  Methods
    public static function totalUnpaidExpenses(): float
    {
        return self::whereNull('paid_at')->sum('amount');
    }

    public static function totalUnpaidExpensesByUser(User $user): float
    {
        return self::whereNull('paid_at')->where('user_id', $user->id)->sum('amount');
    }

    public static function totalUnpaidExpensesByPayer(User $payer): float
    {
        return self::whereNull('paid_at')
            ->whereRelation('expense', 'user_id', $payer->id)
            ->sum('amount');
    }
}
