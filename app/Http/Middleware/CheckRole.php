<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        
        if( Auth::user()->role === $role ) {
            return $next($request);
        }

        return response()->json(['error' => 'Acceso no autorizado'], 401);
    }
}
