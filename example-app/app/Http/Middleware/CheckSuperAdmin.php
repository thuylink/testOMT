<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        return $next($request);
        if (Auth::check() && Auth::user()->usertype === 'superadmin') {
            return $next($request);
        }

        return redirect('/admin/dashboard')->with('error', 'Bạn không có quyền truy cập trang này.');
    }
}
