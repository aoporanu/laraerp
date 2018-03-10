<?php

use Faker\Generator as Faker;

$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
        'sku' => $faker->unique()->bankAccountNumber,
        'name' => $faker->unique()->firstName
    ];
});
