<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Cassandra\Exception\UnauthorizedException;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()->type === UserType::Admin) {
            return $next($request);
        }
        return response()->json(['error' => 'You do not have permission to do this' ], 401);
    }

}
