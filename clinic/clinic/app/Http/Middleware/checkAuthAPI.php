<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class checkAuthAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::guard('api')->user() === null){
            return response()->json(['message' => 'Unauthorized You Must Send Authorizes Requests'],401);

        }
        return $next($request);
    }
}
