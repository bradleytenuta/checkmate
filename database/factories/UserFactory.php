<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\User;
use App\GlobalRole;

/**
 * Creates a user item.
 */
// TODO: Sometimes faker we reuse the same email. Fix this bug as it leads to duplication.
$factory->define(User::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName(),
        'surname' => $faker->lastName(),
        'email' => $faker->safeEmail(),
        'password' => $faker->password(),
        'global_role_id' => GlobalRole::inRandomOrder()->first()->id
    ];
});