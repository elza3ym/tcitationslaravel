<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    //
    protected $fillable = ['filename', 'path'];
    public function ticket() {
        $this->belongsTo(Ticket::class);
    }
}
