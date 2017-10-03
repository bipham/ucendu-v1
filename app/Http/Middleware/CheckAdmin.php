<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdmin
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
//        dd();
//        $user = Auth::user();
        if(Auth::check() && Auth::user()->level == 0)
        {
            return $next($request);
        }
        else{
            Auth::logout();
            $message = ['flash_level'=>'warning message-custom','flash_message'=>'You not have permission!!!'];
            return redirect()->Route('getLogin')->with($message);
        }
    }
}
