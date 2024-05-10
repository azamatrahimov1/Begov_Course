<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadFileService
{
    public static function uploadFile($file, $path)
    {
        // Generate a unique filename with a timestamp and the file's original extension
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        // Store the file in the specified path with the generated filename
        $filePath = $file->storeAs($path, $fileName);

        // Return the file path for reference
        return $filePath;
    }

    public static function deleteFile($path)
    {
        if (Storage::exists($path))
            Storage::delete($path);
        else
            return false;
        return true;
    }

}
