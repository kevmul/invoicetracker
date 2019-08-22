<?php

use App\Client;
use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => 'Fake Project',
        'client_id' => function() {
            return factory(Client::class)->create()->id;
        },
        'amount' => 9900
    ];
});
