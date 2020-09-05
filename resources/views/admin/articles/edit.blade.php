@extends('layouts.app')

@section('title', "Edit the article #{$article->id}")

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
                    <div class="card-header d-flex justify-content-between">
                        <h3>Edit the article #{{ $article->id }}</h3>
                        <a href="{{ route('blog.show', $article->slug) }}"
                           class="btn btn-success"
                           target="_blank"
                        >View article</a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.articles.update', $article) }}">
                            @csrf
                            @method('PUT')
                            @include('admin.articles.partials.form-elements')

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
