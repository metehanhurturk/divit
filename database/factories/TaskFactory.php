<?php

use Divit\Models\Task;
use Divit\Models\Project;
use Faker\Generator as Faker;

/* @var $factory \Illuminate\Database\Eloquent\Factory */
$factory->define(
    Task::class,
    function (Faker $faker) {
        return [
            'body' => $faker->sentence,
            'project_id' => factory(Project::class)
        ];
    }
);
