<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Factory;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class, 50)->create();
        //factory(App\role_user::class, 1)->create();
        factory(App\company::class, 5000)->create();
    }
}
