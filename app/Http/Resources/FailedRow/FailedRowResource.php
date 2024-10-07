<?php

namespace App\Http\Resources\FailedRow;

use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FailedRowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'message' => $this->message,
            'row' => $this->row,
            'taskId' => new TaskResource($this->task),
            'createdAt' => $this->created_at->diffForHumans(),
        ];
    }
}
