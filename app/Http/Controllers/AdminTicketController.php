<?php

namespace App\Http\Controllers;

use App\Exports\TicketsExport;
use App\Filters\TicketFilters;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminTicketController extends TicketController
{
    use AuthorizesRequests;  // Ensure this is included

    /**
     * Display a listing of the resource.
     */
    public function index(TicketFilters $filters)
    {
        //
        $tickets = Ticket::with('company')
            ->active()
            ->filter($filters)
            ->latest()
            ->paginate(15);
        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Display a listing of the resource.
     */
    public function archive()
    {
        //
        $tickets = Ticket::with('company')
            ->where('status', Ticket::TICKET_STATUS_ARCHIVED)
            ->latest()
            ->paginate(15);
        return view('admin.tickets.archive', compact('tickets'));
    }

    public function restore(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $ticket->status = Ticket::TICKET_STATUS_OPEN;
        $ticket->save();
        return redirect()->back()->with('success', 'Ticket have been restored successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.tickets.create');
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
        return redirect()->route('admin.tickets.edit', $ticket->id)->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
        $this->authorize('view', $ticket);
        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
        $this->authorize('update', $ticket);
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'action' => ['required', 'string', 'in:delete,archive'], // Adjust allowed actions as needed
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:tickets,id'], // Ensure IDs are valid ticket IDs
        ]);

        $action = $request->input('action');
        $ticketIds = $request->input('ids', []);

        // Authorize each ticket
        foreach ($ticketIds as $ticketId) {
            $ticket = Ticket::findOrFail($ticketId);
            $this->authorize('update', $ticket);
        }

        // Perform the action
        switch ($action) {
            case 'archive':
                Ticket::whereIn('id', $ticketIds)->update(['status' => Ticket::TICKET_STATUS_ARCHIVED]);
                return redirect()->back()->with('success', 'Selected tickets have been archived.');

            default:
                return redirect()->back()->with('error', 'Invalid action selected.');
        }
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
        // Store the original fields before update
        // Manually set the ticket attributes using $ticket->attribute = 'value'
        $ticket->user_email = $request->input('user_email');
        $ticket->name = $request->input('name');
        $ticket->company_id = $request->input('company_id');
        $ticket->city = $request->input('city');
        $ticket->state = $request->input('state');
        $ticket->zip = $request->input('zip');
        $ticket->address = $request->input('address');
        $ticket->indicator = $request->input('indicator');
        $ticket->class_commercial = $request->input('class_commercial');
        $ticket->road_side_inspection = $request->input('road_side_inspection');
        $ticket->date_issued = $request->input('date_issued');
        $ticket->vehicle_lic_no = $request->input('vehicle_lic_no');
        $ticket->violation_id = $request->input('violation_id');
        $ticket->citation_no = $request->input('citation_no');
        $ticket->ticket_type = $request->input('ticket_type');
        $ticket->court_name = $request->input('court_name');
        $ticket->court_date = $request->input('court_date');
        $ticket->court_address = $request->input('court_address');
        $ticket->attorney_id = $request->input('attorney_id');
        $ticket->attorney_response = $request->input('attorney_response');
        $ticket->processor_name = $request->input('processor_name');
        $ticket->processor_email = $request->input('processor_email');
        $ticket->processor_ph_number = $request->input('processor_ph_number');
        $ticket->processor_notes_to_attorney = $request->input('processor_notes_to_attorney');

        // Save the updated ticket
        $ticket->save();

        return redirect()->route('admin.tickets.edit', $ticket->id)->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
