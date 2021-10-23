<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articles;
use Faker\Generator as Faker;

$factory->define(Articles::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'slug' => $faker->slug(5),
        'category_id' => 1,
        'content' => $faker->text(300),
        'date' => '2020-09-08',
    ];
});
