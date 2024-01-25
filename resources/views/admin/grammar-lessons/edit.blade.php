@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tahrirlash/</span> {{ $lesson->name }}</h4>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('name_video')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('video')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('name_image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('voice')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('pdf')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('homework')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('answer')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('lessons.update', $lesson->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label">Dars Nomi</label>
                        <input type="text" class="form-control" name="name"
                               value="{{ old('name', $lesson->name) }}" required/>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name_video" class="form-label">Name Video</label>
                    <input type="text" class="form-control" name="name_video"
                           value="{{ old('name_video', $lesson->name_video) }}">
                </div>

                <div class="mb-3">
                    <label for="video" class="form-label">Video File</label>
                    <input type="file" class="form-control mb-1" name="video"
                           value="{{ old('video', $lesson->video) }}">
                    <p>Current Video: {{ $lesson->video }}</p>
                </div>

                <div class="mb-3">
                    <label for="name_image" class="form-label">Name Video</label>
                    <input type="text" class="form-control" name="name_image"
                           value="{{ old('name_image', $lesson->name_image) }}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control mb-1" name="image"
                           value="{{ old('image', $lesson->image) }}">
                    @if($lesson->image)
                        <img src="{{ asset('storage/'.$lesson->image) }}" width="95">
                    @endif
                </div>

                <div class="mb-3">
                    <label for="pdf" class="form-label">PDF</label>
                    <input type="file" name="pdf" class="form-control mb-1" value="{{ old('pdf', $lesson->pdf) }}">
                    @if($lesson->pdf)
                        <p>Current PDF: <a href="{{ asset('storage/'.$lesson->pdf) }}"
                                           target="_blank">{{ $lesson->pdf }}</a></p>
                    @endif

                </div>

                <div class="mb-3">
                    <label for="voice" class="form-label">Voice:</label>
                    <input type="file" class="form-control mb-1" name="voice"
                           value="{{ old('voice', $lesson->voice) }}">
                    @if($lesson->voice)
                        <audio controls>
                            <source src="{{ asset('storage/'.$lesson->voice) }}" type="audio/mp3">
                            Your browser does not support the audio element.
                        </audio>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="homework" class="form-label">Homework</label>
                    <textarea name="homework" id="tinymce" class="form-control"
                              rows="5">{{ old('answer', $lesson->homework) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="answer" class="form-label">Answer:</label>
                    <textarea name="answer" id="summernote" class="form-control"
                              rows="5">{{ old('answer', $lesson->answer) }}</textarea>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>
    </div>

@endsection
