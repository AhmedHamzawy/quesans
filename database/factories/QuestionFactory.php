<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;
use App\Category;
use App\User;

$factory->define(Question::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'category_id' => function(){ return Category::all()->random(); },
        'body' => $faker->text,
        'user_id' => function(){ return User::all()->random(); },
    ];
});
