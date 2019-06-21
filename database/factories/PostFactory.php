<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'body' => $faker->text,
        'category_id' => random_int(1, 3),
        'user_id' => 1,
    ];
});
