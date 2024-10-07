<?php

namespace App\Exceptions;

use Exception;

class ImportExcelFileException extends Exception
{
    protected $message = 'Ошибка в данных при импорте Excel файла!';
}
