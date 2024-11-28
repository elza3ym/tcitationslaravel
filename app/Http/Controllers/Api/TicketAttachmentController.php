<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
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

        $admins = User::role('admin')->get(); // Collection of admins
        $driver = $ticket->driver?->user;    // Single user instance or null
        $usersToNotify = $driver
            ? $admins->merge(collect([$driver]))
            : $admins; // Combine admins with the driver if it exists
        Notification::send($usersToNotify, new TicketNotification($ticket, 'document_uploaded'));

        return $ticket->attachments()->create([
            'filename' => $file->getClientOriginalName(),
            'path' => Storage::url($path)
        ]);
    }
}
