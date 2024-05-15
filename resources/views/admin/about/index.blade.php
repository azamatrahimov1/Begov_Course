@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Biz Haqimizda</h4>

    @include('admin.success-alert')

    @error('desc')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('address')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('video')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('telegram_account')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('phone_number')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

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

                    <form method="POST" action="{{ route('abouts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">

                            <div class="row mb-3">
                                <div class="col mb-0">
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
                            <div class="row bm-3">
                                <div class="col mb-0">
                                    <label for="video" class="form-label">Video</label>
                                    <input type="file" id="video" name="video" class="form-control" accept="video/*" required>
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
                    <th scope="col">Video</th>
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
                        <td>
                            <video style="width: 200px; height: 100px" controls>
                                <source src="{{ asset('storage/' . $about->video) }}" type="video/mp4">
                            </video>
                        </td>
                        <td>{{$about->telegram_account}}</td>
                        <td>{{$about->phone_number}}</td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('abouts.edit', $about->id) }}"
                                       class="btn btn-icon btn-warning me-2"><i class="bx bx-pencil"></i></a>
                                @endif

                                @if(auth()->user()->can('delete'))
                                    <button type="button" class="btn btn-icon btn-danger me-2"
                                            data-bs-toggle="modal" data-bs-target="#modalToggle{{$about->id}}">
                                        <i class="bx bx-trash-alt"></i></button>

                                    <div class="modal fade" id="modalToggle{{$about->id}}"
                                         aria-labelledby="modalToggleLabel{{$about->id}}" tabindex="-1"
                                         style="display: none" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel{{$about->id}}">
                                                        Buni qaytara olmaysiz!</h5>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">{{ $about->address }}</div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('abouts.destroy', $about->id) }}"
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
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')

@endsection
