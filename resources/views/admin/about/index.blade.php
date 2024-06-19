@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Biz Haqimizda</h4>

    @include('admin.success-alert')

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sarlavha</th>
                    <th scope="col">Tavsifi</th>
                    <th scope="col">Address</th>
                    <th scope="col">Qarta Linki</th>
                    <th scope="col">Video</th>
                    <th scope="col">Telegram</th>
                    <th scope="col">Instagram</th>
                    <th scope="col">Facebook</th>
                    <th scope="col">Telefon Raqami</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $i = 1;
                @endphp
                @foreach($abouts as $about)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$about->title}}</td>
                        <td>{!! $about->desc !!}</td>
                        <td>{{$about->address}}</td>
                        <td>{{$about->map}}</td>
                        <td>
                            <video style="width: 200px; height: 100px" controls>
                                <source src="{{ asset('storage/' . $about->video) }}" type="video/mp4">
                            </video>
                        </td>
                        <td>{{$about->telegram_account}}</td>
                        <td>{{$about->instagram}}</td>
                        <td>{{$about->facebook}}</td>
                        <td>{{$about->phone_number}}</td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('abouts.edit', $about->id) }}"
                                       class="btn btn-icon btn-warning me-2"><i class="bx bx-pencil"></i></a>
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
