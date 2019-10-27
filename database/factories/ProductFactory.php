<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
	    'description' => $faker->sentence,
	    'body' => $faker->paragraph(5, true),
	    'price' => $faker->randomFloat(2, 1, 10),
	    'slug' => $faker->slug,
    ];
});
