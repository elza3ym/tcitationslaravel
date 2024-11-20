@extends('layout.master')
@section('content')
    <div class="col-span-12">
        <div class="pc-component">
            <div class="card table-card">
                <div class="card-header">
                    <div class="sm:flex items-center justify-between">
                        <h5 class="mb-3 sm:mb-0">Companies list</h5>
                        @role('admin')
                        <div>
                            <a href="{{ route(auth()->user()->roles->first()->name.'.companies.create') }}" class="btn btn-primary">Create Company</a>
                        </div>
                        @endrole
                    </div>
                </div>
                <div class="card-body !pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>CT Name</th>
                                <th>DOT</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input">
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="grow ltr:ml-1 rtl:mr-1">
                                                <h6 class="mb-0">{{ $company->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $company->ct_fname }} {{ $company->ct_lname }}</td>
                                    <td>{{ $company->dot }}</td>
                                    <td>
                                        @role('manager')
                                        @if(auth()->user()->roleable->canWriteToCompany($company->id))
                                        <a href="{{ route(auth()->user()->roles->first()->name.'.companies.edit', $company->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                            <i class="ti ti-edit text-xl leading-none"></i>
                                        </a>
                                        @endrole
                                        @endif
                                        @role('admin')
                                            <a href="{{ route(auth()->user()->roles->first()->name.'.companies.edit', $company->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-edit text-xl leading-none"></i>
                                            </a>
                                            <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-trash text-xl leading-none"></i>
                                            </a>
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
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
