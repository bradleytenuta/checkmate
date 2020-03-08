<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\User;
use App\GlobalRole;

/**
 * Creates a user item.
 */
$factory->define(User::class, function (Faker $faker) {
    // A custom fake email to insure faker doesnt reuse the same email address.
    $domain = "example.com";
    $randomWord = $faker->word;
    $email = $faker->numberBetween($min = 1, $max = 9000) . $randomWord . $faker->numberBetween($min = 1, $max = 9000) . "@" . $domain;

    return [
        'firstname' => $faker->firstName(),
        'surname' => $faker->lastName(),
        'email' => $email,
        'password' => $faker->password(),
        'global_role_id' => GlobalRole::inRandomOrder()->first()->id
    ];
});