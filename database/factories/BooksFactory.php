<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\Book;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'author_id' => Author::all()->random()->id,
        'category_id' => Category::all()->random()->id,
        'image' => $faker->image,
        'introduce' => $faker->paragraph,
        'price' => $faker->randomNumber(5),
        'quantity' => $faker->randomNumber(2),


    ];
});
