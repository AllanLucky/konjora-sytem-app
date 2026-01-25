@extends('backend.instructor.master')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Course</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Course</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card col-md-12">
        <div class="card-body">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5>Update Course</h5>
                    <a href="{{ route('instructor.course.index') }}" class="btn btn-primary">Back</a>
                </div>

                <form method="POST" action="{{ route('instructor.course.update', $course->id) }}" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input type="hidden" name="instructor_id" value="{{ auth()->user()->id }}">

                    {{-- Course Name & Slug --}}
                    <div class="col-md-6">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="course_name" placeholder="Enter course name"
                               value="{{ old('course_name', $course->course_name) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" class="form-control" name="course_name_slug" placeholder="Enter slug"
                               value="{{ old('course_name_slug', $course->course_name_slug) }}">
                    </div>

                    {{-- Course Title --}}
                    <div class="col-md-12">
                        <label class="form-label">Course Title</label>
                        <input type="text" class="form-control" name="course_title" placeholder="Enter course title"
                               value="{{ old('course_title', $course->course_title) }}">
                    </div>

                    {{-- Category & Subcategory --}}
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category_id" id="category">
                            <option value="" disabled selected>Select a category</option>
                            @foreach ($all_categories as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $course->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">SubCategory</label>
                        <select class="form-select" name="subcategory_id" id="subcategory">
                            <option value="{{ $course->subcategory_id }}" selected>{{ $course->subCategory['name'] }}</option>
                        </select>
                    </div>

                    {{-- Image --}}
                    <div class="col-md-6">
                        <label class="form-label">Course Image</label>
                        <input type="file" class="form-control" name="course_image" accept="image/*" id="Photo">
                        @if($course->course_image)
                            <img src="{{ asset($course->course_image) }}" class="img-fluid mt-2" style="max-height:150px;">
                        @endif
                    </div>

                    {{-- Resources --}}
                    <div class="col-md-6">
                        <label class="form-label">Resources</label>
                        <input type="number" class="form-control" name="resources" value="{{ old('resources', $course->resources) }}">
                    </div>

                    {{-- Description --}}
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control editor" name="description">{{ old('description', $course->description) }}</textarea>
                    </div>

                    {{-- YouTube Video --}}
                    <div class="col-md-6">
                        <label class="form-label">YouTube Video URL</label>
                        <input type="url" class="form-control" name="video_url" id="video_url"
                               placeholder="Enter YouTube URL" value="{{ old('video_url', $course->video_url) }}">
                        <iframe id="videoPreview" src="" style="display:none; width:100%; height:400px;" frameborder="0" allowfullscreen class="mt-2"></iframe>
                    </div>

                    {{-- Label & Certificate --}}
                    <div class="col-md-6">
                        <label class="form-label">Course Label</label>
                        <select class="form-select" name="label">
                            <option selected disabled>Select</option>
                            <option value="beginer" {{ $course->label == 'beginer' ? 'selected' : '' }}>Beginner</option>
                            <option value="medium" {{ $course->label == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="advance" {{ $course->label == 'advance' ? 'selected' : '' }}>Advance</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Certificate</label>
                        <select class="form-select" name="certificate">
                            <option selected disabled>Select</option>
                            <option value="yes" {{ $course->certificate == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $course->certificate == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    {{-- Prices & Duration --}}
                    <div class="col-md-6">
                        <label class="form-label">Selling Price</label>
                        <input type="number" class="form-control" name="selling_price"
                               value="{{ old('selling_price', $course->selling_price) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price"
                               value="{{ old('discount_price', $course->discount_price) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Course Duration (Hours)</label>
                        <input type="number" step="0.01" class="form-control" name="duration"
                               value="{{ old('duration', $course->duration) }}">
                    </div>

                    {{-- Prerequisites --}}
                    <div class="col-md-12">
                        <label class="form-label">Course Prerequisites</label>
                        <textarea class="form-control editor" name="prerequisites">{{ old('prerequisites', $course->prerequisites) }}</textarea>
                    </div>

                    {{-- Course Goals --}}
                    <div class="col-md-12">
                        <label class="form-label d-flex justify-content-between align-items-center">
                            Course Goals
                            <button type="button" class="btn btn-primary btn-sm" id="addGoalInput">+</button>
                        </label>
                        <div id="goalContainer">
                            @foreach ($course_goals as $data)
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <input type="text" class="form-control" name="course_goals[]" value="{{ $data->goal_name }}" placeholder="Enter Course Goal">
                                    <button type="button" class="btn btn-danger btn-sm removeGoalInput">-</button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Bestseller, Featured, Highestrated --}}
                    <div class="col-md-12 d-flex gap-3 mt-3">
                        <div class="form-check form-check-success">
                            <input type="hidden" name="bestseller" value="no">
                            <input class="form-check-input" type="checkbox" name="bestseller" value="yes" {{ $course->bestseller == 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label">Bestseller</label>
                        </div>
                        <div class="form-check form-check-danger">
                            <input type="hidden" name="featured" value="no">
                            <input class="form-check-input" type="checkbox" name="featured" value="yes" {{ $course->featured == 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label">Featured</label>
                        </div>
                        <div class="form-check form-check-warning">
                            <input type="hidden" name="highestrated" value="no">
                            <input class="form-check-input" type="checkbox" name="highestrated" value="yes" {{ $course->highestrated == 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label">Highestrated</label>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary w-100">Update Course</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Video preview
    const videoUrlField = document.getElementById('video_url');
    const videoPreview = document.getElementById('videoPreview');

    function updateVideoPreview(url) {
        const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regex);
        if(match){
            videoPreview.src = `https://www.youtube.com/embed/${match[1]}`;
            videoPreview.style.display = 'block';
        } else {
            videoPreview.style.display = 'none';
            videoPreview.src = '';
        }
    }

    updateVideoPreview(videoUrlField.value);
    videoUrlField.addEventListener('input', () => updateVideoPreview(videoUrlField.value));

    // Add/Remove course goals
    document.getElementById('addGoalInput').addEventListener('click', () => {
        const container = document.getElementById('goalContainer');
        const div = document.createElement('div');
        div.className = 'd-flex align-items-center gap-2 mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="course_goals[]" placeholder="Enter Course Goal">
            <button type="button" class="btn btn-danger btn-sm removeGoalInput">-</button>
        `;
        container.appendChild(div);
    });

    document.getElementById('goalContainer').addEventListener('click', function(e){
        if(e.target.classList.contains('removeGoalInput')){
            e.target.parentNode.remove();
        }
    });

});
</script>

<script src="{{ asset('customjs/instructor/course.js') }}"></script>
@endpush
