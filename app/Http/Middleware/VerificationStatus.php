<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificationStatus
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

        if (!$reservation) {
            abort(404);
        }

        if ($reservation->status != 'pending')
        {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}