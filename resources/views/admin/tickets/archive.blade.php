@extends('layout.master')
@section('content')
    <div class="col-span-12">
        <div class="pc-component">
        <div class="card table-card">
            <div class="card-header">
                <div class="sm:flex items-center justify-between">
                    <h5 class="mb-3 sm:mb-0">Archived Tickets List</h5>
                </div>
            </div>
            <div class="card-body !pt-3">
                <div class="table-responsive">
                    <table class="table table-hover" id="pc-dt-simple">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date Received</th>
                            <th>State</th>
                            <th>Company Name</th>
                            <th>Indicator</th>
                            <th>DVER</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div class="grow ltr:ml-1 rtl:mr-1">
                                            <h6 class="mb-0">{{ $ticket->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $ticket->date_issued }}</td>
                                <td>{{ $ticket->state }}</td>
                                <td>{{ $ticket->company?->name }}</td>
                                <td>
                                    {{ $ticket->indicator }}
                                </td>
                                <td>
                                    @if($ticket->isDverDataq()['DVER'])
                                        <span class="ti ti-square-check text-lg text-primary"></span>
                                   @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($ticket->updated_at)->diffForHumans() }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.tickets.restore', $ticket->id) }}">
                                        @csrf
                                    <button type="submit" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                        <i class="ti ti-arrow-back-up text-xl leading-none"></i>
                                    </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="flex justify-between">
                    <div>
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('post-scripts')

@endsection

@section('css')

@endsection
