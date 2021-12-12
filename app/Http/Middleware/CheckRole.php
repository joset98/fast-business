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
        if(Auth::user()->role == 'ADMIN')
            return redirect()->route('products.index')->withErrors(['errors' => 'Acceso no autorizado']);
        return redirect()->route('list.products')->withErrors(['errors' => 'Acceso no autorizado']);
    }
}
