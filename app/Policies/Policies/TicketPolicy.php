<?php

namespace App\Policies\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        } else if ($user->hasRole('manager')) {
            $managerCompaniesIds = $user->roleable->companies()->pluck('companies.id')->toArray();
            return in_array($ticket->company_id, $managerCompaniesIds);
        } else if ($user->hasRole('attorney')) {
            return $ticket->attorney_id === $user->roleable->id;
        } else if ($user->hasRole('driver') && $ticket->user_email) {
            return $ticket->driver?->user->email === $ticket->user_email;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        if ($user->hasRole('admin')) {
            return true;
        } else if ($user->hasRole('manager')) {
            $companiesWithWriteAccessCount = $user->roleable->companiesCountWithWriteAccess();
           return $companiesWithWriteAccessCount > 0;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        //
        if ($user->hasRole('admin')) {
            return true;
        } else if ($user->hasRole('manager')) {
            return $user->roleable->canWriteToCompany($ticket->company_id);
        } else if ($user->hasRole('attorney')) {
            return $user->roleable->id === $ticket->attorney_id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        //
        if ($user->hasRole('admin')) {
            return true;
        } else if ($user->hasRole('manager')) {
            return $user->roleable->canWriteToCompany($ticket->company_id);
        }
        return false;
    }

}
