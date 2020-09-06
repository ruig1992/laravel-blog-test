@extends('layouts.app')

@section('title', "Edit the article #{$article->id}")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('admin.partials.session-alert')

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Edit the article #{{ $article->id }}</h3>
                        @if($article->is_published)
                            @include('admin.partials.buttons.btn-view', [
                                'btnViewRoutePath' => route('blog.show', $article->slug),
                                'btnViewLabel' => 'View article',
                            ])
                        @endif
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.articles.update', $article) }}">
                            @csrf
                            @method('PUT')
                            @include('admin.articles.partials.form-elements')

                            <div class="d-flex">
                                <div class="mr-2">
                                    @include('admin.partials.buttons.btn-save')
                                </div>
                                <form-delete-action
                                    action="{{ route('admin.articles.destroy', $article) }}"
                                    :show-label="true"
                                ></form-delete-action>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
