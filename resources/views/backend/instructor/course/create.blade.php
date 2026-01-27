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
                    <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card col-md-12">
        <div class="card-body">
            <div class="card-body p-4">
                <div style="display: flex; align-items:center; justify-content:space-between">
                    <h5 class="mb-4">Add Course</h5>
                    <a href="{{ route('instructor.course.index') }}" class="btn btn-primary">Back</a>
                </div>

                <form class="row g-3" method="post" action="{{ route('instructor.course.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input type="hidden" name="instructor_id" value="{{ auth()->user()->id }}" />

                    <!-- Course Name & Slug -->
                    <div class="col-md-6">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="name" name="course_name" value="{{ old('course_name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="course_name_slug" value="{{ old('course_name_slug') }}" required>
                    </div>

                    <!-- Course Title -->
                    <div class="col-md-12">
                        <label class="form-label">Course Title</label>
                        <input type="text" class="form-control" name="course_title" value="{{ old('course_title') }}" required>
                    </div>

                    <!-- Category & Subcategory -->
                    <div class="col-md-6">
                        <label class="form-label">Choose Category</label>
                        <select class="form-select" name="category_id" id="category" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach ($all_categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Select SubCategory</label>
                        <select class="form-select" name="subcategory_id" id="subcategory" required>
                            <option value="" disabled selected>Select a subcategory</option>
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="col-md-6">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="course_image" accept="image/*" id="Photo">
                        <img id="photoPreview" class="img-fluid mt-3" style="display:none;">
                    </div>

                    <!-- Resources -->
                    <div class="col-md-6">
                        <label class="form-label">Resources</label>
                        <input class="form-control" type="number" name="resources" value="{{ old('resources') }}">
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control editor" name="description" required>{{ old('description') }}</textarea>
                    </div>

                    <!-- YouTube Video -->
                    <div class="col-md-6">
                        <label class="form-label">YouTube Video URL</label>
                        <input type="url" class="form-control" name="video_url" id="video_url" value="{{ old('video_url') }}" required>
                        <iframe id="videoPreview" style="margin-top: 15px; display: none; width: 100%; height: 300px;"
                                frameborder="0" allowfullscreen></iframe>
                    </div>

                    <!-- Label & Certificate -->
                    <div class="col-md-6">
                        <label class="form-label">Course Label</label>
                        <select class="form-select" name="label">
                            <option disabled selected>select</option>
                            <option value="beginer">Beginer</option>
                            <option value="medium">Medium</option>
                            <option value="advance">Advance</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Certificate</label>
                        <select class="form-select" name="certificate">
                            <option disabled selected>select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <!-- Prices & Duration -->
                    <div class="col-md-6">
                        <label class="form-label">Selling Price</label>
                        <input type="number" class="form-control" name="selling_price" value="{{ old('selling_price') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price" value="{{ old('discount_price') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Course Duration (hours)</label>
                        <input type="number" step="0.01" class="form-control" name="duration" value="{{ old('duration') }}">
                    </div>

                    <!-- Prerequisites -->
                    <div class="col-md-12">
                        <label class="form-label">Course Prerequisites</label>
                        <textarea class="form-control editor" name="prerequisites">{{ old('prerequisites') }}</textarea>
                    </div>

                    <!-- Course Goals -->
                    <div class="col-md-12">
                        <label class="form-label">Course Goals</label>
                        <div id="goalContainer">
                            <div class="d-flex gap-2 mb-2">
                                <input type="text" class="form-control" name="course_goals[]">
                                <button type="button" id="addGoalInput" class="btn btn-primary">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Flags -->
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <div class="form-check">
                            <input type="hidden" name="bestseller" value="0">
                            <input class="form-check-input" type="checkbox" name="bestseller" value="1" {{ old('bestseller') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label">Bestseller</label>
                        </div>

                        <div class="form-check">
                            <input type="hidden" name="featured" value="0">
                            <input class="form-check-input" name="featured" value="1" type="checkbox" {{ old('featured') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label">Featured</label>
                        </div>

                        <div class="form-check">
                            <input type="hidden" name="highestrated" value="0">
                            <input class="form-check-input" name="highestrated" value="1" type="checkbox" {{ old('highestrated') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label">Highest Rated</label>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary w-100">Create</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    // ---------------- AUTO GENERATE SLUG ----------------
    $('#name').on('input', function () {
        var name = $(this).val();
        var slug = name.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, '');
        $('#slug').val(slug);
    });

    // ---------------- DYNAMIC SUBCATEGORY ----------------
    $('#category').on('change', function () {
        var categoryId = $(this).val();
        if(categoryId) {
            $.ajax({
                url: '/instructor/get-subcategories/' + categoryId,
                type: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    $('#subcategory').empty();
                    $('#subcategory').append('<option value="" disabled selected>Select a subcategory</option>');
                    $.each(data, function(key, value) {
                        $('#subcategory').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                },
                error: function() { alert('Failed to load subcategories.'); }
            });
        } else {
            $('#subcategory').empty().append('<option value="" disabled selected>Select a subcategory</option>');
        }
    });

    // ---------------- COURSE GOALS ----------------
    $('#addGoalInput').on('click', function(e) {
        e.preventDefault();
        $('#goalContainer').append(`
            <div class="d-flex gap-2 mb-2">
                <input type="text" class="form-control" name="course_goals[]" placeholder="Enter Course Goal">
                <button type="button" class="btn btn-danger removeGoalInput">-</button>
            </div>
        `);
    });

    $(document).on('click', '.removeGoalInput', function() {
        $(this).closest('div').remove();
    });

    // ---------------- VIDEO PREVIEW ----------------
    $('#video_url').on('input', function () {
        var url = $(this).val();
        var regex = /(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/;
        var match = url.match(regex);
        var iframe = $('#videoPreview');
        if(match) {
            iframe.attr('src', 'https://www.youtube.com/embed/' + match[1]).show();
        } else {
            iframe.attr('src','').hide();
        }
    });

    // Trigger video preview on page load if URL exists
    $('#video_url').trigger('input');

    // ---------------- IMAGE PREVIEW ----------------
    $('#Photo').on('change', function(e){
        var file = e.target.files[0];
        if(file) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#photoPreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        }
    });

    // ---------------- CKEDITOR ----------------
    CKEDITOR.replace('description', { height: 300 });

});
</script>
@endpush
