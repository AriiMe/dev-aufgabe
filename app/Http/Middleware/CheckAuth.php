<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AccessToken;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $accessLevel  The required access level for the route
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $accessLevel)
    {
        // Get the currently authenticated user's id
        $userId = Auth::id();

        // Find the access token for the authenticated user
        $accessToken = AccessToken::where('employee_id', $userId)->first();

        // If the access token doesn't exist or the user's access level is below the required level, deny access
        if (!$accessToken || $accessToken->access_level < $accessLevel) {
            abort(403, 'Access Denied');
        }

        // If the user has the required access level, allow the request to proceed
        return $next($request);
    }
}
