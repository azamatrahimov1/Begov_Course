@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Jamoa a'zolari</h4>

    @include('admin.success-alert')

    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('job')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('telegram')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('instagram')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('facebook')
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

                    <form method="POST" action="{{ route('team.store') }}" enctype="multipart/form-data">
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
                                    <label for="job" class="form-label">Ishi</label>
                                    <input type="text" class="form-control" name="job"
                                           value="{{ old('job') }}"/>
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
                                    <label for="telegram" class="form-label">Telegram</label>
                                    <input type="text" name="telegram" class="form-control" value="{{ old('telegram') }}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" name="instagram" class="form-control" value="{{ old('instagram') }}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" name="facebook" class="form-control" value="{{ old('facebook') }}"/>
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
                    <th scope="col">To'liq ism</th>
                    <th scope="col">Ishi</th>
                    <th scope="col">Fotosurat</th>
                    <th scope="col">Telegram</th>
                    <th scope="col">Instagram</th>
                    <th scope="col">Facebook</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $i = 1;
                @endphp
                @foreach($teams as $team)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$team->name}}</td>
                        <td>{{$team->job}}</td>
                        <td>
                            <img src="{{ asset('storage/'. $team->image) }}" style="height: 100px; width: 100px"/>
                        </td>
                        <td>{{$team->telegram}}</td>
                        <td>{{$team->instagram}}</td>
                        <td>{{$team->facebook}}</td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('team.edit', $team->id) }}"
                                       class="btn btn-icon btn-warning me-2"><i class="bx bx-pencil"></i></a>
                                @endif

                                @if(auth()->user()->can('delete'))
                                    <button type="button" class="btn btn-icon btn-danger me-2"
                                            data-bs-toggle="modal" data-bs-target="#modalToggle{{$team->id}}">
                                        <i class="bx bx-trash-alt"></i></button>

                                    <div class="modal fade" id="modalToggle{{$team->id}}"
                                         aria-labelledby="modalToggleLabel{{$team->id}}" tabindex="-1"
                                         style="display: none" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel{{$team->id}}">
                                                        Buni qaytara olmaysiz!</h5>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">{{ $team->address }}</div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('team.destroy', $team->id) }}"
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
