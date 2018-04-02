<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'titre' => $faker->title,
        'contenu' => $faker->text,
        'user_id' => $faker->numberBetween(1, 40),
    ];
});
