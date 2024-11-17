<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dob',
        'address',
        'city',
        'state',
        'zip',
        'phone',
        'timezone',
        'notification_email',
        'notification_sms',
        'notification_push',
        'last_login_at',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roleable()
    {
        return $this->morphTo();
    }

    public function scopeFilter(Builder $query, $filters) {
        return $filters->apply($query);
    }

    public function scopeFilterByRole(Builder $query, $currentUser)
    {
        if ($currentUser->hasRole('admin')) {
            // Admin: No filtering needed
            return $query;
        }  elseif ($currentUser->hasRole('manager')) {
            // Manager: Filter by associated companies
            return $query->whereHas('roleable', function ($q) use ($currentUser) {
                $q->whereIn('id', $currentUser->companies->pluck('id')->toArray());
            });
        }
    }
}
