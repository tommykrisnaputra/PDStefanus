<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $isAdmin = false;

        if (Auth::check()) {
            $UserRoles = Role::find(auth()->user()->role_id);

            if ($UserRoles->name == 'admin') {
                $isAdmin = true;
            }
        }

        if (!$isAdmin) {
            return redirect('/');
        }

        return $next($request);
    }
}
