<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Repositories\ProfileRepository;
use App\Services\PasswordUpdateService;

class InstructorProfileController extends Controller
{
    protected ProfileRepository $profileRepository;
    protected PasswordUpdateService $passwordUpdateService;

    public function __construct(ProfileRepository $profileRepository, PasswordUpdateService $passwordUpdateService)
    {
        $this->profileRepository = $profileRepository;
        $this->passwordUpdateService = $passwordUpdateService;
    }

    /**
     * Show the instructor profile page
     */
    public function profile()
    {
        return view('backend.instructor.profile.index');
    }

    /**
     * Show the instructor profile settings page
     */
    public function settings()
    {
        return view('backend.instructor.profile.settings');
    }

    /**
     * Store / Update the instructor profile
     */
    public function store(ProfileRequest $request)
    {
        $data = $request->validated();
        $photo = $request->file('photo');
        unset($data['photo']);

        $this->profileRepository->createOrUpdateProfile($data, $photo);

        return redirect()
            ->route('instructor.profile')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the instructor password update form
     */
    public function showPasswordForm()
    {
        return view('backend.instructor.profile.password'); // Your Blade file
    }

    /**
     * Handle password update
     */
    public function passwordSettings(PasswordUpdateRequest $request)
    {
        $data = $request->validated();

        // Attempt to update password
        $success = $this->passwordUpdateService->updatePassword($data);

        if (!$success) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        return redirect()
            ->route('instructor.passwordSettings')
            ->with('success', 'Password updated successfully.');
    }
}
