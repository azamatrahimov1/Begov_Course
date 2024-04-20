@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tahrirlash/</span> Logotip</h4>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('logo.update', $logo->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Sarlavha</label>
                    <input type="text" class="form-control" name="title" value="{{ $logo->title }}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Fotosurat</label>
                    <input type="file" class="form-control" name="image" value="{{ $logo->image }}">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Topshirish</button>
                </div>

            </form>
        </div>
    </div>

@endsection
