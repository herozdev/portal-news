@extends('layouts.main')

@section('content')
    <div class="col-lg-8">
        @foreach ($post as $item)
            <div class="single-recent-blog-post">
                <div class="thumb">
                    <img class="img-fluid" src="{{ asset('home/img/blog/blog1.png') }}" alt="">
                    <ul class="thumb-info">
                        <li><a href="#"><i class="ti-user"></i>{{ $item->user->name }}</a></li>
                        <li><a href="#"><i class="ti-notepad"></i>{{ $item->created_at->diffForHumans() }}</a></li>
                        <li><a href="#"><i class="ti-themify-favicon"></i>2</a></li>
                    </ul>
                </div>
                <div class="details mt-20">
                    <a href="/post/{{ $item->slug }}">
                        <h3>{{ $item->title }}</h3>
                    </a>
                    <p class="tag-list-inline">Category: <a href="/category/{{ $item->category->slug }}">{{ $item->category->name }}</a></p>
                    <p>{!! $item->excerpt !!}</p>
                    <a class="button" href="/post/{{ $item->slug }}">Read More <i class="ti-arrow-right"></i></a>
                </div>
            </div>
        @endforeach


        <div class="row">
            <div class="col-lg-12">
                <nav class="blog-pagination justify-content-center d-flex">
                    <ul class="pagination">
                        <li class="page-item">
                            <a href="#" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">
                                    <i class="ti-angle-left"></i>
                                </span>
                            </a>
                        </li>
                        <li class="page-item active"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item">
                            <a href="#" class="page-link" aria-label="Next">
                                <span aria-hidden="true">
                                    <i class="ti-angle-right"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection