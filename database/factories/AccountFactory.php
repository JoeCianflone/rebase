<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Domain\Models\Account;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'id' => Str::uuid(),
        'name' => $faker->company(),
        'address1' => $faker->streetAddress(),
        'city' => $faker->city(),
        'state' => $faker->state(),
        'zip' => $faker->postcode(),
        'has_agreed_to_terms' => true
    ];
});
