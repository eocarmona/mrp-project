<?php
use App\User;
use Faker\Generator;
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

$factory->define(User::class, function(Generator $faker){
	$array = [
		'username' => $faker->username,
		'email' => $faker->email,
		'password' => bcrypt('1234'),
		'user_type_id' => '2',
		'is_deleted' => 0,
		'created_by_id' => 1,
		'updated_by_id' => 1
	];
	return $array;
});
