@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            @if (isset($tag))
                Edit Tag
            @else
                Create Tag
            @endif
        </div>
        <div class="card-body">

            {{-- ---------- Start of Form Errors ---------- --}}
            @include('partial.errors')
            {{-- ---------- End of Form Errors ---------- --}}

            <form action="{{ isset($tag) ? url('/tags/' . $tag->id) : url('/tags') }}" method="POST">
                @csrf
                @if (isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ isset($tag) ? $tag->name : '' }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{ isset($tag) ? 'Update Tag' : 'Create Tag' }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
