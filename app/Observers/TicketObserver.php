<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketNotification;
use Illuminate\Support\Facades\Notification;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        //
        $user = auth()->user();
        $usersToNotify = User::role('manager')->get(); // Example: notify Managers
        Notification::send($usersToNotify, new TicketNotification($ticket, 'created'));
        Log::create([
            'action' => 'Created Ticket',
            'description' => "User {$user->name} created a ticket with ID {$ticket->id}",
            'user_id' => $user->id,
        ]);
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        //
        $updatedFields = $ticket->getDirty();
        $admins = User::role('admin')->get(); // Collection of admins
        $driver = $ticket->driver?->user;    // Single user instance or null

        $usersToNotify = $driver
            ? $admins->merge(collect([$driver]))
            : $admins; // Combine admins with the driver if it exists


        foreach ($updatedFields as $updatedFieldName => $updatedFieldValue) {
            $notified = false;
            if ($updatedFieldName === 'attorney_id') {
                Notification::send($usersToNotify, new TicketNotification($ticket, 'assigned'));
                $notified = true;
            }

            if ($updatedFieldName === 'indicator') {
                Notification::send($usersToNotify, new TicketNotification($ticket, 'status_updated'));
                $notified = true;
            }

            if ($updatedFieldName === 'attorney_response') {
                Notification::send($usersToNotify, new TicketNotification($ticket, 'status_updated'));
                $notified = true;
            }
            if (!$notified) {
                Notification::send($usersToNotify, new TicketNotification($ticket, 'updated'));
            }
        }
    }

    /**
     * Handle the Ticket "deleted" event.
     */
    public function deleted(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "restored" event.
     */
    public function restored(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "force deleted" event.
     */
    public function forceDeleted(Ticket $ticket): void
    {
        //
    }
}
