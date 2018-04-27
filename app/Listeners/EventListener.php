<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        activity()->log('User Login1');
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    

    public function handle(Login $event)
    {
        //LoginActivity::create([
        //    'user_id'       =>  $event->user->id,
        //    'user_agent'    =>  \Illuminate\Support\Facades\Request::header('User-Agent'),
        //    'ip_address'    =>  \Illuminate\Support\Facades\Request::ip()
        //]);
        //$ip = \Illuminate\Support\Facades\Request::ip();
        activity()->log('User Login');
    }
}
