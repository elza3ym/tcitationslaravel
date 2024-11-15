<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    //
    public function index() {
        return Ticket::all('name');
    }
}
