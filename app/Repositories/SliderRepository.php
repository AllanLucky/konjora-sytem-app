<?php

namespace App\Repositories;

use App\Models\Slider;
use App\Traits\FileUploadTrait;

class SliderRepository
{
    use FileUploadTrait;

    public function saveSlider(array $data, $photo = null)
    {
        if ($photo) {
            $data['image'] = $this->uploadFile($photo, 'slider');
        }

        return Slider::create($data);
    }

    public function updateSlider(array $data, $id, $photo = null)
    {
        $slider = Slider::findOrFail($id);

        if ($photo) {
            $data['image'] = $this->uploadFile(
                $photo,
                'slider',
                $slider->image // 👈 correct column
            );
        }

        $slider->update($data);

        return $slider;
    }
}
