<?php

namespace App\Services\Import;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImportService
{
    public function putAndCreate(UploadedFile $dataFile): File
    {
        $filePath = Storage::disk('public')->put('files', $dataFile);

        return File::create([
            'path' => $filePath,
            'mime_type' => $dataFile->getClientOriginalExtension(),
            'title' => $dataFile->getClientOriginalName(),
        ]);
    }
}
