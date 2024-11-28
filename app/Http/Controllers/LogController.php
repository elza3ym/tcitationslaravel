<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //
    public function index()
    {
        $logs = Log::latest()->paginate(15);
        return view('admin.logs.index', compact('logs'));
    }
}
