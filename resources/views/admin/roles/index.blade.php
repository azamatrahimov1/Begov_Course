@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Rollar</h4>

    @include('admin.success-alert')

    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('permissions')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('permissions.*')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @if(auth()->user()->can('create'))
        <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>

                    <form method="POST" action="{{ route('role.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Nomi</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required/>
                                </div>
                            </div>
                            @foreach($permissions as $permission)
                                <div class="row">
                                    <div class="col mb-3">
                                        <input class="form-check-input" type="checkbox" id="{{$permission->id}}"
                                               name="permissions[]" value="{{$permission->id}}"/>
                                        <label class="form-check-label" for="{{$permission->id}}"
                                        >{{$permission->name}}</label
                                        >
                                    </div>
                                </div>

                            @endforeach

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Yopmoq
                            </button>
                            <button type="submit" class="btn btn-primary">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="demo-inline-spacing mb-3">
            <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#largeModal"
            ><i class="bx bx-plus me-1"></i>
            </button>
        </div>
    @endif

    <div class="card">

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">Nomi</th>
                </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                @foreach($roles as $role)
                    <tbody class="table-border-bottom-0">
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-warning me-2"
                                   href="{{ route('role.edit', ['role' => $role->id]) }}"
                                ><i class="bx bx-pencil me-2"></i></a>
                                <form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST"
                                      id="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="btn btn-danger"
                                            onclick="delete_button({{$role->id}})">
                                        <i class="bx bx-trash-alt"></i>
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
