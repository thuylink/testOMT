<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->usertype != 1) {
            return $next($request);
        }

        return redirect('')->with('error', 'KHông thể truy cập');

    }
}

//        return $next($request);
//        if (Auth::check() && Auth::user()->usertype == $type) {
//            return $next($request);
//        }

//        return redirect('/');