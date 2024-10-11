<?php

namespace App\Imports;

use App\Factory\Project\ProjectDynamicFactory;
use App\Models\FailedRow;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Validators\Failure;

class ProjectDynamicImport implements SkipsOnFailure, ToCollection, WithValidation, WithStartRow, WithEvents
{
    use RegistersEventListeners;

    const STATIC_ROW = 12;
    private static array $headingRows = [];

    public function __construct(
        private Task $task
    ) {}

    public function collection(Collection $collection)
    {
        $typesMap = $this->getTypesMap(Type::all());
        foreach ($collection as $row) {
            if (! isset($row[1])) continue;
            $map = $this->getRowsMap($row);
            $projectDynamicFactory = ProjectDynamicFactory::make($typesMap, $map['static']);
            $project = Project::updateOrCreate($projectDynamicFactory);
            $headingDynamicRows = $this->getRowsMap(self::$headingRows)['dynamic'];
            foreach ($map['dynamic'] as $key => $value)
            {
                Payment::updateOrCreate([
                    'project_id' => $project->id,
                    'title' => $headingDynamicRows[$key]
                ], [
                    'project_id' => $project->id,
                    'title' => $headingDynamicRows[$key],
                    'value' => $value
                ]);
            }
        }
    }

    private function getRowsMap(Collection|array $row): array
    {
        $staticRow = [];
        $dynamicRow = [];

        foreach ($row as $key => $value)
        {
            if (isset($value))
            {
                $key > 12 ? $dynamicRow[$key] = $value : $staticRow[$key] = $value;
            }
        }

        return [
            'static' => $staticRow,
            'dynamic' => $dynamicRow
        ];
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
        return array_replace([
            0 => 'required|string',
            1 => 'required|string',
            2 => 'required|int',
            9 => 'required|int',
            7 => 'nullable|int',
            3 => 'nullable|string',
            5 => 'nullable|string',
            6 => 'nullable|string',
            8 => 'nullable|string',
            4 => 'nullable|int',
            10 => 'nullable|int',
            11 => 'nullable|string',
            12 => 'nullable|numeric',
        ], $this->validationDynamicRow());
    }

    public function onFailure(Failure ...$failures)
    {
        processFailures($failures, $this->task);
    }

    public function customValidationAttributes()
    {
        return [
            0 => 'string',
            1 => 'Дата создания',
        ];
    }

    public function customValidationMessages()
    {
        return [
            0 => 'Тип должен быть строкой!',
        ];
    }

    public function startRow(): int
    {
        return 2;
    }

    public static function beforeSheet(BeforeSheet $event)
    {
        self::$headingRows = $event->getSheet()->getDelegate()->toArray()[0];
    }

    private function validationDynamicRow()
    {
        $headings = $this->getRowsMap(self::$headingRows)['dynamic'];
        foreach ($headings as $key => $value)
        {
            $headings[$key] = 'required|int';
        }

        return $headings;
    }
}
