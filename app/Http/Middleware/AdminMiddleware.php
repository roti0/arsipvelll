<?php

namespace App\Http\Middleware;
use Closure;

use Illuminate\Http\Response;
class AdminMiddleware
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
        // dd($request->user()->level);

        if ($request->user() && $request->user()->level != '1')
        {
            return new Response(view('404'));
        }
        return $next($request);
        // if (Auth::user()->status==1&&Auth::user()->level==1) {
        //     return $next($request);
        // }
        // else {
        //     return view('welcome');
        // }
    }
}
