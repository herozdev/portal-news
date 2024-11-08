<section class="mb-30px">
    <div class="container">
        <div class="hero-banner hero-banner--sm">
            <div class="hero-banner__content">
                @if (Route::is('/'))
                    <h3>Welcome To</h3>
                    <h1>{{ $title }}</h1>
                    <h4>{{ date('D-d M Y') }}</h4>
                    <div class="d-flex justify-content-center h-100">
                        <form action="/archive" method="get">
                            <div class="search">
                                <input class="search_input" type="text" name="search" placeholder="Search here..." value="{{ request('search') }}">
                                <button href="#" class="search_icon" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                @else
                    <h3>{{ $title }}</h3>
                    {{-- <h1>{{ $post->title }}</h1> --}}
                    <h4>December 12, 2018</h4>
                    <div class="d-flex justify-content-center h-100">
                        <form action="/archive" method="get">
                            <div class="search">
                                <input class="search_input" type="text" name="search" placeholder="Search here..." value="{{ request('search') }}">
                                <button href="#" class="search_icon" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
