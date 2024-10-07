<?php

namespace App\Factory\Project;

use App\Models\Type;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectFactory
{
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
        private $investingFirstStep,
        private $investingTwoStep,
        private $investingThreeStep,
        private $investingFourStep,
        private $efficiencyValue,
        private $comment,
    ) {}

    public static function make(array $map, Collection $row): static
    {
        return new static(
            static::getTypeId($map, $row['tip']),
            $row['naimenovanie'],
            Date::excelToDateTimeObject($row['data_sozdaniia']),
            Date::excelToDateTimeObject($row['podpisanie_dogovora']),
            isset($row['dedlain']) ? Date::excelToDateTimeObject($row['dedlain']) : null,
            isset($row['setevik']) ? self::getBool($row['setevik']) : null,
            isset($row['sdaca_v_srok']) ? self::getBool($row['sdaca_v_srok']) : null,
            isset($row['nalicie_autsorsinga']) ? self::getBool($row['nalicie_autsorsinga']) : null,
            isset($row['nalicie_investorov']) ? self::getBool($row['nalicie_investorov']) : null,
            $row['kolicestvo_ucastnikov'] ?? null,
            $row['kolicestvo_uslug'] ?? null,
            $row['vlozenie_v_pervyi_etap'] ?? null,
            $row['vlozenie_vo_vtoroi_etap'] ?? null,
            $row['vlozenie_v_tretii_etap'] ?? null,
            $row['vlozenie_v_cetvertyi_etap'] ?? null,
            $row['znacenie_effektivnosti'] ?? null,
            $row['kommentarii'] ?? null,
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

    public function getValues(): array
    {
        $project = get_object_vars($this);
        $row = [];
        foreach ($project as $key => $value) {
            $row[Str::snake($key)] = $value;
        }

        return $row;
    }
}
