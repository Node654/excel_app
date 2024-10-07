<?php

namespace App\Http\Requests\Excel;

use App\Facades\Import;
use App\Models\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        if (! in_array($this->file->getClientOriginalExtension(), ['xlsx'])) {
            throw ValidationException::withMessages(['The file should be: xlsx']);
        }

        return [
            'file' => 'required|file',
        ];
    }

    public function putAndCreate(): File
    {
        return Import::putAndCreate($this->validated()['file']);
    }
}
