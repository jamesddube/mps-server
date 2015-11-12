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
    return [
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'job_title' => $faker->job_title,
        'user_type' => $faker->name,
        'email' => strtolower($faker->firstName."@mbc.co.zw"),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\OrderModel::class, function (Faker\Generator $faker) {
    return [
        "order_id" => $faker->numerify('OD-########'),
        "customer_id" => ucfirst($faker->randomLetter).$faker->numerify('-###'),
        "sales_rep" => 2,
        "order_status" => $faker->randomElement($array = array ('draft','unprocessed','processed')),
        "sync_status" =>1,
    ];
});

$factory->define(App\OrderDetailsModel::class, function (Faker\Generator $faker) {
    $od = $faker->numerify('OD-########');
    return [
        "order_details_id" => $od,
        "order_id" => $od,
        "product_id" =>1030,
        "quantity" => 78,
    ];
});
