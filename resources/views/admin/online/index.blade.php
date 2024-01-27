@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Darslar Turi/</span> Onlayn Dars</h4>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('desc')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <!-- Online Lessons -->
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

                    <form method="POST" action="{{ route('online.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="title" class="form-label">Sarlavha</label>
                                    <input type="text" class="form-control" name="title"
                                           value="{{ old('title') }}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="image" class="form-label">Fotosurat</label>
                                    <input type="file" name="image" class="form-control"
                                           value="{{ old('image') }}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="desc" class="form-label">Tavsifi</label>
                                    <textarea name="desc" id="tinymce" class="form-control"
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
                    @foreach($onlines as $online)
                        <tr>
                            <td>{{$online->id}}</td>
                            <td>{{$online->title}}</td>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li
                                        data-bs-toggle="modal"
                                        data-bs-target="#imageModal{{$online->id}}"
                                        data-bs-placement="top"
                                        class="avatar avatar-md pull-up"
                                    >
                                        <img src="{{ asset('storage/'.$online->image) }}" class="rounded-circle"/>
                                    </li>
                                </ul>
                            </td>
                            <td>{!! $online->desc !!}</td>
                            <td>
                                <div class="d-flex">
                                    @if(auth()->user()->can('edit'))
                                        <a href="{{ route('online.edit', $online->id) }}"
                                           class="btn btn-icon btn-warning me-2"><i
                                                class="bx bx-pencil me-2"></i></a>
                                    @endif
                                    @if(auth()->user()->can('delete'))
                                        <form
                                            action="{{ route('online.destroy', $online->id) }}"
                                            method="POST" id="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-icon btn-danger"
                                                    onclick="delete_button({{$online->id}})">
                                                <i class="bx bx-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <!-- Модальное окно -->
                    <div class="modal fade" id="imageModal{{$online->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Закрыть"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('storage/'.$online->image) }}" class="img-fluid"
                                         alt="Modal Image">
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </table>

            </div>
        </div>

    <!-- End Online Lessons -->

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
                    form.action = 'online/' + id;
                    form.submit()
                }
            })
        }

    </script>

@endsection

