<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

/**
 * Creates a module item.
 */
$factory->define(App\Module::class, function (Faker $faker) {
    return [
        'name' => $faker->word()
    ];
});