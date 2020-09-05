@extends('layouts.app')

@section('title', 'Admin :: articles list')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('admin.partials.session-alert')

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Articles list</h3>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Create article</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped admin-table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Is published</th>
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('blog.show', $article->slug) }}"
                                               class="btn btn-sm btn-success mr-2"
                                               target="_blank"
                                            >View</a>
                                            <a href="{{ route('admin.articles.edit', $article) }}"
                                               class="btn btn-sm btn-info mr-2"
                                            >Edit</a>
                                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $article->category->name }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td class="text-center">
                                        @if($article->is_published)
                                            <span class="badge badge-pill badge-success"
                                                  title="Yes"
                                            >&nbsp;</span>
                                        @else
                                            <span class="badge badge-pill badge-danger"
                                                  title="No"
                                            >&nbsp;</span>
                                        @endif
                                    </td>
                                    <td>{{ $article->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
