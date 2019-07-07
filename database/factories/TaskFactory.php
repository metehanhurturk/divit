<?php

use Divit\Models\Task;
use Divit\Models\Project;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/* @var $factory \Illuminate\Database\Eloquent\Factory */
$factory->define(
    Task::class,
    function (Faker $faker) {
        return [
            'project_id' => factory(Project::class),
            'body' => Str::limit($faker->sentence, 100),
            'completed' => false
        ];
    }
);
