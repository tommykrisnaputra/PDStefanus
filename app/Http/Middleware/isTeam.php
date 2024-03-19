<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isTeam
    {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle ( $request, Closure $next ) : Response
        {
        $isTeam = FALSE;

        if ( Auth::check () )
            {
            if ( auth ()->user ()->role_id == 2 | auth ()->user ()->role_id == 3 )
                {
                $isTeam = TRUE;
                }
            }

        if ( ! $isTeam )
            {
            return redirect ( '/' );
            }

        return $next ( $request );
        }
    }
