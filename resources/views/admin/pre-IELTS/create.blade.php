@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Create /</span> Pre IELTS</h4>

    <div class="row">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('desc')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <!-- File input -->
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <form method="POST" action="{{ route('pre-IELTS.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="p-2 mb-2 bg-light text-dark form-control" name="name"
                                   value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="desc" class="form-label">Description:</label>
                            <textarea name="desc" id="summernote" class="form-control"
                                      rows="3">{{ old('desc') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@endsection
