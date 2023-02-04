<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AppAccessTokenCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        if (!$request->hasHeader('authorization')) {
            return Response::json([
                 'status'=>'fail',
                 'message'=>'missing authorization header'
             ], 401);
        }
        // return $next($request);
        if ($request->bearerToken() != env('APP_ACCESS_TOKEN')) {
              return Response::json([
                 'status'=>'fail',
                 'message'=>'invalid bearer token'
             ], 401);
        }
        return $next($request);
    }
}
