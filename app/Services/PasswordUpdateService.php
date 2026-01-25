<?php

namespace App\Services;

use App\Repositories\PasswordUpdateRepository;

class PasswordUpdateService
{
    protected PasswordUpdateRepository $passwordUpdateRepository;

    public function __construct(PasswordUpdateRepository $passwordUpdateRepository)
    {
        $this->passwordUpdateRepository = $passwordUpdateRepository;
    }

    /**
     * Update the authenticated user's password
     *
     * @param array $data
     * @return bool
     */
    public function updatePassword(array $data): bool
    {
        return $this->passwordUpdateRepository->updatePassword($data);
    }
}

