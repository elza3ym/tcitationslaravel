<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();
        switch ($user->roleable_type) {
            case 'App\Models\Admin':
                return redirect()->intended(route('admin.dashboard', absolute: false));
            case 'App\Models\Company':
                return redirect()->intended(route('company.dashboard', absolute: false));
            case 'App\Models\Manager':
                return redirect()->intended(route('manager.dashboard', absolute: false));
            case 'App\Models\Attorney':
                return redirect()->intended(route('attorney.dashboard', absolute: false));
            case 'App\Models\Driver':
                return redirect()->intended(route('driver.dashboard', absolute: false));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
