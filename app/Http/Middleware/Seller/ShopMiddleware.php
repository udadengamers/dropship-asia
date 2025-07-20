<?php

namespace App\Http\Middleware\seller;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopMiddleware
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
        if ((auth()->user()) && (!auth()->user()->shop)) {

            session()->flash('warning', 'You don`t have a shop.');

            return redirect()->route('seller.shop.create');
        }

        if (auth()->user()->shop->state == 'inactive') {
    
            return redirect()->route('seller.banned');
        }

        $request->merge([
            'shop' => auth()->user()->shop
        ]);

        return $next($request);
    }
}
