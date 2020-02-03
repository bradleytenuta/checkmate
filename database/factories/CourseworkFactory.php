<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

/**
 * Creates a coursework item.
 */
$factory->define(App\Coursework::class, function (Faker $faker) {
    return [
        'module_id' => App\Module::inRandomOrder()->first()->id,
        'name' => $faker->word()." ".$faker->word(),
        'description' => $faker->sentence($nbWords = 70, $variableNbWords = true),
        'maximum_score' => 100,
        'deadline' => $faker->dateTimeBetween('-1 week', '+1 week')
    ];
});