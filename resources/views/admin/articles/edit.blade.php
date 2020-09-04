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
                            <div class="form-group required">
                                <label for="category" class="admin-control-label">Category</label>
                                <select class="form-control @if($errors->has('category_id'))is-invalid @endif"
                                        id="category"
                                        name="category_id"
                                >
                                    <option value="" disabled>__Select the category__</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (old('category_id', $article->category_id) == $category->id ? 'selected' : '') }}
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span role="alert" class="invalid-feedback">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            </div>
                            <div class="form-group required">
                                <label for="title" class="admin-control-label">Title</label>
                                <input type="text"
                                       class="form-control @if($errors->has('title'))is-invalid @endif"
                                       id="title"
                                       name="title"
                                       value="{{ old('title', $article->title) }}"
                                       maxlength="255"
                                >
                                <span role="alert" class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            </div>
                            <div class="form-group required">
                                <label for="description" class="admin-control-label">Description</label>
                                <input type="text"
                                       class="form-control @if($errors->has('description'))is-invalid @endif"
                                       id="description"
                                       name="description"
                                       value="{{ old('description', $article->description) }}"
                                       maxlength="255"
                                >
                                <span role="alert" class="invalid-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            </div>
                            <div class="form-group required">
                                <label for="content" class="admin-control-label">Content</label>
                                <textarea class="form-control @if($errors->has('content'))is-invalid @endif"
                                          id="content"
                                          name="content"
                                          rows="3"
                                >{{ old('content', $article->content) }}</textarea>
                                <span role="alert" class="invalid-feedback">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="published_at" class="admin-control-label">Published datetime</label>
                                <input type="text"
                                       class="form-control"
                                       id="published_at"
                                       name="published_at"
                                       value="{{ old('published_at', $article->published_at) }}"
                                >
                                <small class="form-text text-muted">Setting automatically as current if it's empty</small>
                            </div>
                            <div class="form-check mb-4">
                                <input type="checkbox"
                                       value="1"
                                       class="form-check-input"
                                       id="is_published"
                                       name="is_published"
                                    {{ ($article->is_published ? 'checked' : '') }}
                                >
                                <label class="form-check-label admin-control-label" for="is_published">Is published?</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
