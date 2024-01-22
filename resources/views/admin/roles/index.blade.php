@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Roles</h4>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Basic Bootstrap Table -->
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('role.create') }}"
            ><i class="bx bx-plus me-1"></i> Create</a>
        </li>
    </ul>
    <div class="card">

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                @foreach($roles as $role)
                    <tbody class="table-border-bottom-0">
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-warning me-2"
                                   href="{{ route('role.edit', ['role' => $role->id]) }}"
                                > Edit</a>
                                <form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST"
                                      id="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="btn btn-danger"
                                            onclick="delete_button({{$role->id}})">
                                        <i class="bx bx-trash me-2"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script>
        form = document.getElementById('form-delete');

        function delete_button(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.action = '/role/' + id;
                    form.submit()
                }
            })
        }
    </script>
@endsection
