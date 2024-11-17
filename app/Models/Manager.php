<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    //
    public function user() {
        return $this->morphOne(User::class, 'roleable');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)
            ->withPivot('is_write_access')
            ->withTimestamps();
    }

    public function companyPermissions()
    {
        return $this->hasMany(CompanyManagerPermission::class, 'manager_id');
    }
}
