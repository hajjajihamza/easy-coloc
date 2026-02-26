<?php

namespace App\Models;

use App\Enums\MembershipRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Membership extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'colocation_id',
        'joined_at',
        'left_at',
        'role'
    ];

    /**
     * The attributes that should be appended to the model.
     *
     * @var list<string>
     */
    protected $appends = [
        'is_owner',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'joined_at' => 'datetime',
        'left_at' => 'datetime',
        'role' => MembershipRole::class,
    ];

    // Accessors
    public function isOwner(): Attribute
    {
        return Attribute::get(fn() => $this->role === MembershipRole::OWNER);
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function colocation(): BelongsTo
    {
        return $this->belongsTo(Colocation::class);
    }
}
