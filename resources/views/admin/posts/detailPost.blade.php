@extends('layouts.admin')

@section('content')
    <div class="pageTitle">
        <h3>{{ $title }}</h3>
    </div>
    <section class="section dashboard">
        <div class="row align-items-top">
            <div class="col-lg-10">
                <div class="card">
                    <img src="{{ asset('admin/img/card.jpg') }}" class="card-img-top" alt="..." height="380">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{!! $post->body !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
