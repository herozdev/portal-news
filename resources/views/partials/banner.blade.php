<section class="mb-30px">
    <div class="container">
        <div class="hero-banner hero-banner--sm">
            <div class="hero-banner__content">
                @if (Route::is('/'))
                    <h3>Welcome To</h3>
                    <h1>{{ $title }}</h1>
                    <h4>{{ date('D-d M Y') }}</h4>
                @else
                    <h3>{{ $title }}</h3>
                    {{-- <h1>{{ $post->title }}</h1> --}}
                    <h4>December 12, 2018</h4>
                @endif
            </div>
        </div>
    </div>
</section>
