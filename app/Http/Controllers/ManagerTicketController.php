<?php

namespace App\Http\Controllers;

use App\Filters\TicketFilters;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ManagerTicketController extends Controller
{
    use AuthorizesRequests;  // Ensure this is included

    /**
     * Display a listing of the resource.
     */
    public function index(TicketFilters $filters)
    {
        //
        $tickets = Ticket::filter($filters)->filterByRole(request()->user())->with('company')->filter($filters)->latest()->paginate(15);

        return view('manager.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create', new Ticket());

        return view('manager.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'user_email' => 'required|email',
            'name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'address' => 'required',
            'indicator' => 'in:' . implode(',', Ticket::INDICATORS_ALLOWED),
            'class_commercial' => 'in:Yes,No',
            'road_side_inspection' => 'in:Yes,No',
            'date_issued' => 'required|date',
            'vehicle_lic_no' => 'required',
            'violation_id' => 'required|exists:violations,id',
            'citation_no' => '',
            'ticket_type' => '',
            'court_name' => '',
            'court_date' => '',
            'court_address' => '',
            'attorney_id' => 'exists:attorneys,id',
            'attorney_response' => 'in:Accepted,Rejected',
            'processor_name' => '',
            'processor_email' => '',
            'processor_ph_number' => '',
            'processor_notes_to_attorney' => '',
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
            'court_name',
            'court_date',
            'court_address',
            'attorney_id',
            'attorney_response',
            'processor_name',
            'processor_email',
            'processor_ph_number',
            'processor_notes_to_attorney'
        ]));

        return redirect()->route(auth()->user()->roles->first()->name.'.tickets.edit', $ticket->id)->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
        $this->authorize('view', $ticket);
        return view('manager.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
        $this->authorize('update', $ticket);
        return view('manager.tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
        $this->authorize('update', $ticket);
        $request->merge([
            'class_commercial' => \request('class_commercial', 'No'),
            'road_side_inspection' => \request('road_side_inspection', 'No'),
        ]);
        $request->validate([
            'user_email' => 'required|email',
            'name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'address' => 'required',
            'indicator' => 'in:' . implode(',', Ticket::INDICATORS_ALLOWED),
            'class_commercial' => 'in:Yes,No',
            'road_side_inspection' => 'in:Yes,No',
            'date_issued' => 'required|date',
            'vehicle_lic_no' => 'required',
            'violation_id' => 'required|exists:violations,id',
            'citation_no' => '',
            'ticket_type' => '',
            'court_name' => '',
            'court_date' => '',
            'court_address' => '',
            'attorney_id' => 'exists:attorneys,id',
            'attorney_response' => 'in:Accepted,Rejected',
            'processor_name' => '',
            'processor_email' => '',
            'processor_ph_number' => '',
            'processor_notes_to_attorney' => '',
        ]);
        // Create a new Ticket record with the validated data
        $ticket->update($request->only([
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
            'court_name',
            'court_date',
            'court_address',
            'attorney_id',
            'attorney_response',
            'processor_name',
            'processor_email',
            'processor_ph_number',
            'processor_notes_to_attorney',
        ]));

        return redirect()->route('manager.tickets.edit', $ticket->id)->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
