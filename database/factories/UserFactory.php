<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Domain\Models\Account;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    return [
        'id' => Str::uuid(),
        'workspace_id' => function () {
            return factory(Account::class)->create()->id;
        },
        'name' => $faker->name(),
        'email' => $faker->safeEmail(),
        'password' => Hash::make('password123'),
    ];
});
