$(document).ready(function () {

    // Auto-generate slug
    $('#name').on('input', function () {
        let name = $(this).val().trim();
        let slug = name.toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w-]+/g, '')
            .replace(/--+/g, '-')
            .replace(/^-+|-+$/g, '');
        $('#slug').val(slug);
    });

    // Dynamic dependent dropdown
    $('#category').on('change', function () {
        let categoryId = $(this).val();
        if (!categoryId) {
            $('#subcategory').empty().append('<option value="" disabled selected>Select a subcategory</option>');
            return;
        }
        $.ajax({
            url: '/instructor/get-subcategories/' + categoryId,
            type: 'GET',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (data) {
                $('#subcategory').empty().append('<option value="" disabled selected>Select a subcategory</option>');
                $.each(data, function (_, value) {
                    $('#subcategory').append(`<option value="${value.id}">${value.name}</option>`);
                });
            },
            error: function () { alert('Failed to load subcategories.'); }
        });
    });

    // Image Preview
    $('#image').on('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            alert('Please upload a valid image file (JPEG, PNG, GIF).');
            $('#image').val('');
            $('#photoPreview').hide().attr('src', '');
            return;
        }
        const objectURL = URL.createObjectURL(file);
        $('#photoPreview').attr('src', objectURL).show();
    });

    // YouTube Video Preview
    const videoUrlField = document.getElementById('video_url');
    const videoPreview = document.getElementById('videoPreview');
    function updateVideoPreview(url) {
        const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regex);
        if (match) {
            videoPreview.src = `https://www.youtube.com/embed/${match[1]}`;
            videoPreview.style.display = 'block';
        } else {
            videoPreview.style.display = 'none';
            videoPreview.src = '';
        }
    }
    if(videoUrlField) {
        updateVideoPreview(videoUrlField.value);
        videoUrlField.addEventListener('input', function () {
            updateVideoPreview(videoUrlField.value);
        });
    }

    // Add/Remove course goals
    $('#addGoalInput').on('click', function () {
        $('#goalContainer').append(`
            <div class="d-flex align-items-center gap-2 mb-2">
                <input type="text" class="form-control" name="course_goals[]" placeholder="Enter Course Goal">
                <button type="button" class="btn btn-danger btn-sm removeGoalInput">-</button>
            </div>
        `);
    });
    $('#goalContainer').on('click', '.removeGoalInput', function () {
        $(this).parent().remove();
    });

    // CKEditor
    if(typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('description', { height: 360 });
        CKEDITOR.replace('prerequisites', { height: 200 });
    }

});
