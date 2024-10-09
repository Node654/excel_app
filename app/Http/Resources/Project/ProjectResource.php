<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Type\TypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'type' => new TypeResource($this->type),
            'title' => $this->title,
            'createdAtTime' => $this->created_at_time->format('Y-m-d H:i'),
            'contractedAt' => $this->contracted_at->format('Y-m-d H:i'),
            'deadline' => isset($this->deadline) ? $this->deadline->format('Y-m-d H:i') : '',
            'isNetwork' => isset($this->is_network) ? 'Да' : 'Нет',
            'isOnTime' => isset($this->is_on_time) ? 'Да' : 'Нет',
            'hasOutsource' => isset($this->has_outsource) ? 'Да' : 'Нет',
            'hasInvestors' => isset($this->has_investors) ? 'Да' : 'Нет',
            'workerCount' => $this->worker_count,
            'serviceCount' => $this->service_count
        ];
    }
}
