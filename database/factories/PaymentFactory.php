<?php

use App\Client;
use App\Payment;
use App\Project;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'client_id' => function() {
            return factory(Client::class)->create()->id;
        },
        'project_id' => function() {
            return factory(Project::class)->create()->id;
        },
        'amount' => 5000,
        'paid_on' => Carbon::now()
    ];
});
