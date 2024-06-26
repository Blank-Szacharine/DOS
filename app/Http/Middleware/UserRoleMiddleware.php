<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role)
        {
            
                if(auth()->user()->role == "user")
                {
                    return $next($request);
                }
            
                // return redirect()->back() ->with('alert', 'Submitted');
                return response()->json(["Cant Acces this page"]);

        }
    }
}
