@extends('layouts.app')

@section('title', "Edit the category #{$category->id}")

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
                    <div class="card-header">
                        <h3>Edit the category #{{ $category->id }}</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                            @csrf
                            @method('PUT')
                            @include('admin.categories.partials.form-elements')

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
