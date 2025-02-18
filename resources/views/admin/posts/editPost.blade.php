@extends('layouts.admin')

@php
    $pluginStyles = [
        asset('admin/vendor/summernote/summernote-lite.min.css'),
    ];

    $afterStyles = [];

    $pluginScripts = [
        asset('admin/vendor/jquery/jquery.min.js'),
        asset('admin/vendor/summernote/summernote-lite.min.js'),
    ];

    $afterScripts = [
        asset('admin/js/editPost.js'),
    ];
@endphp

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ $title }}</h6>
                        <form action="/dashboard/posts/updatePost/{{ $post->slug }}" method="post" class="row g-3">
                            @csrf
                            @method('put')

                            <div class="col-lg-8">
                                <label for="title" class="form-label">Your Title</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label for="slug" class="form-label">Your Slug</label>
                                <input type="text" name="slug" id="slug"
                                    class="form-control @error('slug') is-invalid @enderror" readonly
                                    value="{{ old('slug', $post->slug) }}">
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label for="category" class="form-label">Category</label>
                                <select name="category_id" id="category"
                                    class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">Choose..</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id', $post->category_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label for="image" class="form-label">Main Image</label>
                                @if ($post->image)
                                    <img src="{{ asset($post->image) }}" style="max-width: 150px">
                                @endif
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-8" id="scrolling-container">
                                @error('body')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <label for="body" class="form-label">Article</label>
                                <textarea name="body" id="body">{!! old('body', $post->body) !!}</textarea>
                                <input type="hidden" name="content" id="content">
                            </div>
                            <div class="col-lg-8">
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary ms-auto"><i class="bi bi-send"></i>
                                        Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
