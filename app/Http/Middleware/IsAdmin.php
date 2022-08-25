<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IsAdmin
{

    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            if (Auth::user()->role_id == 1){
                return $next($request);
            }else{
                return Redirect::route('index')->with('error','Access Denied | You are not Authorized');
            }

        }else{
            return Redirect::route('admin_login');
        }
    }
}
