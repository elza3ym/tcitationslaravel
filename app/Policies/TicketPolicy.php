<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

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
            $managerCompaniesIds = $user->roleable->companies()->pulk('id')->toArray();
            return in_array($ticket->company_id, $managerCompaniesIds);
        } else if ($user->hasRole('attorney')) {
            return $ticket->attorney_id === $user->roleable->id;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        if ($user->hasRole('admin', 'company')) {
            return true;
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
            if ($user->can("write access for company {$ticket->company_id}")) {
                return true;
            }
            return false;
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
        } else if ($user->hasRole('company')) {
            $ticket->company_id === $user->roleable->id;
        }
        return false;
    }

}
