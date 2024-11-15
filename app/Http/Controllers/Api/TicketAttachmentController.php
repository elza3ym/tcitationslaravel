<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketAttachmentController extends Controller
{
    use AuthorizesRequests;
    //
    public function store(Request $request, Ticket $ticket) {
        $this->authorize('update', $ticket);

        $request->validate([
            'file' => 'required|max:10000|mimes:doc,docx,pdf,png,jpg'
        ]);

        $file = $request->file('file');
        $path = Storage::disk('public')->put('documents', $request->file('file'));

        return $ticket->attachments()->create([
            'filename' => $file->getClientOriginalName(),
            'path' => Storage::url($path)
        ]);
    }
}
