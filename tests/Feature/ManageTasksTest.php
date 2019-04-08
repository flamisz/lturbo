<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_task()
    {
        $this->signIn();

        $this->get('/tasks/create')->assertStatus(200);

        $this->followingRedirects()
            ->post('/tasks', $attributes = factory(Task::class)->raw())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description']);
    }

    /** @test */
    public function a_user_can_visit_a_task()
    {
        $user = $this->signIn();

        $task = factory(Task::class)->create(['owner_id' => $user->id]);

        $this->get($task->path())
            ->assertSee($task->title)
            ->assertSee($task->description);
    }

    /** @test */
    public function guests_cannot_manage_tasks()
    {
        $task = factory(Task::class)->create();

        $this->get('/tasks')->assertRedirect('login');
        $this->get('/tasks/create')->assertRedirect('login');
        $this->get($task->path().'/edit')->assertRedirect('login');
        $this->get($task->path())->assertRedirect('login');
        $this->post('/tasks', $task->toArray())->assertRedirect('login');
    }

    /** @test */
    public function a_task_requires_a_title()
    {
        $this->signIn();

        $attributes = factory('App\Task')->raw(['title' => '']);

        $this->post('/tasks', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_tasks_of_others()
    {
        $this->signIn();

        $task = factory(Task::class)->create();

        $this->get('tasks')
            ->assertDontSee($task->title)
            ->assertDontSee($task->description);

        $this->get($task->path())->assertStatus(403);
    }
}
