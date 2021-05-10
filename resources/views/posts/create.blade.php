@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            @if (isset($post))
                Edit post
            @else
                Create post
            @endif
        </div>
        <div class="card-body">

            {{-- ---------- Start of Form Errors ---------- --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- ---------- End of Form Errors ---------- --}}

            <form action="{{ isset($post) ? url('/posts/' . $post->id) : url('/posts') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input id="title" class="form-control" type="text" name="title" value="{{ isset($post) ? $post->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="5" class="form-control">{{ isset($post) ?? $post->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="5" class="form-control">{{ isset($post) ?? $post->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" class="form-control" id="published_at" name="published_at" value="{{ isset($post) ?? $post->published_at }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{ isset($post) ? 'Update post' : 'Create post' }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
