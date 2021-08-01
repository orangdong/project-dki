<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user(); 
         if($user && $user->role == 'user'){
             if(!$user->surat){
                return redirect(route('dashboard.profile')); 
             } 
             return $next($request); 
            } 
        return redirect(route('dashboard.admin')); 
    }
}
