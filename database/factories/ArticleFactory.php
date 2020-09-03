<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'category_id' => random_int(1, 3),
        'title' => $faker->sentence(),
        'slug' => $faker->unique()->safeEmail,
        'description' => $faker->paragraph(1),
        'content' => $faker->text(600),
        'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'is_published' => random_int(0, 1),
    ];
});
