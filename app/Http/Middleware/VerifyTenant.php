<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Stancl\Tenancy\Facades\Tenancy;

class VerifyTenant
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
        if(Auth::check()){
            $user = auth()->user();
            $tenant = Tenant::where('name',$user->user_name)->first();
            if($tenant){
                tenancy()->initialize($tenant);
                return $next($request);
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            return Redirect::route("login");
        }
    }
}
