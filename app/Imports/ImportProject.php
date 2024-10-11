<?php

namespace App\Imports;

use App\Factory\Project\ProjectFactory;
use App\Models\FailedRow;
use App\Models\Project;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ImportProject implements SkipsOnFailure, ToCollection, WithHeadingRow, WithValidation
{
    public function __construct(
        private Task $task
    ) {}

    public function collection(Collection $collection)
    {
        $typesMap = $this->getTypesMap(Type::all());
        foreach ($collection as $row) {

            if (! isset($row['naimenovanie'])) {
                continue;
            }
            $projectFactory = ProjectFactory::make($typesMap, $row);
            Project::updateOrCreate($projectFactory);
        }
    }

    private function getTypesMap(Collection $types): array
    {
        $map = [];
        foreach ($types as $type) {
            $map[$type->title] = $type->id;
        }

        return $map;
    }

    public function rules(): array
    {
        return [
            'tip' => 'required|string',
            'naimenovanie' => 'required|string',
            'data_sozdaniia' => 'required|int',
            'podpisanie_dogovora' => 'required|int',
            'dedlain' => 'nullable|int',
            'setevik' => 'nullable|string',
            'nalicie_autsorsinga' => 'nullable|string',
            'nalicie_investorov' => 'nullable|string',
            'sdaca_v_srok' => 'nullable|string',
            'vlozenie_v_pervyi_etap' => 'nullable|int',
            'vlozenie_vo_vtoroi_etap' => 'nullable|int',
            'vlozenie_v_tretii_etap' => 'nullable|int',
            'vlozenie_v_cetvertyi_etap' => 'nullable|int',
            'kolicestvo_ucastnikov' => 'nullable|int',
            'kolicestvo_uslug' => 'nullable|int',
            'kommentarii' => 'nullable|string',
            'znacenie_effektivnosti' => 'nullable|numeric',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $map = [];
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $item) {
                $map[] = [
                    'key' => $failure->attribute(),
                    'message' => $item,
                    'task_id' => $this->task->id,
                    'row' => $failure->row(),
                ];
            }
        }

        if (! empty($map)) {
            $this->task->update([
                'status' => 3,
            ]);
            FailedRow::insertFailedRows($map);
        }
    }

    public function customValidationAttributes()
    {
        return [
            'tip' => 'Тип',
            'data_sozdaniia' => 'Дата создания',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'tip' => 'Тип должен быть строкой!',
        ];
    }
}
