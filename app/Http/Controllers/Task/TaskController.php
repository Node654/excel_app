<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\FailedRow\FailedRowResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        return Inertia::render('Task/Index', ['tasks' => TaskResource::collection(Task::query()->paginate(5))]);
    }

    public function failedList(Task $task)
    {
        return Inertia::render('Task/FailedList', ['failedRows' => FailedRowResource::collection($task->failedRows()->paginate(5))]);
    }
}
