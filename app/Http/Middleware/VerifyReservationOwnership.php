<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyReservationOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $reservation = $request->route('reservation');

        if (auth()->user()->roleMaster->role_str == 'admin') {
            return $next($request);
        }
        // Check if reservation exists
        if (!$reservation) {
            abort(404);
        }

        if(auth()->user()->ukerMaster->id == $reservation->user->ukerMaster->id)  {
            return $next($request);
        }

        // Check if the authenticated user belongs to the same UkerMaster as the reservation's user
        if ($reservation->facility->ukerMaster->id != auth()->user()->ukerMaster->id) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}