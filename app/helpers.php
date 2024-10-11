<?php

use App\Models\FailedRow;
use App\Models\Task;

if (! function_exists('processFailures'))
{
    function processFailures(array $failures, Task $task)
    {
        $map = [];
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $item) {
                $map[] = [
                    'key' => $failure->attribute(),
                    'message' => $item,
                    'task_id' => $task->id,
                    'row' => $failure->row(),
                ];
            }
        }

        if (! empty($map)) {
            $task->update([
                'status' => 3,
            ]);
            FailedRow::insertFailedRows($map);
        }
    }
}
