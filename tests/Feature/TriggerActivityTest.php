<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function creating_a_new_project()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity->first()->description);
    }


    /**
     * @test
     */
    public function updating_a_project()
    {
        $project = ProjectFactory::create();

        $project->update(['title' => 'Updated!']);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }


    /**
     * @test
     */
    public function creating_a_new_task()
    {
        $project = ProjectFactory::create();

        $task = $project->addTask('Some Task.');

        $this->assertCount(2, $project->activity);
        $this->assertEquals('created_task', $project->activity->last()->description);
    }


    /**
     * @test
     */
    public function completing_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch(
                $project->tasks->first()->path(),
                [
                    'body' => 'Completed!',
                    'completed' => true
                ]
            );

        $this->assertCount(3, $project->activity);
        $this->assertEquals(
            'completed_task',
            $project->activity->last()->description
        );
    }

    /**
     * @test
     */
    public function incompleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch(
                $project->tasks->first()->path(),
                [
                    'body' => 'Completed!',
                    'completed' => true
                ]
            );

        $this->assertCount(3, $project->activity);

        $this->patch(
            $project->tasks->first()->path(),
            [
                'body' => 'Marked incomplete!',
                'completed' => false
            ]
        );

        $project->refresh();

        $this->assertCount(4, $project->activity);

        $this->assertEquals(
            'uncompleted_task',
            $project->activity->last()->description
        );

    }


    public function deleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $project->tasks->first()->delete();

        $this->assertCount(3, $project->activity);

    }
}
