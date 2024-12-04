<?php

namespace App\Policies\Policies;

use App\Models\Driver;
use App\Models\User;

class DriverPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Driver $driver): bool
    {
        //
        if ($user->hasRole('admin')) {
            return true;
        } else if ($user->hasRole('manager')) {
            $managerCompaniesIds = $user->roleable->companies()->pluck('companies.id')->toArray();
            return in_array($driver->company_id, $managerCompaniesIds);
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        $currentUser = auth()->user();
        if ($currentUser->hasRole('admin')) {
            return true;
        } else if ($currentUser->hasRole('manager')) {
            return $currentUser->roleable->companiesCountWithWriteAccess() > 0;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Driver $driver): bool
    {
        //
        if ($user->hasRole('admin')) {
            return true;
        } else if ($user->hasRole('manager')) {
            return $user->roleable->canWriteToCompany($driver->company_id);
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Driver $driver): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Driver $driver): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Driver $driver): bool
    {
        //
    }
}
