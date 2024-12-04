<?php

namespace App\Http\Controllers;

use App\Exports\TicketsExport;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TicketController extends Controller
{
    public function export()
    {
        $timestamp = now()->format('Y-m-d_H-i-s');
        return Excel::download(new TicketsExport, "tickets_{$timestamp}.xlsx");
    }
}
