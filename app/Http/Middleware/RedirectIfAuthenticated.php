<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            if($guard=='admin'){
               return redirect(RouteServiceProvider::ADMIN);
            }
            else if($guard=='manager'){
                return redirect(RouteServiceProvider::MANAGER);
             }
             else if($guard=='employee'){
                return redirect(RouteServiceProvider::EMPLOYEE);
             }
             else if($guard=='accountant'){
                return redirect(RouteServiceProvider::ACCOUNTANT);
             }
            else{
               return redirect(RouteServiceProvider::RESULT);
            }
          }    
            

        return $next($request);
    }
}
