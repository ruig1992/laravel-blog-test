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
                        @include('admin.partials.buttons.btn-create', [
                            'btnCreateRouteName' => 'admin.articles.create',
                            'btnCreateLabel' => 'Create article',
                        ])
                    </div>

                    <div class="card-body">
                        <table class="table table-striped admin-table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Is published</th>
                                    <th scope="col">Published at</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            @include('admin.partials.buttons.btn-view-small', [
                                                'btnViewRoutePath' => route('blog.show', $article->slug),
                                            ])
                                            @include('admin.partials.buttons.btn-edit-small', [
                                                'btnEditRoutePath' => route('admin.articles.edit', $article),
                                            ])
                                            <form-delete-action
                                                action="{{ route('admin.articles.destroy', $article) }}"
                                                small="true"
                                            ></form-delete-action>
                                        </div>
                                    </td>
                                    <td>{{ $article->category->name }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td class="text-center">
                                        @if($article->is_published)
                                            <span class="badge badge-pill badge-success" title="Yes">&nbsp;</span>
                                        @else
                                            <span class="badge badge-pill badge-danger" title="No">&nbsp;</span>
                                        @endif
                                    </td>
                                    <td>{{ $article->published_at }}</td>
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
