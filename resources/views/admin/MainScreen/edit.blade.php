@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Create</span> Main Screen</h4>
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('main-screen.update', $mainScreen->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" name="title" value="{{ $mainScreen->title }}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" name="image" value="{{ $mainScreen->image }}" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>

@endsection
