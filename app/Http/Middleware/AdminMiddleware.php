<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // التحقق مما إذا كان المستخدم قد سجل الدخول كـ Admin وليس لديه صلاحيات admin
        if (auth('admin')->check() && !auth('admin')->user()->is_admin) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
