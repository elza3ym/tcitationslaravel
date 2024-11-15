<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AttorneyController extends Controller
{
    //
    public function index() {
        return User::with('roleable')->role('attorney')->get();
    }
}
