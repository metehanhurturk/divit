<?php

namespace Tests\Feature;

use Divit\Models\Project;
use Divit\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function guests_cannot_manage_projects()
    {
        $project = factory(Project::class)->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path() .'/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }


    /**
     * @test
     */
    public function a_user_can_create_a_project()
    {
        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General notes here.'
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee(Str::limit($attributes['description'], 100))
            ->assertSee($attributes['notes']);
    }


    /**
     * @test
     */
    public function a_user_can_update_a_project()
    {
        $project = factory(Project::class)->create();

        $this->actingAs($project->owner)
            ->patch(
                $project->path(),
                [
                    'title' => 'Updated!',
                    'description' => 'Updated!',
                    'notes' => 'Updated!'
                ]
            )
            ->assertRedirect($project->path());

        $this->get($project->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('projects', ['notes' => 'Updated!']);
    }


    /**
     * @test
     */
    public function a_user_can_update_a_projects_general_notes()
    {
        $project = factory(Project::class)->create();

        $this->actingAs($project->owner)
            ->patch($project->path(), ['notes' => 'Updated!']);

        $this->assertDatabaseHas('projects', ['notes' => 'Updated!']);
    }


    /**
     * @test
     */
    public function a_user_can_view_their_project()
    {
        $this->signIn();

        $project = factory(Project::class)->create(
            [
                'owner_id' => auth()->id()
            ]
        );

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee(Str::limit($project->description, 100));
    }


    /**
     * @test
     */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);
    }


    /**
     * @test
     */
    public function an_authenticated_user_cannot_update_the_projects_of_others()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->patch($project->path(), [])->assertStatus(403);
    }


    /**
     * @test
     */
    public function a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw(
            [
                'title' => ''
            ]
        );

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }


    /**
     * @test
     */
    public function a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw(
            [
                'description' => ''
            ]
        );

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
