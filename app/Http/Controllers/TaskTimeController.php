<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskTimeController extends Controller
{
    public function toggle(Task $task)
    {
        $this->authorize('update', $task);

        $task->toggle();

        if (request()->ajax()) {
            $task->load('times');

            return view('tasks.times', compact('task'));
        }

        return back();
    }
}
