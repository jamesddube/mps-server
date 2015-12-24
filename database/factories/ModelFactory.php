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

$factory->define(App\User::class, function (Faker\Generator $faker) {

	$name = $faker->firstName;
	return [
		'name'           => $name,
		'surname'        => $faker->lastName,
		'gender'         => $faker->randomElement($array = ['Male', 'Female']),
		'job_title'      => $faker->job_title,
		'email'          => strtolower($name . "@mbc.co.zw"),
		'password'       => bcrypt('password'),
		'user_type_id'   => $faker->randomElement($array = [1, 2, 3]),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
	$c = \App\Customer::all('id');
	$id = $c[ rand(0, (count($c) - 1)) ]->id;
	return [
		"id"              => $faker->numerify('OD-########'),
		"customer_id"     => $id,
		"user_id"         => 2,
		"order_status_id" => $faker->randomElement($array = [1, 2, 3]),
		"sync_id"         => $faker->randomElement($array = [1, 2, 3]),
	];
});

$factory->define(App\OrderDetail::class, function (Faker\Generator $faker) {
	$od = \App\Product::all('id');
	$pd = $od[ rand(0, (count($od) - 1)) ]->id;

	return
		[
			"order_id"   => null,
			"product_id" => $pd,
			"quantity"   => rand(100, 2000),
		];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
	return
		[
			"id"                 => ucfirst($faker->randomLetter) . $faker->numerify('-###'),
			"name"               => $faker->company,
			"vat_number"         => $faker->randomNumber(5),
			"address"            => $faker->address,
			"city"               => $faker->city,
			"telephone"          => $faker->phoneNumber,
			"fax"                => $faker->phoneNumber,
			"email"              => $faker->companyEmail,
			"contact_person"     => $faker->name,
			"contact_position"   => $faker->job_title,
			"contact_cell"       => $faker->phoneNumber,
			"customer_status_id" => $faker->randomElement([1, 2, 3]),
			"customer_type_id"   => $faker->randomElement([1, 2, 3]),
		];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
	$od = $faker->numerify('PDT-########');
	return
		[
			"id"          => $od,
			"Description" => $faker->randomElement(['Coke', 'Fanta', 'Sprite']) . " " . $faker->randomElement([300, 330, 500, 1000, 2000]) . " ml",
			"category_id" => 1,
			"price"       => rand(5, 20),
			"image"       => $faker->imageUrl(150, 150),
		];
});