@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Mijozlar</h4>

    @include('admin.success-alert')

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
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('users.store') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="name" class="form-label">To'liq Ism</label>
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="email" class="form-label">Elektron Pochta</label>
                                                <input type="email" id="emailExLarge" class="form-control" name="email" value="{{ old('email') }}" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="password" class="form-label">Parol</label>
                                                <input type="password" id="dobExLarge" name="password" class="form-control" value="{{ old('password') }}" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="phone_number" class="form-label">Telefon Raqami</label>
                                                <input type="tel" id="emailExLarge" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="end_date" class="form-label">Tugash Sanasi</label>
                                                <input type="datetime-local" id="dobExLarge" name="end_date" class="form-control" value="{{ old('end_date') }}" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Yopmoq</button>
                                        <button type="submit" class="btn btn-primary">Saqlash</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="demo-inline-spacing mb-3 d-flex">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
                            <i class="bx bx-plus"></i>
                        </button>
                        <form action="{{ route('users.index') }}" method="GET" class="d-inline">
                            <input type="hidden" name="filter" value="expired">
                            <button class="btn btn-danger" type="submit">
                                <i class="bx bx-filter-alt"></i>
                            </button>
                        </form>
{{--                        @include('admin.users.delete-expired')--}}
                    </div>

                </div>
                <div class="col-md-6">
                    <form action="{{ route('users.index') }}" method="GET" class="d-flex justify-content-end align-items-center">
                        <input type="text" class="form-control me-2" placeholder="Search" name="search" id="searche" value="{{ request()->get('search') }}">
                        <button class="btn btn-primary me-2" id="showToastPlacement" type="submit">
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
                    <th scope="col">Telefon Raqami</th>
                    <th scope="col">Yaratilgan Sanasi</th>
                    <th scope="col">Tugash Sanasi</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $i = 1;
                @endphp
                @foreach($users as $user)
                    @php
                        $endDate = \Carbon\Carbon::parse($user->end_date);
                        $isExpired = $endDate->isPast();
                    @endphp
                    <tr class="{{ $isExpired ? 'table-danger' : '' }}">
                        <td>{{ $i++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        <td>{{ $endDate->format('d-m-Y') }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-icon btn-warning me-2"><i class="bx bx-pencil"></i></a>

                                <button type="button" class="btn btn-icon btn-danger me-2" data-bs-toggle="modal" data-bs-target="#modalToggle{{ $user->id }}"><i class="bx bx-trash-alt"></i></button>
                                <div class="modal fade" id="modalToggle{{ $user->id }}" aria-labelledby="modalToggleLabel{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalToggleLabel{{ $user->id }}">Buni qaytara olmaysiz!</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">{{ $user->name }}</div>
                                            <div class="modal-footer">
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">O'chirish</button>
                                                </form>
                                                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Ortga</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

@endsection
