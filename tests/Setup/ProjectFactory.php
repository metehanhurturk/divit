<?php

namespace Tests\Setup;

use Divit\Models\Project;
use Divit\Models\Task;
use Divit\Models\User;

class ProjectFactory
{

    /**
     * @var User
     */
    protected $user;


    /**
     * @var int
     */
    protected $tasksCount = 0;


    /**
     * @param $count
     */
    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }


    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }


    /**
     * @return Project
     */
    public function create()
    {
        $project = factory(Project::class)->create(
            [
                'owner_id' => $this->user ?? factory(User::class),
            ]
        );

        factory(Task::class, $this->tasksCount)->create(
            [
                'project_id' => $project->id,
            ]
        );

        return $project;
    }
}

app(ProjectFactory::class)->create();
