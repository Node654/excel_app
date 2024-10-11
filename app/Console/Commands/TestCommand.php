<?php

namespace App\Console\Commands;

use App\Imports\ImportProject;
use App\Imports\ProjectDynamicImport;
use App\Models\Task;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new ProjectDynamicImport(Task::first()), 'files/projects2.xlsx', 'public');
    }
}
