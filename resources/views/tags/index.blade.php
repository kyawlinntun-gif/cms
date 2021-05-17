@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url('tags/create') }}" class="btn btn-success">Add Tag</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            Tags
        </div>
        @if (!($tags->isEmpty()))
        <div class="card card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Posts Count</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->posts->count() }}</td>
                        <td>
                            <a href="{{ url('/tags/' . $tag->id . '/edit') }}"
                                class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="showModal({{ $tag->id }})">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- ---------- Start of Model ---------- --}}
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <form action="" method="POST" id="deletetagForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete tag</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center text-bold">
                                Are you sure you want to delete this tag?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Go Back</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- ---------- End of Model ---------- --}}

        </div>

        @else

            <h3 class="text-center">No tags yet</h3>

        @endif
    </div>

@endsection

@section('script')

    <script>
        function showModal(id) {
            var form = document.getElementById('deletetagForm');
            form.action = '/tags/' + id;
            $("#deleteModal").modal('show');
        }
    </script>

@endsection
