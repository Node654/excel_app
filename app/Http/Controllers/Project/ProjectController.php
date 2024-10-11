<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Excel\StoreRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Jobs\ImportProjectExcelFileJob;
use App\Models\Project;
use App\Models\Task;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate();
        return Inertia::render('Project/Index', ['projects' => ProjectResource::collection($projects)]);
    }

    public function import()
    {

        return Inertia::render('Project/Import');
    }

    public function importStore(StoreRequest $request)
    {
        $fileAndType = $request->putAndCreate();
        $task = Task::create([
            'user_id' => auth()->id(),
            'file_id' => $fileAndType['file']->id,
            'type' => $fileAndType['type']
        ]);
        ImportProjectExcelFileJob::dispatchSync($fileAndType['file']->path, $task);
    }
}
