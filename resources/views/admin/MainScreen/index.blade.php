@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Main Screen</h4>
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
                <a class="nav-link active" href="{{ route('main-screen.create') }}"><i class="bx bx-plus me-1"></i> Create</a>
            @endif
        </li>
    </ul>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($mainScreens as $mainScreen)
                    <tr>
                        <td>{{$mainScreen->id}}</td>
                        <td>{{$mainScreen->title}}</td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li
                                    data-bs-toggle="modal"
                                    data-bs-target="#imageModal{{$mainScreen->id}}"
                                    data-bs-placement="top"
                                    class="avatar avatar-md pull-up"
                                >
                                    <img src="{{ asset('storage/'.$mainScreen->image) }}" class="rounded-circle" />
                                </li>
                            </ul>

                        </td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('main-screen.edit', ['main_screen' => $mainScreen->id]) }}"
                                       class="btn btn-warning me-2">Edit</a>
                                @endif
                                @if(auth()->user()->can('delete'))
                                        <form action="{{ route('main-screen.destroy', ['main_screen' => $mainScreen->id]) }}" method="POST"  id="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-danger"
                                                    onclick="delete_button({{$mainScreen->id}})">
                                                <i class="bx bx-trash me-2"></i>
                                            </button>
                                        </form>
                                    @endif
                            </div>
                        </td>
                    </tr>
                </tbody>
                <!-- Модальное окно -->
                <div class="modal fade" id="imageModal{{$mainScreen->id}}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/'.$mainScreen->image) }}" class="img-fluid" alt="Modal Image">
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
