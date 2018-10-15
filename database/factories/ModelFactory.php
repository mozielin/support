<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\role_user;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        //'user_group' => str_random(10),
        'remember_token' => str_random(10),
    ];

	$user = User::all();

	foreach ($user as $data) {

		$udata = new role_user;
		$udata-> user_id = $data->id;
        $udata-> role_id = '2';
        $udata ->save();
  
	}


});

$factory->define(App\role_user::class, function (Faker\Generator $faker) {
    
 $user = User::all();

		foreach ($user as $data) {

		$udata = new role_user;
		$udata-> user_id = $data->id;
        $udata-> role_id = '2';
        $udata ->save();
  
		}
    return [
       

    ];

	

});


$factory->define(App\company::class, function (Faker\Generator $faker) {


    return [
        'company_name' => $faker->company,
        'company_cel' => $faker->phoneNumber,
        'company_url' => $faker->url,
        'company_population' => $faker->randomNumber,
        'company_capital' => $faker->randomNumber,
        'company_EIN' => $faker->randomNumber,
        'com_industry_id' => $faker->randomDigitNotNull,
        'com_type_id' => $faker->randomDigitNotNull,
        'com_plan_id' => $faker->randomDigitNotNull,
        'com_sales_id' => $faker->randomDigitNotNull,
        'com_builder_id' => $faker->randomDigitNotNull,
        'company_status' => $faker->randomDigitNotNull,
        'company_area' => $faker->randomDigitNotNull,
        'company_create' => $faker->date($format = 'Y-m-d', $max = 'now'),

    ];


});
