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
            @include('partial.errors')
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
                    <textarea name="description" id="description" rows="5" class="form-control">{{ isset($post) ? $post->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    {{-- <textarea name="content" id="content" rows="5" class="form-control">{{ isset($post) ?? $post->content }}</textarea> --}}
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" class="form-control" id="published_at" name="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
                </div>
                @if(isset($post))
                <div class="form-group">
                    <img class="img-fluid" src="{{ asset('/storage/' . $post->image) }}" alt="">
                </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                @if (!$categories->isEmpty())
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @if (isset($post))
                                    @if ($category->name === $post->category->name)
                                        selected
                                    @endif
                                @endif
                                >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                @if (!$tags->isEmpty())
                <div class="form-group">
                    <label for="tag_id">Tag</label>
                    <select name="tag_id[]" id="tag_id" class="form-control tags-selector" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @if (isset($post))
                                    @if (in_array($tag->id, $post->tags->pluck('id')->toArray()))
                                        selected
                                    @endif
                                @endif
                                >{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{ isset($post) ? 'Update post' : 'Create post' }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/trix.js') }}"></script>
    <script src="{{ asset('js/flatpickr') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}" defer></script>
    <script>

        /* ---------- Start of Date picker js ---------- */
        flatpickr("#published_at", {
            enableTime: true
        });
        /* ---------- End of Date picker js ---------- */

        /* ---------- Start of Select2 js ---------- */
        $(document).ready(function() {
            $('.tags-selector').select2();
        });
        /* ---------- End of Select2 js ---------- */
    </script>
@endsection
