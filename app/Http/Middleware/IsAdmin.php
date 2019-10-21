<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class IsAdmin
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
        if (Auth::user()->role == 'ADMIN') 
        {
        return $next($request);
        }else{
        session()->flash('my_error', 'Usted no Tiene los Permisos Administrativos');
        return redirect('/home');
        }
    }
}