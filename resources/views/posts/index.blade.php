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
                        <th>Category</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($posts as $post)
                        <tr>
                            <td><img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->image }}" width="120px" height="60px"></td>
                            <td>{{ $post->title }}</td>
                            <td><a href="{{ url('/categories/' . $post->category->id . '/edit') }}" class="text-decoration-none text-dark">{{ $post->category->name }}</a></td>

                            @if(!$post->trashed())
                                <td><a href="{{ url('/posts/' . $post->id . '/edit') }}" class="btn btn-info btn-sm">Edit</a></td>
                            @else
                                <td><button class="btn btn-info btn-sm text-white" onclick="event.preventDefault(); document.getElementById('restore{{ $post->id }}').submit();">Restore</button></td>
                                <form action="{{ url('/posts/' . $post->id . '/restore') }}" method="POST" style="display: none;" id="restore{{ $post->id }}">
                                    @csrf
                                    @method('put')
                                </form>
                            @endif
                            <td><a href="#" class="btn btn-danger btn-sm" onclick="event.preventDefault();document.getElementById('trash{{ $post->id }}').submit();">
                            @if ($post->trashed())
                                Trashed
                            @else
                                Delete
                            @endif
                            </a></td>
                            <form action="{{ url('/posts/' . $post->id) }}" method="post" id="trash{{ $post->id }}" style="display: none;">
                                @csrf
                                @method('delete')
                            </form>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

        @else

            <h3 class="text-center">No posts yet</h3>
        
        @endif

    </div>

@endsection
