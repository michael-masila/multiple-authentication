<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
//remember to import Auth
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check if the user is not authenticated, the user will be redirected to login page
        if(!Auth::check()){
            return redirect('/login');
        }
        //if the user goes past the first function, it means he is authentiacted
       $user=Auth::user();
       //check if the user role matches what is permissible in this middleware
       //if permissible, each user will be redirected to their respective dashboards
       if($user->role==1){
        return $next($request);
       }
       if($user->role==2){
        return redirect('/staff');
       }
       if($user->role==3){
        return redirect('/client');
       }
        
    }
}
