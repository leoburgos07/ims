<?php

namespace App\Handlers\Events;

use App\Events;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class AuthLoginEventHandler
{
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(User $user, $remember)
    {
        \Auth::user()->last_login = new \DateTime;
        \Auth::user()->last_login_ip = \Request::getClientIp();
        \Auth::user()->save();
    }
}
