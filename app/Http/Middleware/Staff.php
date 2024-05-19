<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class Staff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect('/login');
        }
        //if the user goes past the first function, it means he is authentiacted
       $user=Auth::user();
       //check if the user role matches what is permissible in this middleware
       //if permissible, each user will be redirected to their respective dashboards
       if($user->role==2){
        return $next($request);
       }
       if($user->role==1){
        return redirect('/admin');
       }
       if($user->role==3){
        return redirect('/client');
       }
    }
}
