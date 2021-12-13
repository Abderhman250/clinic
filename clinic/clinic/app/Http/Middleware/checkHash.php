<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkHash
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
        if ($request->key !== env('API_KEY_REQUEST')) {
            return response()->json(['message' => 'Unauthorized. key'], 401);
        }

        return $next($request);
    }
}
