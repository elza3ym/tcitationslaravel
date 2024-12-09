@extends('layout.master')
@section('content')
    <div class="col-span-12">
        <div class="pc-component">
            <a class="btn mb-3 btn-secondary px-5" data-pc-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                <svg class="inline pc-icon w-[22px] h-[22px]">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
                <span class="inline font-bold">Filter</span>
            </a>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <div class="mt-2 hidden multi-collapse" id="multiCollapseExample1" style="display: none;">
                        <form method="GET">
                            <div class="card">
                                <div class="card-body">
                                    <div class="grid grid-cols-12 gap-6">
                                        <div class="col-span-12 md:col-span-3">
                                            <label class="form-label">Driver</label>
                                            <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="Driver name">
                                        </div>
                                        <div class="col-span-12 md:col-span-3">
                                            <label class="form-label">Company</label>
                                            <select
                                                class="form-control"
                                                name="company_id"
                                                id="companies"
                                            ></select>
                                        </div>
                                        <div class="col-span-12 md:col-span-3">
                                            <label class="form-label">Attorney</label>
                                            <select
                                                class="form-control"
                                                name="attorney_id"
                                                id="attorneys"
                                            ></select>
                                        </div>
                                        <div class="col-span-12 md:col-span-3">
                                            <label class="form-label">Court Date</label>
                                            <div class="input-group date">
                                                <input type="text" id="courtDate" name="court_date" placeholder="Select date range"  name="date_issued" class="form-control" />
                                                <span class="input-group-text">
                                                      <i class="feather icon-calendar"></i>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="col-span-12 md:col-span-3">
                                            <label class="form-label">Ticket Status</label>
                                            <select
                                                class="form-control"
                                                name="status"
                                                id="ticketStatus"
                                            >
                                                <option value="">Select Ticket Status</option>
                                                <option value="{{ \App\Models\Ticket::TICKET_STATUS_OPEN }}">Open</option>
                                                <option value="{{ \App\Models\Ticket::TICKET_STATUS_CLOSED }}">Closed</option>
                                                <option value="{{ \App\Models\Ticket::TICKET_STATUS_ARCHIVED }}">Archived</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="flex justify-end">
                                        <button type="submit" class="btn btn-primary ltr:mr-1 rtl:ml-1">Apply</button>
                                        <button type="reset" class="btn btn-link-secondary">Reset</button>
                                </div>
                            </div>
                        </div>
                        </form>
                </div>
            </div>
        </div>
        <div class="card table-card">
            <div class="card-header">
                <div class="sm:flex items-center justify-between">
                    <h5 class="mb-3 sm:mb-0">Tickets list</h5>
                    <div>
                        <a href="{{ route('admin.tickets.export') }}" class="btn btn-success"><span class="fa fa-file-excel mr-2"></span>Download Tickets</a>
                        <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary">Create Ticket</a>
                    </div>
                </div>
            </div>
            <div class="card-body !pt-3">
                <div class="table-responsive">
                    <table class="table table-hover" id="pc-dt-simple">
                        <thead>
                        <tr>
                            <th></th>
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
                                    <input type="checkbox" class="form-check-input" data-ticketid="{{ $ticket->id }}">
                                </td>
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
                                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                        <i class="ti ti-eye text-xl leading-none"></i>
                                    </a>
                                    <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                        <i class="ti ti-edit text-xl leading-none"></i>
                                    </a>
                                    <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                        <i class="ti ti-trash text-xl leading-none"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="flex justify-between">
                    <div class="w-full">
                        <div class="grid grid-cols-12 gap-1 mb-4 text-center">
                            <label for="bulkAction" class="col-span-1 sm:col-span-1 col-form-label py-1">Action</label>
                            <div class="col-span-2 sm:col-span-2">
                                <form id="bulkActionForm" class="flex" method="POST" action="{{ route('admin.tickets.bulkUpdate') }}">
                                    @csrf <!-- Laravel CSRF token -->
                                    <select id="bulkAction" class="form-control form-control-sm" name="action">
                                        <option value="">Select Action</option>
                                        <option value="archive">Archive</option>
                                    </select>
                                    <button class="ml-4 bg-primary text-white rounded py-1 px-4" type="submit">Apply</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('post-scripts')
    <script src="{{ asset('js/plugins/flatpickr.min.js') }}"></script>
    <script src="{{ asset('js/plugins/choices.min.js') }}"></script>

    <script>
        // minimum setup
        flatpickr(document.querySelector('#courtDate'), {
            mode: 'range',
            @if (Request::get('court_date'))
            defaultDate: [new Date('{{ explode(' to ',  Request::get('court_date'))[0] }}'), new Date('{{ explode(' to ',  Request::get('court_date'))[1] }}')]
            @endif
        });

        var companiesChoices = new Choices('#companies', {
            placeholder: true,
            placeholderValue: 'Company Name',
            maxItemCount: 5,
            shouldSort: false, // Optional: keeps the order of items as provided
        }).setChoices(function () {
            return fetch('{{ route('api.company.index') }}')
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    return [{
                        value: '',
                        label: 'Select an option',
                        disabled: true,
                        selected: {{ !Request::has('company_id') ? 'true' : 'false' }} },
                        ...data.map(function (company) {
                        return {
                            value: company.id,
                            label: company.name,
                            selected: Number('{{ Request::get('company_id') }}') === Number(company.id)
                        };
                    })];
                });
        });

        var attorneysChoices = new Choices('#attorneys', {
            placeholder: true,
            placeholderValue: 'Attorney Name',
            maxItemCount: 5,
            shouldSort: false, // Optional: keeps the order of items as provided
        }).setChoices(function () {
            return fetch('{{ route('api.attorney.index') }}', {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },credentials: 'include'
            }).then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    return [{
                        value: '',
                        label: 'Select an option',
                        disabled: true,
                        selected: {{ !Request::has('attorney_id') ? 'true' : 'false' }} },
                        ...data.map(function (attorney) {
                        return {
                            value: attorney.roleable.id,
                            label: attorney.name,
                            selected: Number('{{ Request::get('attorney_id') }}') === Number(attorney.roleable.id)
                        };
                    })];
                });
        });

        document.querySelector('#bulkActionForm').addEventListener('submit', function (e) {
            const form = e.target;
            const selectedAction = document.querySelector('#bulkAction').value;
            const selectedCheckboxes = Array.from(document.querySelectorAll('input[type="checkbox"][data-ticketid]:checked'));

            // Ensure an action is selected and at least one checkbox is checked
            if (!selectedAction || selectedCheckboxes.length === 0) {
                e.preventDefault(); // Stop form submission
                return Toast.fire({
                    icon: 'info',
                    title: 'Please select an action and at least one item.'
                });
            }

            // Remove any existing hidden inputs for IDs
            form.querySelectorAll('input[name="ids[]"]').forEach(input => input.remove());

            // Append the checked IDs as hidden inputs to the form
            selectedCheckboxes.forEach(checkbox => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'ids[]';
                hiddenInput.value = checkbox.dataset.ticketid;
                form.appendChild(hiddenInput);
            });
        });

    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/choices.min.css') }}" />
@endsection
