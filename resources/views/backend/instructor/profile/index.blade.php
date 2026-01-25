@extends('backend.instructor.master')

@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Instructor Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Instructor Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="container">
            <div class="main-body">
                <div class="row">
                    @include('backend.instructor.profile.sidebar')

                    <div class="col-lg-8">
                        <div class="card">
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('instructor.profile.store') }}">
                                @csrf

                                <div class="card-body">

                                    {{-- Validation Errors --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    {{-- Full Name --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', auth()->user()->name) }}">
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', auth()->user()->email) }}">
                                        </div>
                                    </div>

                                    {{-- Phone --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone', auth()->user()->phone) }}"
                                                placeholder="Enter your phone number">
                                        </div>
                                    </div>

                                    {{-- City --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">City</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="city" class="form-control"
                                                value="{{ old('city', auth()->user()->city) }}"
                                                placeholder="Enter your city">
                                        </div>
                                    </div>

                                    {{-- Country --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Country</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="country" class="form-control"
                                                value="{{ old('country', auth()->user()->country) }}"
                                                placeholder="Enter your country">
                                        </div>
                                    </div>

                                    {{-- Gender --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Gender</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select class="form-select" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ old('gender', auth()->user()->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Experience --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Experience</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="experience" class="form-control"
                                                value="{{ old('experience', auth()->user()->experience) }}"
                                                placeholder="Example: Web Developer, Designer, Teacher">
                                        </div>
                                    </div>

                                    {{-- Job Title --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Job Title</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="job_title" class="form-control"
                                                value="{{ old('job_title', auth()->user()->job_title) }}"
                                                placeholder="Example: Senior Instructor, Developer">
                                        </div>
                                    </div>

                                    {{-- Department --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Department</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="department" class="form-control"
                                                value="{{ old('department', auth()->user()->department) }}"
                                                placeholder="Example: IT Department, Science Department">
                                        </div>
                                    </div>

                                    {{-- Skills --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Skills</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="skills" class="form-control"
                                                value="{{ old('skills', auth()->user()->skills) }}"
                                                placeholder="Example: Laravel, Vue.js, Teaching">
                                        </div>
                                    </div>

                                    {{-- Website --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Website / LinkedIn</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="website" class="form-control"
                                                value="{{ old('website', auth()->user()->website) }}"
                                                placeholder="Example: https://linkedin.com/in/username">
                                        </div>
                                    </div>

                                    {{-- Bio --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Bio</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea name="bio" class="form-control" rows="5"
                                                placeholder="Enter your bio">{{ old('bio', auth()->user()->bio) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="address" class="form-control"
                                                value="{{ old('address', auth()->user()->address) }}"
                                                placeholder="Enter your address">
                                        </div>
                                    </div>

                                    {{-- Profile Image --}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Profile Image</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="photo" class="form-control">

                                            @if(auth()->user()->photo)
                                                <div class="mt-2">
                                                    <img src="{{ asset(auth()->user()->photo) }}" alt="Profile Photo"
                                                        class="rounded-circle" width="80" height="80">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <button type="submit" class="btn btn-primary px-4 w-100">Update</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection