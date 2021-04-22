<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;


class CheckForAllScopes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$scope)
    {
        if (! $request->user() || ! $request->user()->token()) {
            throw new AuthenticationException;
        }
      //  foreach ($scopes as $scope) {
            if ($request->user()->tokenCan($scope)) { 
                return $next($request);
            }
      // }
        return response()->json([ "message" => "Not Authorized." ], 403 );
    }
}