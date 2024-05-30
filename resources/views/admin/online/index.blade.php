@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Darslar Turi/</span> Onlayn Dars</h4>

    @include('admin.success-alert')

    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('desc')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Sarlavha</th>
                    <th scope="col">Fotosurat</th>
                    <th scope="col">Narx</th>
                    <th scope="col">O'qituvchi</th>
                    <th scope="col">O'quvchi Soni</th>
                    <th scope="col">Dars vaqti</th>
                    <th scope="col">Tavsifi</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($onlines as $online)
                    <tr>
                        <td>{{$online->title}}</td>
                        <td>
                            <img src="{{ asset('storage/'. $online->image) }}" style="height: 100px; width: 100px"/>
                        </td>
                        <td>{{ $online->price }}</td>
                        <td>{{ $online->teacher }}</td>
                        <td>{{ $online->student }}</td>
                        <td>{{ $online->hour }}</td>
                        <td>{!! $online->desc !!}</td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('online.edit', $online->id) }}" class="btn btn-icon btn-warning me-2">
                                        <i class="bx bx-pencil me-2"></i>
                                    </a>
                                @endif

                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>

        </div>
    </div>

    <!-- End Online Lessons -->

@endsection

@section('script')

@endsection

