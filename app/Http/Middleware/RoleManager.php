<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $role = Auth::user()->role;
        switch($role){
                case "admin":
                    if($role=="admin"){
                       return $next($request);
                    }
                break;
                case "vendor":
                    if($role=="vendor"){
                        return $next($request);
                    }
                break;
                case "user":
                if($role=="vendor"){
                    return $next($request);
                }
                break;
        }  
    }
}
