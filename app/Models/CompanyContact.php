<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'phone',
        'cell',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
