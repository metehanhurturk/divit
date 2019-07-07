<?php

namespace Divit\Policies;

use Divit\Models\Project;
use Divit\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * @param  User  $user
     * @param  Project  $project
     * @return bool
     */
    public function update(User $user, Project $project)
    {
        return $user->is($project->owner);
    }
}
