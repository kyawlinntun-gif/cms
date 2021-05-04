@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            @if (isset($category))
                Edit Category
            @else
                Create Category
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

            <form action="{{ isset($category) ? url('/categories/' . $category->id) : url('/categories') }}" method="POST">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ isset($category) ? $category->name : '' }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{ isset($category) ? 'Update Category' : 'Create Category' }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
