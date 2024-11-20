<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Driver;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DriverController extends Controller
{
    use AuthorizesRequests;  // Ensure this is included

    public function dashboard()
    {
        return view('driver.dashboard');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->has('status') && (int) $request->get('status') === 0) {
            $users = Ticket::select('name', 'city', 'state', 'company_id', DB::raw('id AS ticket_id'))->whereDoesntHave('driver')->with('company');
        } else {
            $users = User::role('driver')
                ->filterByRole(request()->user());
        }
        $users = $users->latest()->paginate(15)->withQueryString(true);;
        return view('drivers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $ticket = null;
        if ($request->get('ticket_id')) {
            // Find the ticket and authorize the view action
            $ticket = Ticket::findOrFail($request->get('ticket_id'));
            $this->authorize('view', $ticket);
        }

        $this->authorize('create', new Driver());


        return view('drivers.create', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create', new Driver());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'dob' => 'date',
            'address' => '',
            'city' => '',
            'state' => '',
            'zip' => '',
            'phone' => '',
            'timezone' => '',
            'notification_email' => '',
            'notification_sms' => '',
            'notification_push' => '',
            'company_id' => 'required|exists:companies,id'
        ]);
        $request->merge([
            'notification_email' => $request->has('notification_email'),
            'notification_sms' => $request->has('notification_sms'),
            'notification_push' => $request->has('notification_push'),
        ]);
        $currentUser = \auth()->user();
        if ($currentUser->hasRole('manager') && !$currentUser->roleable->canWriteToCompany($request->company_id)) {
            $company = Company::findOrFail($request->company_id);
            throw ValidationException::withMessages([
                "company_id" => "You do not have write access to company {$company->name}."
            ]);
        }
        $driver = Driver::create([
            'company_id' => $request->get('company_id')
        ]);
        $user = $driver->user()->create($request->only([
            'name',
            'email',
            'password',
            'dob',
            'address',
            'city',
            'state',
            'zip',
            'phone',
            'timezone',
            'notification_email',
            'notification_sms',
            'notification_push',
        ]));
        $user->assignRole('driver');
        return redirect()->route(auth()->user()->roles->first()->name.'.drivers.edit', $driver->id)->with('success', 'Driver created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        //
        $this->authorize('update', $driver);

        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        //
        $this->authorize('update', $driver);

        $currentUser = \auth()->user();
        if ($currentUser->hasRole('manager') && !$currentUser->roleable->canWriteToCompany($request->company_id)) {
            $company = Company::findOrFail($request->company_id);
            throw ValidationException::withMessages([
                "company_id" => "You do not have write access to company {$company->name}."
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'dob' => 'date',
            'password' => 'nullable|string|min:8',
            'address' => '',
            'city' => '',
            'state' => '',
            'zip' => '',
            'phone' => '',
            'timezone' => '',
            'notification_email' => '',
            'notification_sms' => '',
            'notification_push' => '',
            'company_id' => 'required|exists:companies,id'
        ]);
        $request->merge([
            'notification_email' => $request->has('notification_email'),
            'notification_sms' => $request->has('notification_sms'),
            'notification_push' => $request->has('notification_push'),
        ]);
        $driver->update(['company_id' => $request->company_id]);
        $driver->user()->update($request->only([
                'name',
                'email',
                'dob',
                'address',
                'city',
                'state',
                'zip',
                'phone',
                'timezone',
                'notification_email',
                'notification_sms',
                'notification_push',
            ]+ ($request->password ? ['password'] : [])));
        return redirect()->route(auth()->user()->roles->first()->name.'.drivers.edit', $driver->id)->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
