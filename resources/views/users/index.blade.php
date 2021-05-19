@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Users
        </div>

        @if (count($users) > 0)
        
        <div class="card-body">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($users as $user)
                        <tr>
                            <td><img src="{{ Gravatar::src($user->email) }}" alt="" style="height: 40px;width: 40px; border-radius: 50%;"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (!$user->isAdmin())
                                <a href="{{ url('/users/' . $user->id . '/make-admin') }}" class="btn btn-primary btn-sm">Make Admin</a>
                                @endif
                            </td>
                            <td></td>
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
