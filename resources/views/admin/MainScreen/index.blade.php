@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Asosiy Ekran</h4>

    @include('admin.success-alert')

    @error('image')
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

                <form method="POST" action="{{ route('main-screen.store') }}" enctype="multipart/form-data">
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
                                <input type="file" name="image" class="form-control" accept="image/*"
                                       value="{{ old('image') }}"/>
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
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $i = 1;
                @endphp
                @foreach($mainScreens as $mainScreen)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$mainScreen->title}}</td>
                        <td>
                            <img src="{{ asset('storage/'. $mainScreen->image) }}" style="height: 100px; width: 100px"/>
                        </td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('main-screen.edit', ['main_screen' => $mainScreen->id]) }}"
                                       class="btn btn-icon btn-warning me-2"><i class="bx bx-pencil me-2"></i></a>
                                @endif
                                @if(auth()->user()->can('delete'))
                                        <button type="button" class="btn btn-icon btn-danger me-2" data-bs-toggle="modal"
                                                data-bs-target="#modalToggle{{$mainScreen->id}}"><i class="bx bx-trash-alt"></i>
                                        </button>

                                        <div class="modal fade" id="modalToggle{{$mainScreen->id}}"
                                             aria-labelledby="modalToggleLabel{{$mainScreen->id}}" tabindex="-1"
                                             style="display: none" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalToggleLabel{{$mainScreen->id}}">Buni
                                                            qaytara olmaysiz!</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">{{ $mainScreen->title }}</div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('main-screen.destroy', ['main_screen' => $mainScreen->id]) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">O'chirish</button>
                                                        </form>
                                                        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            Ortga
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
                <!-- Модальное окно -->
                <div class="modal fade" id="imageModal{{$mainScreen->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Закрыть"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/'.$mainScreen->image) }}" class="img-fluid"
                                     alt="Modal Image">
                            </div>
                        </div>
                    </div>
                </div>

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
                    form.action = '/main-screen/' + id;
                    form.submit()
                }
            })
        }

    </script>

@endsection
