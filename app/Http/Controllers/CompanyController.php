<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::role('company')
            ->filterByRole(request()->user())
            ->latest()
            ->paginate(15);

        return view('companies.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('companies.create');
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
            'phone' => '',
            'timezone' => '',
            'notification_email' => '',
            'notification_sms' => '',
            'notification_push' => '',
            'ct_email' => 'email',
            'ct_fname' => '',
            'ct_lname' => '',
            'dot' => '',
            'companyContactName' => '',
            'companyContactEmail' => '',
            'companyContactPhone' => '',
            'companyContactCell' => '',
        ]);
        $company = Company::create($request->only([
            'ct_email',
            'ct_fname',
            'ct_lname',
            'dot',
            'sf_id',
        ]));

        foreach ($request->companyContactName as $index => $contactName) {
            $company->contacts()->create([
                'name' => $request->companyContactName[$index],
                'email' => $request->companyContactEmail[$index],
                'phone' => $request->companyContactPhone[$index],
                'cell' => $request->companyContactCell[$index],
            ]);
        }

        $user = $company->user()->create($request->only([
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
        $user->assignRole('company');
        return redirect()->route('admin.companies.edit', $company->id)->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($company->user->id),
            ],
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
        $company->user()->update($request->only([
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

        $company->update($request->only([
            'ct_email',
            'ct_fname',
            'ct_lname',
            'dot',
            'sf_id',
        ]));
        // Remove all old contacts.
        $company->contacts()->delete();
        foreach ($request->companyContactName as $index => $contactName) {
            $company->contacts()->create([
                'name' => $request->companyContactName[$index],
                'email' => $request->companyContactEmail[$index],
                'phone' => $request->companyContactPhone[$index],
                'cell' => $request->companyContactCell[$index],
            ]);
        }

        return redirect()->route('admin.companies.edit', $company->id)->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
