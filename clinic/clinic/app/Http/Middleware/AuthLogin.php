<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
class AuthLogin
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
            $token = $request->header('auth-token');
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            try {
            //    $user = $this->auth->authenticate($request);  //check authenticted user
                $user = JWTAuth::parseToken()->authenticate();
            } catch (\Exception $e) {
                return response()->json(['message' => 'Unauthorized.'],401);
            } 


        return $next($request);
    }
}
