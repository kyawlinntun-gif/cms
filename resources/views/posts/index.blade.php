@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url('posts/create') }}" class="btn btn-success">Add Post</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>

        @if (count($posts) > 0)
        
        <div class="card-body">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($posts as $post)
                        <tr>
                            <td><img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->image }}" width="120px" height="60px"></td>
                            <td>{{ $post->title }}</td>
                            <td><a href="#" class="btn btn-info btn-sm">Edit</a></td>
                            <td><a href="#" class="btn btn-danger btn-sm">Transh</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        
        @endif

    </div>

@endsection
