<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Models\Product;
use App\Models\SubImage;
use Faker\Generator as Faker;

$factory->define(SubImage::class, function (Faker $faker) {
    return [
        "product_id" => Product::all()->random()->id,
        "sub_image" => $faker->imageUrl(),
    ];
});
