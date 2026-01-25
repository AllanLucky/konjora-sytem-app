<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateRepository
{
    /**
     * Update the authenticated user's password
     */
    public function updatePassword(array $data): bool
    {
        $user = Auth::user(); // get logged-in user

        if (!$user) {
            return false;
        }

        // Check if current password is correct
        if (!Hash::check($data['current_password'], $user->password)) {
            return false;
        }

        // Update to new password
        $user->password = Hash::make($data['new_password']);
        /** @var \App\Models\User $user */

        return $user->save();
    }
}


