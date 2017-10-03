<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckActivated
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
        if(Auth::check() && Auth::user()->activated == 1)
        {
            return $next($request);
        }
        else{
            $message = ['flash_level'=>'warning message-custom','flash_message'=>'Your must change password first'];
            return redirect()->Route('getChangePassword')->with($message);
        }
    }
}
