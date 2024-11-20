<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['company_id'];
    //
    public function user()
    {
        return $this->morphOne(User::class, 'roleable');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
