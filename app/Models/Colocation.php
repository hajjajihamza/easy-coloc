<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ColocationStatus;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Colocation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'owner_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => ColocationStatus::class,
    ];

    // Relationships
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'memberships')
                    ->using(Membership::class)
                    ->withPivot('joined_at', 'left_at', 'role')
            ;
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }
}
