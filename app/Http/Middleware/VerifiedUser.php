<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class VerifiedUser
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
        $user = User::where('id', $request->user()->id)->first();
        if($user && !is_null($user->is_verified)){
            return $next($request);
        }
        return Response::json(
            [
                "status"    =>"fail",
                "message"   =>"verify your account to proceed",
                "error"     =>"unverified account"     
            ],
            401
        );
        
    }
}
