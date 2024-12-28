<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use Symfony\Component\HttpFoundation\Response;

/**
 * Handle an incoming request.
 *
 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
 */
class CheckPermissions
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = Auth::guard('admin')->user();

        if ($user && !$user->$permission) {
            return redirect()->route('dashboard.allAdmin')->with('error', 'You do not have permission to perform this action.');
        }

        return $next($request);
    }
}
