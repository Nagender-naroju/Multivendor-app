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
        
        $user_role = Auth::user()->user_role;

        switch($role){
                case "admin":
                    if($user_role=="admin"){
                       return $next($request);
                    }
                break;
                case "vendor":
                    if($user_role=="vendor"){
                        return $next($request);
                    }
                break;
                case "user":
                if($user_role=="user"){
                    return $next($request);
                }
                break;
        }  


        switch($user_role){
            case "admin":
                return redirect()->route('admin.dashboard');
            case "vendor":
                return redirect()->route('vendor.dashboard');
            case "user":
                return redirect()->route('dashboard');
        }
    }
}
