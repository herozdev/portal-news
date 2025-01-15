@extends('layouts.admin')

@php
    $pluginStyles = [
        asset('admin/vendor/DataTables/datatables.min.css')
    ];

    $aferStyles = [];

    $pluginScripts = [
        asset('admin/vendor/DataTables/datatables.min.js')
    ];

    $afterScripts = [];
@endphp

@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h5 class="card-title">{{ $title }} <span>| Today</span></h5>

                        <table id="tblPost" class="table table-borderless compact">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>
                                            <a href="/dashboard/posts/show/{{ $item->slug }}"
                                                class="badge bg-info text-dark"><i class="bi bi-eye"></i></a>
                                            <a href="/dashboard/posts/editPost/{{ $item->slug }}"
                                                class="badge bg-warning"><i class="bi bi-pencil"></i></a>
                                            <form action="/dashboard/posts/deletePost/{{ $item->slug }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge bg-danger border-0"
                                                    onclick="return confirm('Are you sure want to delete?')"><i
                                                        class="bi bi-x-circle"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="btn-right mt-3">
                            <a href="/dashboard/posts/create" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i>
                                Create Post</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
