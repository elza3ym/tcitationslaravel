<?php

namespace App\Http\Controllers;

use App\Models\Attorney;
use App\Models\User;
use Illuminate\Http\Request;

class AttorneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::role('attorney')->latest()->paginate(15);
        return view('attorneys.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('attorneys.create');
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
            'office_hours_start' => 'date_format:H:i',
            'office_hours_end' => 'date_format:H:i|after:office_hours_start',
        ]);
        $request->merge([
            'notification_email' => $request->has('notification_email'),
            'notification_sms' => $request->has('notification_sms'),
            'notification_push' => $request->has('notification_push'),
        ]);

        $attorney = Attorney::create($request->only([
            'office_hours_start',
            'office_hours_end'
        ]));

        $user = $attorney->user()->create($request->only([
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
        $user->assignRole('attorney');
        return redirect()->route('admin.attorneys.edit', $attorney->id)->with('success', 'Attorney created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attorney $attorney)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attorney $attorney)
    {
        //
        return view('attorneys.edit', compact('attorney'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attorney $attorney)
    {
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
            'office_hours_start' => 'date_format:H:i',
            'office_hours_end' => 'date_format:H:i|after:office_hours_start',
        ]);
        $request->merge([
            'notification_email' => $request->has('notification_email'),
            'notification_sms' => $request->has('notification_sms'),
            'notification_push' => $request->has('notification_push'),
        ]);
        $attorney->user()->update($request->only([
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

        $attorney->update($request->only([
            'office_hours_start',
            'office_hours_end'
        ]));

        return redirect()->route('admin.attorneys.edit', $attorney->id)->with('success', 'Attorney updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attorney $attorney)
    {
        //
    }
}
