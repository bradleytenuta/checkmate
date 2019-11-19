<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

/**
 * Creates a user item.
 */
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName(),
        'surname' => $faker->lastName(),
        'email' => $faker->safeEmail(),
        'password' => $faker->password()
    ];
});