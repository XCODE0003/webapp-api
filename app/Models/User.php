<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function getU() {}
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
    protected $fillable = [
        'id',
        'name',
        'firstName',
        'avatar',
        'balance',
        'balance_donat',
        'last_login',
        'click_level',
        'autobot_level',
        'recharging_level',
        'last_bonus',
        'ref_id',
        'free_spins',
        'autoclaim_bonus',
        'last_spin',
        'energy',
        'email',
        'password',

    ];



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'last_login' => 'datetime',
            'last_bonus' => 'datetime',
            'click_level' => 'integer',
            'autobot_level' => 'integer',
            'recharging_level' => 'integer',
            'last_give_spins' => 'datetime',
        ];
    }
}
