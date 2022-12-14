<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
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
     * @param  Guard  $auth
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
        if ($this->auth->check()) {
            $user = Auth::user();
            if($user->confirm_pay_code == 1)
            	return property_exists($this, 'redirectTo') ? $this->redirectTo : redirect('/dashboard');
            else
            	return property_exists($this, 'redirectTo') ? $this->redirectTo : redirect('/validatepaycode');
        }

        return $next($request);
    }
}