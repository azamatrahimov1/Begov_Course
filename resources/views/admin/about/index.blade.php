@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Biz Haqimizda</h4>

    @include('admin.success-alert')

    @if(auth()->user()->can('create'))
        <div class="modal fade" id="backDropModal" tabindex="-1" aria-hidden="true">
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

                    <form method="POST" action="{{ route('abouts.store') }}">
                        @csrf

                        <div class="modal-body">

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="desc" class="form-label">Tavsifi</label>
                                    <textarea name="desc" id="tinymce" class="form-control"
                                              rows="5">{{ old('desc') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col mb-0">
                                    <label for="address" class="form-label">Manzil</label>
                                    <input type="text" id="nameBackdrop" class="form-control" name="address"
                                           value="{{ old('address') }}" required/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col mb-0">
                                    <label for="telegram_account" class="form-label">Telegram Akkaunti</label>
                                    <input type="text" id="nameBackdrop" name="telegram_account" class="form-control"
                                           value="{{ old('telegram_account') }}" required/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col mb-0">
                                    <label for="phone_number" class="form-label">Telefon Raqami</label>
                                    <input type="tel" id="nameBackdrop" name="phone_number" class="form-control"
                                           value="{{ old('phone_number') }}" required/>
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
                data-bs-target="#backDropModal"
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
                    <th scope="col">Tavsifi</th>
                    <th scope="col">Address</th>
                    <th scope="col">Telegram</th>
                    <th scope="col">Phone Number</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $i = 1;
                @endphp
                @foreach($abouts as $about)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{!! $about->desc !!}</td>
                        <td>{{$about->address}}</td>
                        <td>{{$about->telegram_account}}</td>
                        <td>{{$about->phone_number}}</td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('abouts.edit', $about->id) }}"
                                       class="btn btn-warning me-2"><i class="bx bx-pencil me-2"></i></a>
                                @endif
                                @if(auth()->user()->can('delete'))
                                    <form action="{{ route('abouts.destroy', $about->id) }}" method="POST"
                                          id="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="btn btn-danger"
                                                onclick="delete_button({{$about->id}})">
                                            <i class="bx bx-trash-alt"></i>
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
                    form.action = '/abouts/' + id;
                    form.submit()
                }
            })
        }

    </script>

@endsection
