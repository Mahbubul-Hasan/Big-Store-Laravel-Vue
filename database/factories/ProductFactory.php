<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "category_id" => Category::all()->random()->id,
        "name" => $faker->realText(50),
        "code" => "QWE".random_int(10, 10000),
        "price" => random_int(100, 1000),
        "short_description" => $faker->realText(150),
        "long_description" => $faker->realText(1000),
        "photo" => $faker->imageUrl(),
    ];
});
