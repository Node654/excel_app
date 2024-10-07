<?php

namespace App\Jobs;

use App\Imports\ImportProject;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;

class ImportProjectExcelFileJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $filePath,
        private Task $task
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->task->update([
            'status' => 2,
        ]);
        Excel::import(new ImportProject($this->task), $this->filePath, 'public');
    }
}
