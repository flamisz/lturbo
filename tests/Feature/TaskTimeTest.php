<?php

namespace Tests\Feature;

use App\Task;
use App\Time;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTimeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_start_a_task()
    {
        $task = factory(Task::class)->create();

        $this->post('/tasks/' . $task->id  . '/start')->assertRedirect('login');
    }

    /** @test */
    public function guest_cannot_stop_a_task()
    {
        $task = factory(Task::class)->create();

        $this->post('/tasks/' . $task->id  . '/stop')->assertRedirect('login');
    }

    /** @test */
    public function a_task_cannot_be_started_by_other_user()
    {
        $user = $this->signIn();

        $task = factory(Task::class)->create();

        $this->post('/tasks/' . $task->id  . '/start')
            ->assertStatus(403);

        $this->assertDatabaseMissing('times', ['task_id' => $task->id]);
    }

    /** @test */
    public function a_task_cannot_be_stopped_by_other_user()
    {
        $user = $this->signIn();

        $task = factory(Task::class)->create();

        $this->post('/tasks/' . $task->id  . '/stop')
            ->assertStatus(403);
    }

    /** @test */
    public function a_task_can_be_started_by_the_owner()
    {
        $user = $this->signIn();

        $task = factory(Task::class)->create(['owner_id' => $user->id]);

        $this->assertDatabaseMissing('times', ['task_id' => $task->id]);

        $this->post('/tasks/' . $task->id  . '/start');

        $this->assertDatabaseHas('times', ['task_id' => $task->id]);
    }

    /** @test */
    public function a_task_can_be_stopped_by_the_owner()
    {
        $user = $this->signIn();

        $task = factory(Task::class)->create(['owner_id' => $user->id]);
        $time = factory(Time::class)->states('started')->create(['task_id' => $task]);

        $this->assertNull($task->times[0]->stop);

        $this->post('/tasks/' . $task->id  . '/stop');

        $this->assertNotNull($task->fresh()->times[0]->stop);
    }
}
