<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'ct_email',
        'ct_fname',
        'ct_lname',
        'dot',
        'sf_id',
    ];
    public function user()
    {
        return $this->morphOne(User::class, 'roleable');
    }

    public function managers()
    {
        return $this->belongsToMany(Manager::class)
            ->withPivot('is_write_access')
            ->withTimestamps();
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function contacts() {
        return $this->hasMany(CompanyContact::class);
    }
}
