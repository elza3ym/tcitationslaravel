<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::role('manager')
            ->filterByRole(request()->user())
            ->latest()
            ->paginate(15);

        return view('managers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $currentUser = request()->user();

        if (!$currentUser->hasAnyRole(['admin', 'company'])) {
            abort(403);
        }
        return view('managers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'dob' => 'date',
            'address' => '',
            'city' => '',
            'state' => '',
            'zip' => '',
            'phone' => 'sometimes|unique:users,phone',
            'timezone' => '',
            'notification_email' => '',
            'notification_sms' => '',
            'notification_push' => '',
            'managerCompany_id' => 'nullable|array',
            'managerCompany_id.*' => 'nullable|exists:companies,id',
            'managerCompany_isWrite' => 'nullable|array',
            'managerCompany_isWrite.*' => 'nullable|in:Yes,No',
        ]);
        $request->merge([
            'notification_email' => $request->has('notification_email'),
            'notification_sms' => $request->has('notification_sms'),
            'notification_push' => $request->has('notification_push'),
        ]);

        $manager = Manager::create([]);

        $user = $manager->user()->create($request->only([
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

        foreach ($request->get('managerCompany_id') as $index => $company_id) {
            $manager->companies()->attach($company_id, [
                'is_write_access' => $request->get('managerCompany_isWrite')[$index] == 'Yes'
            ]);

            if ($request->get('managerCompany_isWrite')[$index] == 'Yes') {
                $permissionName = "write.company.{$company_id}";
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $user->givePermissionTo($permissionName);
            }
        }
        $user->assignRole('manager');
        return redirect()->route(Auth::user()->roles->first()->name.'.managers.edit', $manager->id)->with('success', 'Manager created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        //
        return view('managers.edit', compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {
        //
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
            'notification_push' => ''
        ]);
        $request->merge([
            'notification_email' => $request->has('notification_email'),
            'notification_sms' => $request->has('notification_sms'),
            'notification_push' => $request->has('notification_push'),
        ]);
        $manager->user()->update($request->only([
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

        // Remove all old companies.
        $manager->companies()->detach();

        foreach ($request->get('managerCompany_id') as $index => $company_id) {
            $manager->companies()->attach($company_id, [
                'is_write_access' => $request->get('managerCompany_isWrite')[$index] == 'Yes'
            ]);

            if ($request->get('managerCompany_isWrite')[$index] == 'Yes') {
                $permissionName = "write.company.{$company_id}";
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $manager->user->givePermissionTo($permissionName);
            }
        }

        return redirect()->route(Auth::user()->roles->first()->name.'.managers.edit', $manager->id)->with('success', 'Manager created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {
        //
    }
}
