<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\InvitationStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'token',
        'status',
        'colocation_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => InvitationStatus::class,
    ];

    // Relationships
    public function colocation(): BelongsTo
    {
        return $this->belongsTo(Colocation::class);
    }
}
