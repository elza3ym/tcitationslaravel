<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attorney extends Model
{
    protected $fillable = ['office_hours_start', 'office_hours_end'];

    public function user()
    {
        return $this->morphOne(User::class, 'roleable');
    }
}
