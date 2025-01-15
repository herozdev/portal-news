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

    // Quill
    const toolbarOptions = [
        [{ header: [1, 2, 3, 4, 5, 6, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        ['image', 'code-block', 'blockquote'],
        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
        [{ 'script': 'sub' }, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
    ];

    var quill = new Quill('#quill-editor-full', {
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions
        },
    });

    // Set the value of the hidden input field to the full content of the Quill editor
    quill.on('text-change', function(delta, oldDelta, source) {
        document.getElementById('body').value = quill.root.innerHTML;
    });

    // Get the initial content from the hidden input
    var initialContent = document.querySelector("input[name='body']").value;

    // Set the initial content to the Quill editor
    quill.clipboard.dangerouslyPasteHTML(initialContent);

    quill.on('text-change', function (delta, oldDelta, source) {
        document.querySelector("input[name='body']").value = quill.root.innerHTML;
    });
})();