@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('blog.indexByCategory', $article->category->slug) }}">
                        {{ $article->category->name }}
                    </a>
                </li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <article>
                    <header class="mb-3">
                        <h1 class="h3">{{ $article->title }}</h1>
                        <p class="text-muted">
                            {{ $article->published_at->format('d M Y, H:i') }}
                        </p>
                    </header>
                    <p>{{ $article->description }}</p>
                    <hr>
                    {{ $article->content }}
                </article>
            </div>
        </div>
    </div>
@endsection
