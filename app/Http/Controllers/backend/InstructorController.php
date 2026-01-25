<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class InstructorController extends Controller
{
    public function login()
    {
        return view('backend.instructor.login.index');
    }
    public function dashboard()
{
    return view('backend.instructor.dashboard.index');
}



  
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('instructor.login');
    }
}




