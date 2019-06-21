<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\PostAttachment::class, function (Faker $faker) {
    return [
        'path' => $faker->imageUrl,
        'post_id' => random_int(1, 10),
    ];
});
