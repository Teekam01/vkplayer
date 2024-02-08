<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OneTimeAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = \Auth::user();

        if ($user && $user->token !== session('token')) {
            \Auth::logout();
            return redirect('/login')->with('message', 'You have been logged out of all other devices.');
        }
    // dd(session()->get('token'));
        session(['token' => $user->token]);
    
        return $next($request);
    }
}
