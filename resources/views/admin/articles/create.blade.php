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
                                <select class="form-control" id="category" name="category_id" required>
                                    <option value="" selected disabled>__Select the category__</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text"
                                       class="form-control"
                                       id="title"
                                       name="title"
                                       maxlength="255"
                                       required
                                >
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text"
                                       class="form-control"
                                       id="description"
                                       name="description"
                                       maxlength="255"
                                       required
                                >
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="title">Published datetime</label>
                                <input type="text"
                                       class="form-control"
                                       id="published_at"
                                       name="published_at"
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
