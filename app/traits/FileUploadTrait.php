<?php

namespace App\Traits;

trait FileUploadTrait
{
    /**
     * Upload a file to public/upload/{folder} and return relative path
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @param string|null $existingFile
     * @return string
     */
    public function uploadFile($file, $folder, $existingFile = null)
    {
        if ($file) {
            // Define the target directory
            $targetFolder = public_path("upload/{$folder}");

            // Ensure the folder exists
            if (!file_exists($targetFolder)) {
                mkdir($targetFolder, 0755, true);
            }

            // Delete existing file if present
            if ($existingFile && file_exists(public_path($existingFile))) {
                unlink(public_path($existingFile));
            }

            // Generate a unique filename
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Move the uploaded file to the target folder
            $file->move($targetFolder, $fileName);

            // Return **relative path** (e.g., 'upload/user/xyz.jpg')
            return "upload/{$folder}/{$fileName}";
        }

        // Keep existing file path if no new file
        return $existingFile;
    }
}
