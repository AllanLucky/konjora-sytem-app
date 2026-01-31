<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Auth;

class ProfileRepository
{
    use FileUploadTrait; 

    // Get the profile of the currently logged-in user
    public function findProfile()
    {
        $user_id = Auth::id(); // Use default guard
        return User::find($user_id);
    }

    // Create or update the profile
    public function createOrUpdateProfile($data, $photo)
    {
        $profile = $this->findProfile();

        if ($profile) {
            // Handle photo upload if provided
            if ($photo) {
                // $profile->photo is the old file to delete (if needed)
                $data['photo'] = $this->uploadFile($photo, 'user', $profile->photo);
            }

            // Update other profile fields
            $profile->update($data);
        }

        return $profile;
    }
}
