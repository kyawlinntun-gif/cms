@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url('categories/create') }}" class="btn btn-success">Add Category</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        @if (!($categories->isEmpty()))
        <div class="card card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ url('/categories/' . $category->id . '/edit') }}"
                                class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="showModal({{ $category->id }})">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- ---------- Start of Model ---------- --}}
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <form action="" method="POST" id="deleteCategoryForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center text-bold">
                                Are you sure you want to delete this category?
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
        @endif
    </div>

@endsection

@section('script')

    <script>
        function showModal(id) {
            var form = document.getElementById('deleteCategoryForm');
            form.action = '/categories/' + id;
            $("#deleteModal").modal('show');
        }
    </script>

@endsection
