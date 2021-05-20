@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">My Profile</div>

            <div class="card-body">

                @include('partial.errors')
                
                @if ($user)
                <form action="{{ url('/users/profile') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="about">About Me</label>
                        <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{ $user->about }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update Profile</button>
                </form>
                @endif

            </div>
        </div>
    </div>
@endsection
