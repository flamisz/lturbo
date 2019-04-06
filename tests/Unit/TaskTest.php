<?php

namespace Tests\Unit;

use App\Task;
use App\Time;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $task = factory(Task::class)->create();

        $this->assertEquals("/tasks/{$task->id}", $task->path());
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $task = factory(Task::class)->create();

        $this->assertInstanceOf(User::class, $task->owner);
    }

    /** @test */
    public function it_can_start()
    {
        $task = factory(Task::class)->create();

        $this->assertDatabaseMissing('times', ['task_id' => $task->id]);

        $time = $task->start();

        $this->assertDatabaseHas('times', ['task_id' => $task->id]);
    }

    /** @test */
    public function it_can_stop()
    {
        $task = factory(Task::class)->create();

        $time = $task->start();

        $this->assertNull($time->stop);

        $time = $task->stop();

        $this->assertNotNull($time->stop);
    }

    /** @test */
    public function it_has_times()
    {
        $task = factory(Task::class)->create();
        $time = factory(Time::class)->create(['task_id' => $task->id]);

        $this->assertCount(1, $task->times);
        $this->assertTrue($task->times->contains($time));
    }

    /** @test */
    public function it_knows_about_unstopped_time()
    {
        $task = factory(Task::class)->create();
        factory(Time::class)->states('started')->create(['task_id' => $task]);

        $this->assertEquals(true, $task->hasUnstoppedTime());

        $task = factory(Task::class)->create();
        factory(Time::class)->states('stopped')->create(['task_id' => $task]);
        $this->assertEquals(false, $task->hasUnstoppedTime());
    }

    /** @test */
    public function it_knows_the_sum_time_length()
    {
        $task = factory(Task::class)->create();
        factory(Time::class)
            ->create([
                'task_id' => $task->id,
                'start' => new Carbon('2018-09-23 18:00:00'),
                'stop' => new Carbon('2018-09-23 18:05:00'),
            ]);

        factory(Time::class)
            ->create([
                'task_id' => $task->id,
                'start' => new Carbon('2018-09-23 19:00:00'),
                'stop' => new Carbon('2018-09-23 19:05:00'),
            ]);

        factory(Time::class)
            ->create([
                'task_id' => $task->id,
                'start' => new Carbon('2018-09-23 20:00:00'),
                'stop' => new Carbon('2018-09-23 20:05:00'),
            ]);

        $this->assertEquals($task->length->minutes, 15);
    }
}
