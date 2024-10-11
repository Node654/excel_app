<?php

namespace App\Factory\Project;

use Illuminate\Support\Str;

trait ProjectFactoryTrait
{
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
