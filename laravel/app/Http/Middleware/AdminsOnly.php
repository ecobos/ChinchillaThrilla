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
     * @return void
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
        if($this->auth->check()){
            $exists = Admin::where('admin_id', Auth::id())->first();
            if(!is_null($exists)){
                return $next($request);
            }
        }

        return redirect('/')->with([
                'alert-type' => 'alert-danger',
                'status' => 'Not logged in as administrator'
        ]);

    }
}
