@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Create Category
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

            <form action="{{ url('/categories') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Add Category</button>
                </div>
            </form>
        </div>
    </div>

@endsection
