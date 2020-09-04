@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Articles list</h3>
                        <a href="#" class="btn btn-primary">Create article</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped admin-table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Is published</th>
                                    <th scope="col">Updated at</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td scope="row">
                                        <a href="#" class="btn btn-sm btn-success">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
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
                                    <td>{{ $article->updated_at }}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="4">{{ $articles->links() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
