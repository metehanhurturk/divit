<?php

namespace Divit\Observers;

use Divit\Models\Task;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \Divit\Models\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        $task->project->recordActivity('created_task');
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        $task->project->recordActivity('deleted_task');
    }
}
