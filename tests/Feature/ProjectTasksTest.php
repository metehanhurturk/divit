<?php

namespace Tests\Feature;

use Divit\Models\Project;
use Divit\Models\User;
use Divit\Models\Task;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->get($project->path() . '/tasks')
            ->assertRedirect('login');
    }


    /**
     * @task
     */
    public function only_the_owner_may_add_tasks()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->post(
                $project->path() . '/tasks',
                [
                    'body' => 'Test Task'
                ]
            )
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test Task']);
    }


    /**
     * @task
     */
    public function only_the_owner_may_update_tasks()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $task = $project->addTask('Test Task');

        $this->actingAs($project->owner)
            ->patch(
                $task->path(),
                [
                    'body' => 'Test Task Updated'
                ]
            )
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test Task Updated']);
    }


    /**
     * @test
     */
    public function a_project_can_have_tasks()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post(
                $project->path() . '/tasks',
                [
                    'body' => 'Test Task'
                ]
            );

        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee('Test Task');
    }


    /**
     * @test
     */
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch(
                $project->tasks->first()->path(),
                [
                    'body' => 'Task Updated!'
                ]
            );

        $this->assertDatabaseHas('tasks', ['body' => 'Task Updated!']);
    }



    /**
     * @test
     */
    public function a_task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch(
                $project->tasks->first()->path(),
                [
                    'body' => 'Task Completed!',
                    'completed' => true
                ]
            );

        $this->assertDatabaseHas(
            'tasks',
            [
                'body' => 'Task Completed!',
                'completed' => true
            ]
        );
    }


    /**
     * @test
     */
    public function a_task_can_be_marked_as_incompleted()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch(
                $project->tasks->first()->path(),
                [
                    'body' => 'Task Updated!',
                    'completed' => true
                ]
            );

        $this->patch(
            $project->tasks->first()->path(),
            [
                'body' => 'Task Updated!',
                'completed' => false
            ]
        );

        $this->assertDatabaseHas(
            'tasks',
            [
                'body' => 'Task Updated!',
                'completed' => false
            ]
        );
    }


    /**
     * @test
     */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::create();

        $attributes = factory(Task::class)->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
