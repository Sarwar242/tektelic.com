<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Sliders::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'text' => $faker->slug(5),
    ];
});
