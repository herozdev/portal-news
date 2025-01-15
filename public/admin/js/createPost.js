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
        }
    });


    // // Quill
    // const toolbarOptions = [
    //     [{ header: [1, 2, 3, 4, 5, 6, false] }],
    //     ['bold', 'italic', 'underline', 'strike'],
    //     ['image', 'code-block', 'blockquote'],
    //     [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    //     [{ 'list': 'ordered' }, { 'list': 'bullet' }],
    //     [{ 'script': 'sub' }, { 'script': 'super' }],      // superscript/subscript
    //     [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
    //     [{ 'direction': 'rtl' }],                         // text direction
    //     [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    //     [{ 'font': [] }],
    //     [{ 'align': [] }],
    // ];

    // var quill = new Quill('#quill-editor-full', {
    //   theme: 'snow',
    //   modules: {
    //     toolbar: toolbarOptions,
    //     imageUpload: {
    //       url: null,
    //       method: 'base64',
    //     },
    //   },
    // });

    // quill.on('text-change', function (delta, oldDelta, source) {
    //     document.querySelector("input[name='body']").value = quill.root.innerHTML;
    // });

})();