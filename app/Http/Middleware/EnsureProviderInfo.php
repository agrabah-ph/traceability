<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureProviderInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->hasRole('loan-provider')){
            if(is_null(Auth::user()->loan_provider->profile)){
                return redirect()->route('loan-provider-profile-create');
            }
        }
        if(auth()->user()->hasRole('farmer')){
            if(is_null(Auth::user()->farmer->profile)){

                return redirect()->route('farmer-profile-create');
            }
        }

        return $next($request);
    }
}
