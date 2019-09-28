<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement($array = array(
                    'Essay', 'Memoir', 'Self-help', 'Speech','Textbook', 'Romantic', 'Horror', 'Legend'
                )),
    ];
});
