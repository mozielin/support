<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestEventCommand extends Command
{
    protected $signature = 'pusher:test {message}';
    protected $description = 'pusher test';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        event(new \App\Events\PushNotification($this->argument('message')));
    }
}
