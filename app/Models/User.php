<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use App\Enums\UserRole;
use Illuminate\Support\Str;

class User extends Authenticatable implements FilamentUser
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
        'role',
        'is_active',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'is_active' => 'boolean'
        ];
    }

    protected static function booted(): void
    {
        static::created(function (User $user) {
            // Generate a unique key and save it to the user
            $user->api_key = Str::random(40);
            $user->save();

            $user->userPlan()->create([
                'user_id' => $user->id,
                'plan_id' => 1, // FREE plan by default
            ]);
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }


    public function userPlan()
    {
        return $this->hasOne(UserPlan::class, 'user_id');
    }


    public function usage()
    {
        return $this->hasMany(Usage::class);
    }
}
