<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$allowedRoles): Response
    {
    	if (count($allowedRoles) > 0) {
    		$userRoles = [];

	    	foreach (Auth::user()->userRoles->all() as $key => $value) {
	    		$userRoles[] = $value->role->name;
	    	}

	    	$allowedUserRoles = array_intersect($allowedRoles, $userRoles);

	    	if (count($allowedUserRoles) < 1) {
	    		abort(403);
	    	}
    	}
    	
        
        return $next($request);
    }
}
