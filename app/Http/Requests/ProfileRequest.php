<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       return [
            // Basic Identity
            'first_name' => 'nullable|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . $this->user()->id,

            // Profile Info
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city'    => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'gender'  => 'nullable|in:male,female,other',

            // Professional Info
            'bio'        => 'nullable|string|max:5000',
            'job_title' => 'nullable|string|max:255',
            'department'=> 'nullable|string|max:255',
            'experience'=> 'nullable|string|max:255',
            'skills'    => 'nullable|string|max:255',
            'website'   => 'nullable|url|max:255',

            // Profile Image
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }
}

