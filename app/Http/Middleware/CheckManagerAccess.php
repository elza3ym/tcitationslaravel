<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckManagerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $manager = Auth::user();

        // Check if the user is a manager and is assigned to the company
        if (!$manager->hasRole('manager') || !$manager->companies->contains('id', $request->route('company_id'))) {
            abort(403, 'Unauthorized access to this company.');
        }
        return $next($request);
    }
}
