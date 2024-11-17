<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
        $user = request()->user();
        if ($user->hasRole('admin')) {
            return Company::all();
        } else if ($user->hasRole('manager')) {
            return Company::whereHas('managers', function ($query) use ($user) {
                $query->where('manager_id', $user->roleable_id);
            })->get();
        }
    }
}
