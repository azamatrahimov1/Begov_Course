@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tahrirlash/</span> O'quvchini</h4>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('student.update', $student->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">To'liq ism</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $student->name) }}">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Fotosurat</label>
                    <input type="file" class="form-control" name="image" value="{{ old('image', $student->image) }}" accept="image/*">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Tavsif</label>
                    <textarea name="desc" class="form-control" rows="5">{{ old('desc', $student->desc) }}</textarea>
                    @error('desc')
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
