<?php


namespace App\Repositories;

use App\Models\CourseLecture;
use App\Traits\FileUploadTrait;

class LectureRepository
{
    use FileUploadTrait; // Use the FileUploadTrait



    public function createLecture($data)
    {

       return CourseLecture::create($data);

    }



    public function updateLecture($data, $id)
    {
       $lecture = CourseLecture::find($id);


         $lecture->update($data);

         return $lecture->fresh();


    }

}


