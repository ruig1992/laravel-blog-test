@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <section>
                    <header class="mb-3">
                        <h1 class="h3">All articles @if($selectedCategory ?? null)by <em>{{ $selectedCategory->name }}</em>@endif</h1>
                    </header>
                    <div class="container">
                        <div class="row">
                            @foreach($articles as $article)
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex flex-column p-4 border bg-white h-100">
                                        @if(empty($selectedCategory))
                                            <strong class="d-inline-block mb-3 text-primary">
                                                <a href="{{ route('blog.indexByCategory', $article->category->slug) }}"
                                                    >{{ $article->category->name }}</a>
                                            </strong>
                                        @endif
                                        <h2 class="h4 mb-2">{{ $article->title }}</h2>
                                        <div class="mb-3 text-muted">
                                            {{ $article->published_at->format('d M Y, H:i') }}
                                        </div>
                                        <p class="card-text mb-4">{{ $article->description }}</p>
                                        <a href="{{ route('blog.show', $article->slug) }}">Continue reading</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section>
                    <header class="mb-3">
                        <h3>Categories</h3>
                    </header>
                    <ul class="list-group">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ route('blog.indexByCategory', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>
        </div>
        <div class="mt-2">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
