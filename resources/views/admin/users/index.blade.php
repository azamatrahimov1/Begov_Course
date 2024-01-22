@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Costumers</h4>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Basic Bootstrap Table -->
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
        <li class="nav-item">
            @if(auth()->user()->can('create'))
                <a class="nav-link active" href="{{ route('user.create') }}"><i class="bx bx-plus me-1"></i> Create</a>
            @endif
        </li>
    </ul>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Created At</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        </td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->end_date }}</td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('user.edit', $user->id) }}"
                                       class="btn btn-warning me-2">Edit</a>
                                @endif
                                @if(auth()->user()->can('delete'))
                                    <form action="{{ route('user.delete', $user->id) }}" method="POST"
                                          id="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="btn btn-danger"
                                                onclick="delete_button({{$user->id}})">
                                            <i class="bx bx-trash me-2"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
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
                    form.action = '/user/' + id;
                    form.submit()
                }
            })
        }

    </script>

@endsection
