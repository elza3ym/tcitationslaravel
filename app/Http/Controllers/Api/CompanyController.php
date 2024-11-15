<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
        $user = request()->user();
        if ($user->hasRole('admin')) {
            return User::with('roleable')
                ->role('company')
                ->get();
        } else if ($user->hasRole('manager')) {
            return User::with('roleable')
                ->role('company')
                ->whereHas('roleable', function ($query) use ($user) {
                    $query->whereIn('id', $user->roleable->companies->pluck('id'));
                })
                ->get();
        } else if ($user->hasRole('company')) {
            return $user->with('roleable')->role('company')->get();
        }
    }
}
