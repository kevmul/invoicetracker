<?php

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => 'Fake Name',
        'email' => 'fake@example.com',
        'phone' => '555-123-4567'
    ];
});
