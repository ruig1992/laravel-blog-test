<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'category_id' => random_int(1, 3),
        'title' => $faker->sentence(6),
        'description' => $faker->paragraph(1),
        'content' => '<p>' . $faker->text(600) . '</p>',
        'published_at' => Carbon::now()
            ->subDays(random_int(1, 7))
            ->subHours(random_int(1, 3))
            ->format('Y-m-d H:i:s'),
        'is_published' => random_int(0, 1),
    ];
});
