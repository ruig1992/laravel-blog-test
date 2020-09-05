@extends('layouts.app')

@section('title', "Edit the category #{$category->id}")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('admin.partials.session-alert')

                <div class="card">
                    <div class="card-header">
                        <h3>Edit the category #{{ $category->id }}</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                            @csrf
                            @method('PUT')
                            @include('admin.categories.partials.form-elements')

                            <div class="d-flex">
                                <div class="mr-2">
                                    @include('admin.partials.buttons.btn-save')
                                </div>
                                <form-delete-action
                                    action="{{ route('admin.categories.destroy', $category) }}"
                                    show-label="true"
                                ></form-delete-action>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
