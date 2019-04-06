<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskTimeController extends Controller
{
    public function start(Task $task)
    {
        $this->authorize('update', $task);

        $task->start();
    }

    public function stop(Task $task)
    {
        $this->authorize('update', $task);

        $task->stop();
    }
}
