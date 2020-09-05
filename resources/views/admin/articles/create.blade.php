@extends('layouts.app')

@section('title', 'Create article')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3>Create a new article</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.articles.store') }}">
                            @csrf
                            @include('admin.articles.partials.form-elements')

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
