<?php

use Faker\Generator as Faker;

$factory->define(App\Reponse::class, function (Faker $faker) {
    return [
        'contenu' => $faker->text,
        'commentaire_id' => $faker->numberBetween(1, 100),
        'user_id' => $faker->numberBetween(1, 40),
    ];
});
