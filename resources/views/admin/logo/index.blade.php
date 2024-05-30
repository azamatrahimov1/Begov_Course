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
                    <th scope="col">Sarlavha</th>
                    <th scope="col">Fotosurat</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($logos as $logo)
                    <tr>
                        <td>{{$logo->title}}</td>
                        <td>
                            <img src="{{ asset('storage/'. $logo->image) }}" style="height: 100px; width: 100px"/>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('logo.edit', ['logo' => $logo->id]) }}" class="btn btn-icon btn-warning me-2">
                                        <i class="bx bx-pencil"></i>
                                    </a>
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
