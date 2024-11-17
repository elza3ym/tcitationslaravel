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
        $companies = Company::latest();
        $currentUser = \request()->user();
        if ($currentUser->hasRole('admin')) {

        } else if ($currentUser->hasRole('manager')) {
            $companies->whereHas('managers', function ($query) use ($currentUser) {
                $query->where('manager_id', $currentUser->roleable_id); // Ensure `roleable_id` is used correctly
            });
        }
        $companies = $companies->paginate(15);

        return view('companies.index', compact('companies'));
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
            'ct_email' => 'nullable|email',
            'ct_fname' => '',
            'ct_lname' => '',
            'dot' => '',
            'companyContactName' => '',
            'companyContactEmail' => '',
            'companyContactPhone' => '',
            'companyContactCell' => '',
        ]);
        $company = Company::create($request->only([
            'name',
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
            'ct_email' => 'nullable|email',
            'ct_fname' => '',
            'ct_lname' => '',
            'dot' => '',
            'companyContactName' => '',
            'companyContactEmail' => '',
            'companyContactPhone' => '',
            'companyContactCell' => '',
        ]);

        $company->update($request->only([
            'name',
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
