<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the session has the user email
        if (!session()->has('Uemail')) {
            // Flash an error message to the session
            session()->flash('error', 'Please log in to your account');
            
            // Redirect to the sign-in route
            return redirect()->route('signin');
        }

        // If authenticated, proceed with the request
        return $next($request);
    }
}
