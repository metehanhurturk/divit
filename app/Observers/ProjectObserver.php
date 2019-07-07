<?php

namespace Divit\Observers;

use Divit\Models\Project;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \Divit\Models\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $project->recordActivity('created', $project);
    }


    /**
     * Handle the project "updated" event.
     *
     * @param  \Divit\Models\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        $project->recordActivity('updated', $project);
    }

}
