<?php

use Illuminate\Database\Seeder;
use Divit\Models\User;
use Divit\Models\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $master = User::find(1);

        factory(Project::class, 10)->create(
            [
                'owner_id' => $master->id
            ]
        );
    }
}
