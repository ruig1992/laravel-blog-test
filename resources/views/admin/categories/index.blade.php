@extends('layouts.app')

@section('title', 'Admin :: categories list')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('admin.partials.session-alert')

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Categories list</h3>
                        @include('admin.partials.buttons.btn-create', [
                            'btnCreateRouteName' => 'admin.categories.create',
                            'btnCreateLabel' => 'Create category',
                        ])
                    </div>

                    <div class="card-body">
                        <table class="table table-striped admin-table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            @include('admin.partials.buttons.btn-edit-small', [
                                                'btnEditRoutePath' => route('admin.categories.edit', $category),
                                            ])
                                            <form-delete-action
                                                action="{{ route('admin.categories.destroy', $category) }}"
                                                :small="true"
                                            ></form-delete-action>
                                        </div>
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
