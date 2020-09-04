@extends('layouts.app')

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
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control @if($errors->has('category_id'))is-invalid @endif"
                                        id="category"
                                        name="category_id"
                                >
                                    <option value="" disabled
                                        {{ (old('category_id') ? '' : 'selected') }}
                                    >__Select the category__</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (old('category_id') == $category->id ? 'selected' : '') }}
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span role="alert" class="invalid-feedback">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text"
                                       class="form-control @if($errors->has('title'))is-invalid @endif"
                                       id="title"
                                       name="title"
                                       value="{{ old('title') }}"
                                       maxlength="255"
                                >
                                <span role="alert" class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text"
                                       class="form-control @if($errors->has('description'))is-invalid @endif"
                                       id="description"
                                       name="description"
                                       value="{{ old('description') }}"
                                       maxlength="255"
                                >
                                <span role="alert" class="invalid-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control @if($errors->has('content'))is-invalid @endif"
                                          id="content"
                                          name="content"
                                          rows="3"
                                >{{ old('content') }}</textarea>
                                <span role="alert" class="invalid-feedback">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="published_at">Published datetime</label>
                                <input type="text"
                                       class="form-control"
                                       id="published_at"
                                       name="published_at"
                                       value="{{ old('published_at') }}"
                                >
                            </div>
                            <div class="form-check mb-4">
                                <input type="checkbox"
                                       value="1"
                                       class="form-check-input"
                                       id="is_published"
                                       name="is_published"
                                       checked
                                >
                                <label class="form-check-label" for="is_published">Is published?</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
