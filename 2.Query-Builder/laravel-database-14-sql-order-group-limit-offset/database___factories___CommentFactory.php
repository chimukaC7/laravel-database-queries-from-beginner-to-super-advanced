<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text(500),
        'user_id' => $faker->numberBetween(1,3),
        'rating' => $faker->numberBetween(1,5),
    ];
});

