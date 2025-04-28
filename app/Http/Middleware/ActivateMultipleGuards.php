<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ActivateMultipleGuards
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('web_user_id')) {
            Auth::guard('web')->onceUsingId(session('web_user_id'));
        }
    
        if (session()->has('karyawan_user_id')) {
            Auth::guard('karyawan')->onceUsingId(session('karyawan_user_id'));
        }
    
        if (session()->has('admin_user_id')) {
            Auth::guard('admin')->onceUsingId(session('admin_user_id'));
        }
    
        return $next($request);
    }
}
