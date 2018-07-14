<?php

namespace App\Http\Middleware;

use Closure;
use Session;

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
        if(auth()->user()->isAdmin()) {
            return $next($request);
        }

        Session::flash('alert', ['type' => 'warning', 'text' => 'Você não possui permissão para acessar a página solicitada. Entre em contato com a administração para mais informações.']);
        return redirect('admin');
    }
}
