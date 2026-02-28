<?php

namespace App\Models;

use App\Enums\MembershipRole;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ColocationStatus;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
    ];

    /**
     * The attributes that should be appended to the model.
     *
     * @var list<string>
     */
    protected $appends = [
        'is_owner',
        'count_members',
        'count_expenses',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => ColocationStatus::class,
    ];

    // Accessors
    protected function isOwner(): Attribute
    {
        return Attribute::get(function () {
            return $this->members->contains(function ($member) {
                return $member->id === auth()->id() && $member->pivot->role === MembershipRole::OWNER;
            });
        });
    }

    protected function isActive(): Attribute
    {
        return Attribute::get(fn() => $this->status === ColocationStatus::ACTIVE);
    }

    protected function countMembers(): Attribute
    {
        return Attribute::get(fn() => $this->members()->whereNull('left_at')->count());
    }

    protected function countExpenses(): Attribute
    {
        return Attribute::get(fn() => $this->expenses->count());
    }

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

    public function expenses(): HasManyThrough
    {
        return $this->hasManyThrough(Expense::class, Category::class);
    }

    // Scope
    #[Scope]
    protected function userColocation(Builder $query): void
    {
        $query->join('memberships', 'memberships.colocation_id', '=', 'colocations.id')
            ->where('memberships.user_id', auth()->id())
            ->select('colocations.*')
        ;
    }

    // Methods
    public static function countActiveColocations(): int
    {
        return self::where('status', ColocationStatus::ACTIVE)->count();
    }

    public function isLeavingAuth(): bool
    {
        return $this->members()
            ->wherePivot('user_id', auth()->id())
            ->wherePivotNotNull('left_at')
            ->exists();
    }

    protected function isLeavingMember(): Attribute
    {
        return Attribute::get(fn() => $this->members()->where('user_id', auth()->id())->whereNotNull('left_at')->exists());
    }
}
