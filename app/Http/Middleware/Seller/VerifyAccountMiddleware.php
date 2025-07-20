<?php

namespace App\Http\Middleware\seller;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyAccountMiddleware
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
        if ((auth()->user()) && ((!auth()->user()->otp_verified_at)) && (!auth()->user()->email_verified_at)) {

            session()->flash('warning', 'Please verify your email address.');

            return redirect()->route('seller.dashboard.index');
        }
        
        return $next($request);
    }
}
