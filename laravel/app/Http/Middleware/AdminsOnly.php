<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class AdminsOnly
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
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
        // Check if the user is logged in first
        if($this->auth->check()){
            // If logged in, then check if that user is also in the admins table
            $exists = Admin::where('admin_id', Auth::id())->first();
            // If an entry exists for the current user in the admin table, then they are admins
            if(!is_null($exists)){
                // Let their request go through
                return $next($request);
            }
        }

        // Otherwise, redirect the user back to the main page with an alert
        return redirect('/')->with([
                'alert-type' => 'alert-danger',
                'status' => 'Not logged in as administrator'
        ]);

    }
}
