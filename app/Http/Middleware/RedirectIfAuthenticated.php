<?php

namespace App\Http\Middleware;

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
            $host = explode('.', $request->getHttpHost());
            $role = $host[0];
            $user = Auth::user();
            if ($role == 'admin' && $user->level == 0) {
                return redirect('/');
            }
            elseif ($role == 'admin' && $user->level != 0) {
                Auth::logout();
                $message = ['flash_level'=>'warning message-custom','flash_message'=>'You not have permission!!!'];
                return back()->with($message);
            }
        }

        return $next($request);
    }
}
