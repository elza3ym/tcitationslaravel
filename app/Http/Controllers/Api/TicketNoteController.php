<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketNoteController extends Controller
{
    use AuthorizesRequests;
    //
    public function store(Request $request, Ticket $ticket) {
        $this->authorize('update', $ticket);

        $request->validate([
            'note' => 'required'
        ]);

        return $ticket->notes()->create([
            'note' => request('note'),
            'user_id' => \request()->user()->id
        ]);
    }
}
