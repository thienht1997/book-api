<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\Book;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->catchPhrase,
        'author_id' => Author::all()->random()->id,
        'category_id' => Category::all()->random()->id,
        'image' =>$faker->randomElement($array = array('40035_V1.jpg','1.jpeg' )),
        'introduce' => $faker->realText($maxNbChars = 800, $indexSize = 2),
        'price' => $faker->randomNumber(5),
        'quantity' => $faker->randomNumber(2),


    ];
});
