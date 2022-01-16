<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUser
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
        if(auth()->user()->is_admin == 0){
            return $next($request);
        }
        $notification = array(
            'message' => 'ليس لك صلاحية لدخول هذه الصفحة',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }
}
