<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'bestseller'   => $this->bestseller ?? 0,
            'featured'     => $this->featured ?? 0,
            'highestrated' => $this->highestrated ?? 0,
            'status'       => $this->status ?? 0,
        ]);
    }

    public function rules(): array
    {
        $courseId = $this->route('course');

        return [
            'category_id' => 'required|integer|exists:categories,id',
            'subcategory_id' => 'required|integer|exists:sub_categories,id',
            'instructor_id' => 'required|integer|exists:users,id',

            'course_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'course_title' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',

            'course_name_slug' => [
                'nullable',
                'string',
                Rule::unique('courses', 'course_name_slug')->ignore($courseId),
            ],

            'description' => 'required|string',
            'video_url' => 'required|url|max:2048',
            'label' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:50',
            'resources' => 'nullable|string|max:255',
            'certificate' => 'nullable|string|max:100',

            'selling_price' => 'required|integer|min:0',
            'discount_price' => 'nullable|integer|min:0|lte:selling_price',

            'prerequisites' => 'nullable|string|max:10000',

            // ✅ Fix: accept boolean-ish values
            'bestseller'   => 'nullable|boolean',
            'featured'     => 'nullable|boolean',
            'highestrated' => 'nullable|boolean',
            'status'       => 'nullable|boolean',

            'course_goals' => 'nullable|array',
            'course_goals.*' => 'nullable|string|max:500',
        ];
    }
}
