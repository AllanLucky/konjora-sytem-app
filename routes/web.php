<?php

use App\Http\Controllers\admin\InfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AdminInstructorController;
use App\Http\Controllers\backend\InstructorController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\InstructorProfileController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\frontend\FrontendDashboardController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/* Admin Login Route */

Route::prefix('admin')->name('admin.')->group(function () {

    // Public Routes (no auth required)
    Route::get('/login', [AdminController::class, 'login'])->name('login');

    // Protected Routes (auth + email verified + admin role)
    Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Profile Routes
        Route::get('/profile', [AdminProfileController::class, 'profile'])->name('profile');
        Route::post('/profile/store', [AdminProfileController::class, 'store'])->name('profile.store');
        Route::get('/settings', [AdminProfileController::class, 'settings'])->name('settings');

        // Password Routes
        Route::get('/password/settings', [AdminProfileController::class, 'showPasswordForm'])->name('passwordSettings');
        Route::post('/password/settings', [AdminProfileController::class, 'passwordSettings'])->name('passwordSettings.store');

        // Category Management Routes
        Route::resource('category', CategoryController::class);
        Route::resource('subcategory', SubCategoryController::class);
        Route::resource('slider', SliderController::class);
        Route::resource('info', InfoController::class);


    Route::resource('instructor', AdminInstructorController::class);
    Route::post('/update-status', [AdminInstructorController::class, 'updateStatus'])->name('instructor.status');
    Route::get('/instructor-active-list', [AdminInstructorController::class, 'instructorActive'])->name('instructor.active');

    });
});


// Instructor Routes

Route::prefix('instructor')->name('instructor.')->group(function () {

    // Public Routes (No auth needed)
    Route::get('/login', [InstructorController::class, 'login'])->name('login');

    // Protected Routes (auth + instructor role)
    Route::middleware(['auth', 'role:instructor'])->group(function () {
        Route::get('/dashboard', [InstructorController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [InstructorController::class, 'logout'])->name('logout');

        // Profile Routes
        Route::get('/profile', [InstructorProfileController::class, 'profile'])->name('profile');
        Route::post('/profile/store', [InstructorProfileController::class, 'store'])->name('profile.store');
        Route::get('/settings', [InstructorProfileController::class, 'settings'])->name('settings');

        // Password Routes
        Route::get('/password/settings', [InstructorProfileController::class, 'showPasswordForm'])->name('passwordSettings');
        Route::post('/password/settings', [InstructorProfileController::class, 'passwordSettings']);

        // Manage Courses
      Route::resource('course', CourseController::class);
      Route::get('/get-subcategories/{categoryId}', [CategoryController::class, 'getSubcategories']);


    });
});



// Normal user dashboard
Route::middleware(['auth:web', 'role:user'])->group(function () {
    // Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

// Frontend Routes

Route::get('/', [FrontendDashboardController::class, 'home'])->name('frontend.home');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
