<table>
    <thead>
    <tr>
        <th>Driver Name</th>
        <th>Driver Email</th>
        <th>Company</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zipcode</th>
        <th>Date Received</th>
        <th>Indicator</th>
        <th>Class Commercial?</th>
        <th>Roadside Inspection?</th>
        <th>Vehicle License Number</th>
        <th>Violation</th>
        <th>Citation Number</th>
        <th>DATAQ/DVER</th>
        <th>Ticket Type</th>
        <th>Beginning Fine Amount</th>
        <th>Final Fine Amount</th>
        <th>Total DVER Points</th>
        <th>Total DVER Points Removed</th>
        <th>Court Name</th>
        <th>Court Date</th>
        <th>Court Address</th>
        <th>Attorney Name</th>
        <th>Attorney Address</th>
        <th>Attorney Response</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->name }}</td>
            <td>{{ $ticket->user_email }}</td>
            <td>{{ $ticket->company?->name }}</td>
            <td>{{ $ticket->address }}</td>
            <td>{{ $ticket->city }}</td>
            <td>{{ $ticket->state }}</td>
            <td>{{ $ticket->zip }}</td>
            <td>{{ \Carbon\Carbon::parse($ticket->date_issued)->toDateString() }}</td>
            <td>{{ $ticket->indicator }}</td>
            <td>{{ $ticket->class_commercial }}</td>
            <td>{{ $ticket->road_side_inspection }}</td>
            <td>{{ $ticket->vehicle_lic_no }}</td>
            <td>{{ $ticket->violation->violation }}</td>
            <td>{{ $ticket->citation_no }}</td>
            <td>{{ $ticket->isDverDataq()['DVER'] ? 'DVER' : '' }} {{ $ticket->isDverDataq()['DATAQ'] ? 'DATAQ' : '' }} </td>
            <td>{{ $ticket->ticket_type }}</td>
            <td>{{ $ticket->beginning_fine_amount }}</td>
            <td>{{ $ticket->final_fine_amount }}</td>
            <td>{{ $ticket->total_dver_points__c }}</td>
            <td>{{ $ticket->total_dver_points_removed__c }}</td>
            <td>{{ $ticket->court_name }}</td>
            <td>{{ \Carbon\Carbon::parse($ticket->court_date)->toDateString() }}</td>
            <td>{{ $ticket->court_address }}</td>
            <td>{{ $ticket->attorney?->user->name }}</td>
            <td>{{ $ticket->attorney?->user->address }}</td>
            <td>{{ $ticket->attorney_response }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
