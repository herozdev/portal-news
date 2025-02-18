<section>
    <div class="container">
        <div class="owl-carousel owl-theme blog-slider">
            @foreach ($slide as $item)
            <div class="card blog__slide text-center">
                <div class="blog__slide__img">
                    <img class="card-img rounded-0" src="{{ asset($item->image) }}" alt="" width="100" height="250">
                </div>
                <div class="blog__slide__content">
                    <a class="blog__slide__label" href="#">{{ $item->category->name }}</a>
                    <h3><a href="#">{{ $item->title }}</a></h3>
                    <p>{{ $item->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
