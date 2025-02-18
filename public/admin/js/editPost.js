(function () {
    var $ = jQuery.noConflict();
    "use strict";
    // Use Sluggable Library
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    $('#title').on('change', function () {
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    $('#body').summernote({
        placeholder: 'Hello',
        tabsize: 2,
        height: 350,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
            link: [
                ['link', ['linkDialogShow', 'unlink']]
            ],
            table: [
                ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
            ],
            air: [
                ['color', ['color']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']]
            ]
        },
        callbacks: {
            onImageUpload: function (files) {
                uploadImage(files[0]);
            },
            onMediaDelete: function (target) {
                deleteImage(target[0].src);
            },
            onSubmit: function () {
                $('#content').val($('#body').summernote('code'));
            }
        }
    });

    function uploadImage(file) {
        let data = new FormData();
        data.append('file', file);
        $.ajax({
            url: '/dashboard/posts/uploadImage',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Tambahkan CSRF token
            },
            type: "post",
            success: function (url) {
                $('#body').summernote("insertImage", url);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
})();