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
        $user_id = Auth::id(); // Use default guard (normal user)
        return User::find($user_id); // simpler than where()->first()
    }

    // Create or update the profile
    public function createCategory($data, $photo)
    {
        $profile = $this->findProfile();

        if ($profile) {
            // Handle photo upload if provided
            if ($photo) {
                $data['photo'] = $this->uploadFile($photo, 'user', $profile->photo);
            }

            // Update other profile fields
            $profile->update($data);
        }

        return $profile;
    }
}

