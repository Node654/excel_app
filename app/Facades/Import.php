<?php

namespace App\Facades;

use App\Services\Import\ImportService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string putAndCreate($dataFile)
 *
 * @see ImportService
 */
class Import extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'import_service';
    }
}
