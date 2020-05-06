<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'name' => $faker->name,
        'line1' => $faker->address()->streetAddress,
        'locality' => $faker->address()->city,
        'region' => $faker->address()->stateAbbr,
        'postal_code' => $faker->address()->postcode,
        'country' => $faker->address()->country,
    ];
});
