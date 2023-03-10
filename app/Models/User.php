<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN              = 'admin';
    const ROLE_COMPANY_DIRECTOR   = 'company_director';

    const PLACED_IN_BALI  = 'bali';
    const PLACED_IN_AMBON = 'ambon';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'placed_in',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        if (!$value) {
            return;
        }

        $this->attributes['password'] = Hash::make($value);
    }

    public function isInBali()
    {
        return in_array($this->placed_in, [self::PLACED_IN_BALI]);
    }

    public function isInAmbon()
    {
        return in_array($this->placed_in, [self::PLACED_IN_AMBON]);
    }

    public function isAdmin()
    {
        return in_array($this->role, [self::ROLE_ADMIN]);
    }

    public function isDirector()
    {
        return in_array($this->role, [self::ROLE_COMPANY_DIRECTOR]);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeWhereAdmin($query)
    {
        $query->where('role', self::ROLE_ADMIN);
    }
}
