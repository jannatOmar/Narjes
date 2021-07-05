<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Request;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Request::is('admin/*')) {
                return route('user.login');
            }
            if(Request::is('employee/*')){
                return route('user.login');
            }
            if(Request::is('manager/*')){
                return route('user.login');
            }
            if(Request::is('accountant/*')){
                return route('user.login');
            }else {
                return route('get.user.login');
            }

                    }

    }
}
