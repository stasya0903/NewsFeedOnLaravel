<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\News\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'category_id'=> rand(1,4),
        'title' => $faker->realText(rand(20,50)),
        'text' => $faker->realText(rand(1000,3000)),
        'isPrivate' => (bool)rand(0, 1),
    ];
});
