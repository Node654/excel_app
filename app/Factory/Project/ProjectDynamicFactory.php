<?php

namespace App\Factory\Project;

use App\Models\Type;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectDynamicFactory
{
    use ProjectFactoryTrait;

    public function __construct(
        private $typeId,
        private $title,
        private $createdAtTime,
        private $contractedAt,
        private $deadline,
        private $isNetwork,
        private $isOnTime,
        private $hasOutsource,
        private $hasInvestors,
        private $workerCount,
        private $serviceCount,
        private $efficiencyValue,
        private $comment,
    ) {}

    public static function make(array $map, array $row): static
    {
        return new static(
            static::getTypeId($map, $row[0]),
            $row[1],
            Date::excelToDateTimeObject($row[2]),
            Date::excelToDateTimeObject($row[9]),
            isset($row[7]) ? Date::excelToDateTimeObject($row[7]) : null,
            isset($row[3]) ? self::getBool($row[3]) : null,
            isset($row[8]) ? self::getBool($row[8]) : null,
            isset($row[5]) ? self::getBool($row[5]) : null,
            isset($row[6]) ? self::getBool($row[6]) : null,
            $row[4] ?? null,
            $row[10] ?? null,
            $row[12] ?? null,
            $row[11] ?? null,
        );
    }

    private static function getTypeId(array $arrMap, string $type): int
    {
        return isset($arrMap[$type]) ? $arrMap[$type] : Type::create([
            'title' => $type,
        ])->id;
    }

    private static function getBool(?string $isYes): bool
    {
        return $isYes === 'Да';
    }
}
