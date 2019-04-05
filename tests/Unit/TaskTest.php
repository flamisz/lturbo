<?php

namespace Tests\Unit;

use App\Task;
use App\User;
use Tests\TestCase;
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
}
