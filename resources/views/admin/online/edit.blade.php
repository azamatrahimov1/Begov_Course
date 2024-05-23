@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tahrirlash/</span> Onlayn Dars</h4>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('online.update', $online->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Sarlavha</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $online->title) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Fotosurat</label>
                    <input type="file" class="form-control" name="image" value="{{ old('image', $online->image) }}" accept="image/*">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Narx</label>
                    <input type="number" class="form-control" name="price" value="{{ old('price', $online->price) }}">
                    @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="teacher" class="form-label">O'qituvchi</label>
                    <input type="text" class="form-control" name="teacher" value="{{ old('teacher', $online->teacher) }}">
                    @error('teacher')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="student" class="form-label">O'quvchi soni</label>
                    <input type="text" class="form-control" name="student" value="{{ old('student', $online->student) }}">
                    @error('student')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="hour" class="form-label">Dars Vaqti</label>
                    <input type="text" class="form-control" name="hour" value="{{ old('hour', $online->hour) }}">
                    @error('hour')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Tavsif</label>
                    <textarea name="desc" id="tinymce" class="form-control" rows="5">{{ old('desc', $online->desc) }}</textarea>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Topshirish</button>
                </div>

            </form>
        </div>
    </div>

@endsection
