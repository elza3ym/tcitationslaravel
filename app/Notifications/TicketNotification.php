<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Ticket $ticket, public string $eventType)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): ?MailMessage
    {
        $currentUserRole = $notifiable->roles->first()->name;
        $subject = '';
        $content = '';
        $actionText = 'View Ticket';
        switch ($this->eventType) {
            case 'created':
                $subject = "New Ticket #{$this->ticket->id} Created";
                if ($notifiable->hasRole('admin')) {
                    $content = "A new ticket has been submitted by {$this->ticket->driver->name}. Ticket ID: #{$this->ticket->id}.";
                } elseif ($notifiable->hasRole('driver')) {
                    $content = "Your ticket has been created successfully. Ticket ID: #{$this->ticket->id}.";
                }
                break;

            case 'assigned':
                $subject = "Ticket #{$this->ticket->id} Assigned";
                if ($notifiable->hasRole('admin')) {
                    $content = "Ticket ID #{$this->ticket->id} has been assigned to {$this->ticket->attorney->user->name}.";
                } elseif ($notifiable->hasRole('driver')) {
                    $content = "Your ticket has been assigned to {$this->ticket->attorney->user->name}.";
                }
                break;

            case 'status_updated':
                $subject = "Ticket #{$this->ticket->id} Status Updated";
                $status = $this->ticket->indicator; // Assuming status is stored in the ticket model
                if ($notifiable->hasRole('driver')) {
                    $content = "Ticket ID #{$this->ticket->id} is now {$status}.";
                } elseif ($notifiable->hasRole('admin')) {
                    $content = "Ticket ID #{$this->ticket->id} has been changed to {$status}.";
                }
                break;

            case 'response':
                $subject = "Update on Ticket #{$this->ticket->id}";
                if ($notifiable->hasRole('driver')) {
                    $content = "An update has been added to your ticket ID #{$this->ticket->id}. Log in to view.";
                }
                break;

            case 'document_uploaded':
                $subject = "New Document Uploaded for Ticket #{$this->ticket->id}";
                if ($notifiable->hasRole('admin')) {
                    $content = "A new document has been uploaded to Ticket ID #{$this->ticket->id} by {$this->ticket->driver->name}.";
                } elseif ($notifiable->hasRole('driver')) {
                    $content = "Your uploaded document for Ticket ID #{$this->ticket->id} has been received.";
                }
                break;

            case 'resolved':
                $subject = "Ticket #{$this->ticket->id} Resolved";
                if ($notifiable->hasRole('driver')) {
                    $content = "Your ticket ID #{$this->ticket->id} has been resolved. Contact us for any further concerns.";
                }
                break;

            case 'updated':
                $subject = "Ticket #{$this->ticket->id} Updated";
                if ($notifiable->hasRole('driver')) {
                    $content = "Your ticket #{$this->ticket->id} has been updated successfully.";
                } elseif ($notifiable->hasRole('admin')) {
                    $content = "Ticket ID #{$this->ticket->id} has been updated.";
                }
                break;
        }
        if ($content) {
            return (new MailMessage)
                ->subject($subject)
                ->line($content)
                ->action($actionText, route("{$currentUserRole}.tickets.show", $this->ticket->id))
                ->line('Thank you for using our application!');
        }
        return (new MailMessage);
    }

    public function toDatabase($notifiable)
    {
        $currentUserRole = $notifiable->roles->first()->name;
        $subject = '';
        $content = '';

        switch ($this->eventType) {
            case 'created':
                $subject = "New Ticket #{$this->ticket->id} Created";
                $content = $notifiable->hasRole('admin')
                    ? "A new ticket has been submitted by {$this->ticket->driver->name}. Ticket ID: #{$this->ticket->id}."
                    : "Your ticket has been created successfully. Ticket ID: #{$this->ticket->id}.";
                break;

            case 'assigned':
                $subject = "Ticket #{$this->ticket->id} Assigned";
                $content = $notifiable->hasRole('admin')
                    ? "Ticket ID #{$this->ticket->id} has been assigned to {$this->ticket->attorney->user->name}."
                    : "Your ticket has been assigned to {$this->ticket->attorney->user->name}.";
                break;

            case 'status_updated':
                $status = $this->ticket->indicator; // Assuming status is stored in the ticket model
                $subject = "Ticket #{$this->ticket->id} Status Updated";
                $content = $notifiable->hasRole('driver')
                    ? "Ticket ID #{$this->ticket->id} is now {$status}."
                    : "Ticket ID #{$this->ticket->id} has been changed to {$status}.";
                break;

            case 'response':
                $subject = "Update on Ticket #{$this->ticket->id}";
                $content = "An update has been added to your ticket ID #{$this->ticket->id}.";
                break;

            case 'document_uploaded':
                $subject = "New Document Uploaded for Ticket #{$this->ticket->id}";
                $content = $notifiable->hasRole('admin')
                    ? "A new document has been uploaded to Ticket ID #{$this->ticket->id} by {$this->ticket->driver->name}."
                    : "Your uploaded document for Ticket ID #{$this->ticket->id} has been received.";
                break;

            case 'resolved':
                $subject = "Ticket #{$this->ticket->id} Resolved";
                $content = "Your ticket ID #{$this->ticket->id} has been resolved. Contact us for any further concerns.";
                break;

            case 'updated':
                $subject = "Ticket #{$this->ticket->id} Updated";
                $content = $notifiable->hasRole('driver')
                    ? "Your ticket #{$this->ticket->id} has been updated successfully."
                    : "Ticket ID #{$this->ticket->id} has been updated.";
                break;
        }

        return [
            'id' => $this->ticket->id,
            'title' => $subject,
            'content' => $content,
            'event' => $this->eventType,
            'url' => route("{$currentUserRole}.tickets.show", $this->ticket->id),
        ];
    }

}
