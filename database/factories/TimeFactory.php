<?php

use Faker\Generator as Faker;

$factory->define(App\Time::class, function (Faker $faker) {
    return [
        'start' => now(),
        'stop' => now()->addMinute(),
        'task_id' => factory(App\Task::class)
    ];
});

$factory->state(App\Time::class, 'started', [
    'start' => now(),
    'stop' => null,
]);

$factory->state(App\Time::class, 'stopped', [
    'start' => now(),
    'stop' => now()->addMinute(),
]);
