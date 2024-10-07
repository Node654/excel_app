<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $with = ['user', 'file'];
    protected $withCount = ['failedRows'];
    protected $table = 'tasks';

    private const STATUS_PENDING = 1;
    private const STATUS_SUCCESS = 2;
    private const STATUS_ERROR = 3;

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Импорт в процессе обработки!',
            self::STATUS_SUCCESS => 'Импорт данных прошел успешно!',
            self::STATUS_ERROR => 'Ошибка валидации во время импорта!',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function failedRows(): HasMany
    {
        return $this->hasMany(FailedRow::class, 'task_id', 'id');
    }
}
