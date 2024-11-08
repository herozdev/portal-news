<script src="{{ asset('home/vendors/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('home/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('home/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('home/js/mail-script.js') }}"></script>
<script src="{{ asset('home/js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        // Siapkan URL gambar dalam variabel JavaScript (Blade akan memproses asset())
        var leftArrow = "{{ asset('home/img/home/left-arrow.png') }}";
        var rightArrow = "{{ asset('home/img/home/right-arrow.png') }}";

        // Lakukan pengecekan menggunakan JavaScript untuk melihat apakah elemen .blog-slider ada
        if ($('.blog-slider').length) {
            $('.blog-slider').owlCarousel({
                loop: true,
                margin: 30,
                items: 1,
                nav: true,
                autoplay: 2500,
                smartSpeed: 1500,
                dots: false,
                responsiveClass: true,
                navText: [
                    "<div class='blog-slider__leftArrow'><img src='" + leftArrow + "' /></div>",
                    "<div class='blog-slider__rightArrow'><img src='" + rightArrow + "' /></div>"
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        }
    });
</script>
