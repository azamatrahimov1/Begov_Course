@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Logotip</h4>

    @include('admin.success-alert')

    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

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
                @foreach($logos as $logo)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$logo->title}}</td>
                        <td>
                            <img src="{{ asset('storage/'. $logo->image) }}" style="height: 100px; width: 100px"/>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('logo.edit', ['logo' => $logo->id]) }}"
                                       class="btn btn-icon btn-warning me-2"><i class="bx bx-pencil"></i></a>
                                @endif

                                @if(auth()->user()->can('delete'))
                                    <button type="button" class="btn btn-icon btn-danger me-2" data-bs-toggle="modal"
                                            data-bs-target="#modalToggle{{$logo->id}}"><i class="bx bx-trash-alt"></i>
                                    </button>

                                    <div class="modal fade" id="modalToggle{{$logo->id}}"
                                         aria-labelledby="modalToggleLabel{{$logo->id}}" tabindex="-1"
                                         style="display: none" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel{{$logo->id}}">Buni
                                                        qaytara olmaysiz!</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">{{ $logo->title }}</div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('logo.destroy', ['logo' => $logo->id]) }}"
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
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')

@endsection
