<?php

namespace Divit\Http\Controllers;

use Divit\Http\Requests\UpdateProjectRequest;
use Divit\Models\Project;
use Divit\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $projects =  auth()->user()->projects;

        return view('projects.index', ['projects' => $projects]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('projects.create');
    }


    /**
     * @param  Project  $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', ['project' => $project]);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $project = auth()->user()->projects()->create($this->validateRequest());

        return redirect($project->path());
    }


    /**
     * @param  Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Project $project)
    {
        return view('projects.edit', ['project' => $project]);
    }


    /**
     * @param  UpdateProjectRequest $request
     * @param  Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateProjectRequest $request)
    {
        return redirect($request->save()->path());
    }


    /**
     * Return validation rules for project store/update
     *
     * @return array All validation rules
     */
    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required|max:100',
            'notes' => 'nullable',
        ]);
    }
}
