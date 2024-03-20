<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next) {
        $isAdmin = FALSE;

        if (Auth::check()) {
            if (auth()->user()->role_id == 2) {
                $isAdmin = TRUE;
                }
            }

        if (! $isAdmin) {
            return redirect('/');
            }

        return $next($request);
        }
    }
