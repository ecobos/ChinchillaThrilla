<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfNotAuthenticated
{

    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // Check if the current user is not authenticated
        if (!$this->auth->check()) {
            // If they are not, then redirect them to the main page
            return redirect('/');
        }

        // Otherwise, allow the request to go through
        return $next($request);
    }
}
