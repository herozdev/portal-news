@extends('layouts.admin')

@php
    $pluginStyles = [asset('admin/vendor/DataTables/datatables.min.css')];

    $aferStyles = [];

    $pluginScripts = [asset('admin/vendor/DataTables/datatables.min.js')];

    $afterScripts = [];
@endphp

@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h5 class="card-title">{{ $title }} <span></span></h5>

                        <table id="tblCategory" class="table table-borderless compact">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>
                                            <a href="/dashboard/categories/show/{{ $item->slug }}"
                                                class="badge bg-info text-dark"><i class="bi bi-eye"></i></a>
                                            <a href="/dashboard/categories/editCategories/{{ $item->slug }}"
                                                class="badge bg-warning"><i class="bi bi-pencil"></i></a>
                                            <form action="/dashboard/categories/deleteCategories/{{ $item->slug }}" method="post"
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
                            <a href="/dashboard/categories/create" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i>
                                Create Category</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
