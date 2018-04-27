<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['name' => 'admin', 'email' => 'admin@teamplus.com.tw', 'password' => '$2y$10$wkRqzZ11EzfOSPth1cEwmebkT9O089rLEIxGE3Q5QXer706Ls7NGm', 'user_group' => '1']);

        $user->attachRole('1');
    }
}
