<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    //
    public function user()
    {
        return $this->morphOne(User::class, 'roleable');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_manager');
    }
}
