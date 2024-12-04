@extends('layout.master')
@section('content')
    <div class="col-span-12">
        <div class="pc-component">
            <div class="card table-card">
                <div class="card-header">
                    <div class="sm:flex items-center justify-between">
                        <h5 class="mb-3 sm:mb-0">Managers list</h5>
                        @role('manager')
                        @if(auth()->user()->roleable->companiesCountWithWriteAccess())
                        <div>
                            <a href="{{ route(Auth::user()->roles->first()->name.'.managers.create') }}" class="btn btn-primary">Create Manager</a>
                        </div>
                        @endif
                        @endrole
                        @role('admin')
                        <div>
                            <a href="{{ route(Auth::user()->roles->first()->name.'.managers.create') }}" class="btn btn-primary">Create Manager</a>
                        </div>
                        @endrole

                    </div>
                </div>
                <div class="card-body !pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Last access</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="grow ltr:ml-1 rtl:mr-1">
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->state }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>{{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() : 'Never' }}</td>
                                    <td>
                                        @role('admin')
                                        <a href="{{ route(Auth::user()->roles->first()->name.".managers.edit", $user->roleable->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                            <i class="ti ti-edit text-xl leading-none"></i>
                                        </a>
                                        <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                            <i class="ti ti-trash text-xl leading-none"></i>
                                        </a>
                                        @endrole
                                        @role('manager')
                                        @if(auth()->user()->roleable->canWriteToOtherManagerCompany($user->roleable))
                                        <a href="{{ route(auth()->user()->roles->first()->name.".managers.edit", $user->roleable->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                            <i class="ti ti-edit text-xl leading-none"></i>
                                        </a>
                                        <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                            <i class="ti ti-trash text-xl leading-none"></i>
                                        </a>
                                        @endif
                                        @endrole
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
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
