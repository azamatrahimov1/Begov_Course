@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"></span> O'quvchilarimiz</h4>

    @include('admin.success-alert')

    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('desc')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @if(auth()->user()->can('create'))
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

                    <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">To'liq ism</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name') }}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="image" class="form-label">Fotosurat</label>
                                    <input type="file" name="image" class="form-control" accept="image/*"
                                           value="{{ old('image') }}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="desc" class="form-label">Tavsifi</label>
                                    <textarea name="desc" class="form-control"
                                              rows="5">{{ old('desc') }}</textarea>
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
            ><i class="bx bx-plus me-1"></i>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sarlavha</th>
                    <th scope="col">Fotosurat</th>
                    <th scope="col">Tavsifi</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $i = 1;
                @endphp
                @foreach($students as $student)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$student->name}}</td>
                        <td>
                            <img src="{{ asset('storage/'. $student->image) }}" style="height: 100px; width: 100px"/>
                        </td>
                        <td>{{ $student->desc }}</td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('student.edit', $student->id) }}"
                                       class="btn btn-icon btn-warning me-2"><i
                                            class="bx bx-pencil me-2"></i></a>
                                @endif
                                @if(auth()->user()->can('delete'))
                                    <button type="button" class="btn btn-icon btn-danger me-2"
                                            data-bs-toggle="modal" data-bs-target="#modalToggle{{$student->id}}">
                                        <i class="bx bx-trash-alt"></i></button>

                                    <div class="modal fade" id="modalToggle{{$student->id}}"
                                         aria-labelledby="modalToggleLabel{{$student->id}}" tabindex="-1"
                                         style="display: none" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel{{$student->id}}">
                                                        Buni qaytara olmaysiz!</h5>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">{{ $student->title }}</div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('student.destroy', $student->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">O'chirish
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Ortga
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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

@endsection

