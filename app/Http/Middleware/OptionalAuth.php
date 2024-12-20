<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionalAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->bearerToken()) {
            try {
                // Attempt to authenticate the user
                $user = auth('api')->authenticate();
                if ($user) {
                    auth()->setUser($user);
                }
            } catch (\Exception $e) {
                // Token invalid - continue as guest
            }
        }
        
        return $next($request);
    }
}
