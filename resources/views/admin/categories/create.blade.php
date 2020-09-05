@extends('layouts.app')

@section('title', 'Create category')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('admin.partials.session-alert')

                <div class="card">
                    <div class="card-header">
                        <h3>Create a new category</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.categories.store') }}">
                            @csrf
                            @include('admin.categories.partials.form-elements')

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
