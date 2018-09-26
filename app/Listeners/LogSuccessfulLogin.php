<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {   
        activity('Activity')->log('User Login');
        
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle()
    {
        $id = Auth::id();
        $time = Carbon::now();
        $user = User::find($id);
        $user->login_at = $time;
        //$user->name = $this->request->ip();

        //TODO:其它动作，比如增加积分等等。

        $user->save();
    }
}
