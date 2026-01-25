<?php

namespace App\Services;

use App\Repositories\ProfileRepository;

class ProfileService
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    /**
     * Save or update the instructor profile
     *
     * @param array $data
     * @param \Illuminate\Http\UploadedFile|null $photo
     * @return \App\Models\User|null
     */
    public function saveProfile(array $data, $photo = null)
    {
        // Delegates profile creation or update to the repository
        return $this->profileRepository->createOrUpdateProfile($data, $photo);
    }
}

