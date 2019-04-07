<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskTimeController extends Controller
{
    public function start(Task $task)
    {
        $this->authorize('update', $task);

        if ($task->hasUnstoppedTime()) {
            abort(422, 'The task has unstopped time.');
        }

        $task->start();

        if (request()->ajax()) {
            $task->load('times');
            return view('tasks.times', compact('task'));
        }

        return back();
    }

    public function stop(Task $task)
    {
        $this->authorize('update', $task);

        if (! $task->hasUnstoppedTime()) {
            abort(422, 'The task has no unstopped time.');
        }

        $task->stop();

        return back();
    }
}
