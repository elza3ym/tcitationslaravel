<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Str;

class Ticket extends Model
{
    protected $fillable = [
        'user_email',
        'name',
        'company_id',
        'city',
        'state',
        'zip',
        'address',
        'indicator',
        'class_commercial',
        'road_side_inspection',
        'date_issued',
        'vehicle_lic_no',
        'violation_id',
        'citation_no',
        'ticket_type',
        'court_name',
        'court_date',
        'court_address',
        'attorney_id',
        'attorney_response',
        'processor_name',
        'processor_email',
        'processor_ph_number',
        'processor_notes_to_attorney',
    ];

    //
    public const INDICATOR_SENT_TO_ATTORNEY = 'Sent to Attorney';
    public const INDICATOR_RECEIVED = 'Received';
    public const INDICATOR_CONTINUED = 'Continued';
    public const INDICATOR_DISPOSED = 'Disposed';
    public const INDICATOR_CANCELLED = 'Canceled';
    public const INDICATOR_ASSIGNED_TO_ATTORNEY = 'Attorney Assigned';

    public const INDICATORS_ALLOWED = [
        self::INDICATOR_SENT_TO_ATTORNEY,
        self::INDICATOR_RECEIVED,
        self::INDICATOR_CONTINUED,
        self::INDICATOR_DISPOSED,
        self::INDICATOR_CANCELLED,
        self::INDICATOR_ASSIGNED_TO_ATTORNEY
    ];
    public const ATTORENY_RESPONSE_ACCEPTED = 'Accepted';
    public const ATTORENY_RESPONSE_REJECTED = 'Rejected';

    public const TICKET_STATUS_OPEN = 1;
    public const TICKET_STATUS_CLOSED = 2;
    public const TICKET_STATUS_ARCHIVED = 0;

    public function company() {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function driver(): HasOneThrough
    {
        return $this->hasOneThrough(
            Driver::class,  // Final model
            User::class,    // Intermediary model
            'email',        // Foreign key on the User table (matches Ticket.user_email)
            'id',           // Foreign key on the Driver table (matches User.userable_id)
            'user_email',   // Local key on the Ticket table
            'roleable_id'   // Local key on the User table (Driver's morphable ID)
        )->where('users.roleable_type', Driver::class); // Ensure morph type matches Driver
    }

    public function isDverDataq() {
        $dver = false;
        $dataq = false;
        foreach ($this->attachments as $attachment) {
            $dataq = $dataq ?: Str::contains($attachment->filename, 'dataq', ignoreCase: true);
            $dver = $dver ?: Str::contains($attachment->filename, 'dver', ignoreCase: true);
        }
        return ["DVER" => $dver, "DATAQ" => $dataq];
    }

    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }
    public function notes()
    {
        return $this->hasMany(TicketNote::class);
    }

    public function attorney() {
        return $this->belongsTo(Attorney::class, 'attorney_id', 'id');
    }

    public function violation()
    {
        return $this->belongsTo(Violation::class);
    }

    public function scopeFilter($query, $filters) {
        return $filters->apply($query);
    }

    public function scopeFilterByRole(Builder $query, $currentUser)
    {
        if ($currentUser->hasRole('admin')) {
            // Admin: No filtering needed
            return $query;
        }  elseif ($currentUser->hasRole('manager')) {
            // Manager: Filter by associated companies
            return $query->whereHas('company', function ($q) use ($currentUser) {
                $q->whereIn('id', $currentUser->roleable->companies->pluck('id')->toArray());
            });
        } elseif ($currentUser->hasRole('attorney')) {
            return $query->where('attorney_id', $currentUser->roleable->id);
        } elseif ($currentUser->hasRole('driver')) {
            $query->whereHas('driver', function ($q) use ($currentUser){
                $q->whereHas('user', function($userQuery) use ($currentUser) {
                    $userQuery->where('email', $currentUser->email);
                });
            });
        }
    }
}
