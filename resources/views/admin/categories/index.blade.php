@extends('layouts.app')

@section('title', 'Admin :: categories list')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status_success'))
                    <div class="alert alert-success">
                        {{ session('status_success') }}
                    </div>
                @endif
                @if(session('status_error'))
                    <div class="alert alert-danger">
                        {{ session('status_error') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Categories list</h3>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create category</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped admin-table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                               class="btn btn-sm btn-info mr-2"
                                            >Edit</a>
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
