<?php

use Faker\Generator as Faker;

$factory->define(App\Commentaire::class, function (Faker $faker) {
    return [
        'contenu' => $faker->text(100),
        'user_id' => $faker->numberBetween(1, 40),
        'article_id' => $faker->numberBetween(1, 100),
    ];
});
