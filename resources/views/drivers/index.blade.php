@extends('layout.master')
@section('content')
    <div class="col-span-12">
        <div class="pc-component">
            <div class="card table-card">
                <div class="card-header">
                    <div class="sm:flex items-center justify-between">
                        <h5 class="mb-3 sm:mb-0">Drivers list</h5>
                        @if (!(request()->has('status') && request()->get('status') == 0))
                        @role('admin')
                        <div>
                            <a href="{{ route(auth()->user()->roles->first()->name.'.drivers.create') }}" class="btn btn-primary">Create Driver</a>
                        </div>
                        @endrole
                        @role('manager')
                        @if(auth()->user()->roleable->companiesCountWithWriteAccess())
                        <div>
                            <a href="{{ route(auth()->user()->roles->first()->name.'.drivers.create') }}" class="btn btn-primary">Create Driver</a>
                        </div>
                        @endif
                        @endrole
                        @endif
                    </div>
                </div>
                <div class="card-body !pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Company</th>
                                <th>Last access</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input">
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="grow ltr:ml-1 rtl:mr-1">
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->state }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>{{ $user->roleable->company?->name ?? $user->company?->name }}</td>
                                    <td>{{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() : 'Never' }}</td>
                                    <td>
                                        @if ($user->roleable)
                                            @role('admin')
                                            <a href="{{ route(auth()->user()->roles->first()->name.'.drivers.edit', $user->roleable->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-edit text-xl leading-none"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-trash text-xl leading-none"></i>
                                            </a>
                                            @endrole
                                            @role('manager')
                                            @if(auth()->user()->roleable->canWriteToCompany($user->roleable->company_id))
                                            <a href="{{ route(auth()->user()->roles->first()->name.'.drivers.edit', $user->roleable->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-edit text-xl leading-none"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-trash text-xl leading-none"></i>
                                            </a>
                                            @endif
                                            @endrole
                                        @else
                                            <a href="{{ route(auth()->user()->roles->first()->name.'.drivers.create', ['ticket_id' => $user->ticket_id]) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-success" title="Register this driver">
                                                <i class="ti ti-user-plus text-xl leading-none"></i>
                                            </a>
                                        @endif
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
                                <label for="inputEmail3" class="col-span-1 sm:col-span-1 col-form-label py-1">Action</label>
                                <div class="col-span-2 sm:col-span-2">
                                    <select class="form-control form-control-sm" id="inputEmail3">
                                        <option>Choose...</option>
                                        <option>Action 1</option>
                                        <option>Action 2</option>
                                        <option>Action 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection