<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Excel\StoreRequest;
use App\Jobs\ImportProjectExcelFileJob;
use App\Models\Task;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Project/Index');
    }

    public function import()
    {

        return Inertia::render('Project/Import');
    }

    public function importStore(StoreRequest $request)
    {
        $file = $request->putAndCreate();
        $task = Task::create([
            'user_id' => auth()->id(),
            'file_id' => $file->id,
        ]);
        ImportProjectExcelFileJob::dispatchSync($file->path, $task);
    }
}
