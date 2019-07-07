<?php

namespace Divit\Http\Controllers;

use Divit\Models\Project;
use Divit\Models\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    /**
     * @param  Project  $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Project $project)
    {
        $this->authorize('update', $project);

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }


    /**
     * @param  Project  $project
     * @param  Task  $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Project $project, Task $task)
    {
        $this->authorize('update', $project);

        request()->validate(["body" => "required"]);

        $task->update(
            [
                'body' => request('body'),
                'completed' => request()->has('completed'),
            ]
        );

        return redirect($project->path());
    }
}
