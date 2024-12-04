<?php

namespace App\Http\Controllers;

use App\Filters\TicketFilters;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class DriverTicketController extends TicketController
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(TicketFilters $filters)
    {
        //
        $tickets = Ticket::whereHas('driver')->filterByRole(request()->user())->approved()->with('company')->filter($filters)->latest()->paginate(15);

        return view('driver.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('driver.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $currentUser = auth()->user();

        $request->validate([
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'address' => 'required',
            'class_commercial' => 'in:Yes,No',
            'road_side_inspection' => 'in:Yes,No',
            'date_issued' => 'required|date',
            'vehicle_lic_no' => 'required',
            'violation_id' => 'required|exists:violations,id',
            'citation_no' => '',
            'ticket_type' => '',
        ]);

        $request->merge([
            'user_email' => $currentUser->email,
            'name' => $currentUser->name,
            'company_id' => $currentUser->roleable->company->id,
            'is_approved' => false,
            'indicator' => Ticket::INDICATOR_PENDING,
        ]);

        // Create a new Ticket record with the validated data
        $ticket = Ticket::create($request->only([
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
        ]));
        return redirect()->route('driver.tickets.index', $ticket->id)->with('success', 'Ticket submitted for review successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
        $this->authorize('view', $ticket);
        return view('driver.tickets.show', compact('ticket'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
