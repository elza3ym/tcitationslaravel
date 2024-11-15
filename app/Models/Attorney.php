<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attorney extends Model
{
    public function user()
    {
        return $this->morphOne(User::class, 'roleable');
    }
}
