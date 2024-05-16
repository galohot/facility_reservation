<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $facility = $request->route('facility');

        if (auth()->user()->roleMaster->role_str == 'admin') {
            return $next($request);
        }
        // Check if reservation exists
        if (!$facility) {
            abort(404);
        }

        // Check if the authenticated user belongs to the same UkerMaster as the reservation's user
        if ($facility->ukerMaster->id != auth()->user()->ukerMaster->id) {
            abort(403, 'Unauthorized Action');
        }

        return $next($request);
    }
}