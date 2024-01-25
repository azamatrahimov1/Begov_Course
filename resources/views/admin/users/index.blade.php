@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Mijozlar</h4>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('phone_number')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror


    <div class="card mb-3">
        <div class="card-body">
            <div class="row gx-3 gy-2 align-items-center">
                <div class="col-md-6">
                    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
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

                                <form method="POST" action="{{ route('users.store') }}">
                                    @csrf

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="name" class="form-label">To'liq Ism</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{ old('name') }}" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="email" class="form-label">Elektron Pochta</label>
                                                <input type="email" id="emailExLarge" class="form-control" name="email"
                                                       value="{{ old('email') }}" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="password" class="form-label">Parol</label>
                                                <input type="password" id="dobExLarge" name="password"
                                                       class="form-control"
                                                       value="{{ old('password') }}" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="phone_number" class="form-label">Telefon Raqami</label>
                                                <input type="tel" id="emailExLarge" name="phone_number"
                                                       class="form-control"
                                                       value="{{ old('phone_number') }}" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="end_date" class="form-label">Tugash Sanasi</label>
                                                <input type="datetime-local" id="dobExLarge" name="end_date"
                                                       class="form-control"
                                                       value="{{ old('end_date') }}" required/>
                                            </div>
                                        </div>
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
                            data-bs-target="#exLargeModal"
                        ><i class="bx bx-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('users.index') }}" method="GET" class="d-grid gap-1 d-md-flex justify-content-md-end">
                        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request()->get('search') }}">
                        <button class="btn btn-primary" id="showToastPlacement" type="submit">
                            <i class="bx bx-search"></i>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Toliq Ismi</th>
                        <th scope="col">Elektron Pochta</th>
                        <th scope="col">Roli</th>
                        <th scope="col">Telefon Raqami</th>
                        <th scope="col">Da Yaratilgan</th>
                        <th scope="col">Tugash Sanasi</th>
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
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="btn btn-warning me-2"><i class="bx bx-pencil me-2"></i></a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                          id="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="btn btn-danger"
                                                onclick="delete_button({{$user->id}})">
                                            <i class="bx bx-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    {!! $users !!}

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
