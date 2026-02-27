<?php

namespace App\Models;

use App\Enums\ColocationStatus;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'reputation',
        'image',
        'banned_at',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be appended to the model.
     *
     * @var list<string>
     */
    protected $appends = [
        'image_url',
        'is_admin',
        'is_banned',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'banned_at' => 'datetime',
            'role' => UserRole::class,
        ];
    }

    // Accessors
    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn() => $this->image ? asset('storage/' . $this->image) : asset('images/default-user.webp'));
    }

    protected function isAdmin(): Attribute
    {
        return Attribute::get(fn() => $this->role === UserRole::ADMIN);
    }

    protected function isBanned(): Attribute
    {
        return Attribute::get(fn() => $this->banned_at !== null);
    }

    // Relationships
    public function colocations(): BelongsToMany
    {
        return $this->belongsToMany(Colocation::class, 'memberships')
                    ->using(Membership::class)
                    ->withPivot('joined_at', 'left_at', 'role')
            ;
    }

    public function activeColocation(): ?object
    {
        return $this->colocations()
            ->where('status', ColocationStatus::ACTIVE)
            ->wherePivot('left_at', null)
            ->first();
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    // Methods
    public static function countBannedUsers(): int
    {
        return self::whereNotNull('banned_at')->count();
    }
}
