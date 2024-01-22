@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit /</span> Pre IELTS</h4>

    <div class="row">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <form method="POST" action="{{ route('chapters.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Chapter Name:</label>
                            <input type="text" class="p-2 mb-2 bg-light text-dark form-control" name="name"
                                   value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Parent ID:</label>
                            <input type="number" class="p-2 mb-2 bg-light text-dark form-control"
                                   name="parent_id" placeholder="1"
                                   value="{{ old('parent_id') }}" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
