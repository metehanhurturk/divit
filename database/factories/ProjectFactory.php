<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Divit\Models\Project;
use Divit\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(
    Project::class,
    function (Faker $faker) {
        $title = Str::limit($faker->sentence(4), 80);
        $description = Str::limit($faker->paragraph, 90);
        return [
            'title' => $title,
            'description' => $description,
            'owner_id' => factory(User::class)
        ];
    }
);
