@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url('categories/create') }}" class="btn btn-success">Add Category</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        @if (!($categories->isEmpty()))
            <div class="card card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
