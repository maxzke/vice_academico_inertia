<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isActivoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->is_activo) {
            return $next($request);
        }else{
            auth('web')->logout();
            //$request->sesion()->invalidate();
            //$request->sesion()->regenerateToken();
            return redirect('/');
        }
        
    }
}
