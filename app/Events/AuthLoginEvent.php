<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Carbon\Carbon;

use App\User;

class AuthLoginEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        activity()->log('User Logining');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

     public function handle(User $user, $remember)
    {
        activity()->log('User Logining');
        $user->login_at = Carbon::now();
        $user->last_ip = $this->request->ip();

        //TODO:其它动作，比如增加积分等等。

        $user->save();
    }
}
