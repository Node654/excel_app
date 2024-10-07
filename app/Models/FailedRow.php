<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;

class FailedRow extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $table = 'failed_rows';

    public static function insertFailedRows(array $map)
    {
        foreach ($map as $value) {
            FailedRow::create([
                'key' => Arr::get($value, 'key'),
                'message' => Arr::get($value, 'message'),
                'task_id' => Arr::get($value, 'task_id'),
                'row' => Arr::get($value, 'row'),
            ]);
        }
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}
