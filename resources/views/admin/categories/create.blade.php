@extends('layouts.admin')

@php
    $pluginStyles = [];

    $afterStyles = [];

    $pluginScripts = [asset('admin/vendor/jquery/jquery.min.js')];

    $afterScripts = [asset('admin/js/createCategory.js')];
@endphp

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ $title }}</h6>
                        <form action="/dashboard/categories/storeCategory" method="post" class="row g-3">
                            @csrf
                            <div class="col-lg-8">
                                <label for="title" class="form-label">Category Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <label for="slug" class="form-label">Category Slug</label>
                                <input type="text" name="slug" id="slug"
                                    class="form-control @error('slug') is-invalid @enderror" readonly
                                    value="{{ old('slug') }}">
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-8">
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary ms-auto"><i class="bi bi-plus"></i>
                                        Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
