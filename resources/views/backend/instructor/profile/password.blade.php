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
            <li class="breadcrumb-item active" aria-current="page">Update Password</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->

    <div class="container">
      <div class="main-body">
        <div class="row">
          <!-- Profile Sidebar -->
          <div class="col-lg-4 mb-3">
            <div class="card">
              <div class="card-body text-center">
                <img id="photoPreview"
                  src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('backend/assets/images/avatars/avatar-2.png') }}"
                  alt="Instructor" class="rounded-circle border border-primary p-1" width="120" height="120">
                <div class="mt-3">
                  <h4>{{ auth()->user()->name }}</h4>
                  <p class="text-muted">{{ auth()->user()->email }}</p>
                  <div class="d-flex justify-content-center gap-2 mt-2">
                    <button class="btn btn-primary btn-sm">Follow</button>
                    <button class="btn btn-outline-primary btn-sm">Message</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Password Update Form -->
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">

                <!-- Success Message -->
                @if(session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <form method="POST" action="{{ route('instructor.passwordSettings') }}">
                  @csrf

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Current Password</label>
                    <div class="col-sm-8">
                      <input type="password" name="current_password" class="form-control"
                        placeholder="Enter your current password" required autocomplete="current-password">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-8">
                      <input type="password" name="new_password" class="form-control"
                        placeholder="Enter your new password" required autocomplete="new-password">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                      <input type="password" name="new_password_confirmation" class="form-control"
                        placeholder="Confirm your new password" required autocomplete="new-password">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12 text-end">
                      <button type="submit" class="btn btn-primary px-4">Update Password</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
          <!-- End Password Update Form -->

        </div> <!-- row end -->
      </div>
    </div>
  </div>

@endsection