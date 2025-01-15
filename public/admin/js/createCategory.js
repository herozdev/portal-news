(function () {
    "use strict";
    
    // Use Sluggable Library
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    $('#name').on('change', function () {
        fetch('/dashboard/categories/checkSlugCategory?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
})();