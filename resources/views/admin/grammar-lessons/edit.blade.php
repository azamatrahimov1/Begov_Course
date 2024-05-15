@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tahrirlash/</span> {{ $lesson->name }}</h4>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('lessons.update', $lesson->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label">№ - Dars</label>
                        <input type="text" class="form-control" name="name"
                               value="{{ old('name', $lesson->name) }}" required/>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name_video" class="form-label">Video Nomi</label>
                    <input type="text" class="form-control" name="name_video"
                           value="{{ old('name_video', $lesson->name_video) }}">
                    @error('name_video')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="video" class="form-label">Video</label>
                    <input type="file" class="form-control mb-1" name="video" accept="video/*"
                           value="{{ old('video', $lesson->video) }}">
                    @error('video')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <p>Current Video: {{ $lesson->video }}</p>
                </div>

                <div class="mb-3">
                    <label for="name_image" class="form-label">Fotosurat(lar) Nomi</label>
                    <input type="text" class="form-control" name="name_image"
                           value="{{ old('name_image', $lesson->name_image) }}">
                    @error('name_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="photos" class="form-label">Fotosurat(lar)</label>
                    <input type="file" class="form-control mb-1" name="photos[]" multiple accept="image/*"
                           value="{{ old('photos', $lesson->photos) }}">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @php
                        $firstPhoto = $lesson->photos->first();
                    @endphp
                    @if($lesson->photos)
                        <img src="{{ asset('storage/'. $firstPhoto->path) }}" width="95">
                    @endif
                </div>

                <div class="mb-3">
                    <label for="pdf" class="form-label">Docx yoki PDF</label>
                    <input type="file" name="pdf" class="form-control mb-1" value="{{ old('pdf', $lesson->pdf) }}" accept=".docx,.pdf">
                    @error('pdf')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @if($lesson->pdf)
                        <p>Current PDF: <a href="{{ asset('storage/'.$lesson->pdf) }}"
                                           target="_blank">{{ $lesson->pdf }}</a></p>
                    @endif

                </div>

                <div class="mb-3">
                    <label for="voice" class="form-label">Ovoz</label>
                    <input type="file" class="form-control mb-1" name="voice" accept="audio/*"
                           value="{{ old('voice', $lesson->voice) }}">
                    @error('voice')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @if($lesson->voice)
                        <audio controls>
                            <source src="{{ asset('storage/'.$lesson->voice) }}" type="audio/mp3">
                            Your browser does not support the audio element.
                        </audio>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="homework" class="form-label">Yu Vazifasi</label>
                    <textarea name="homework" id="tinymce" class="form-control"
                              rows="5">{{ old('answer', $lesson->homework) }}</textarea>
                    @error('homework')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="answer" class="form-label">Javob</label>
                    <textarea name="answer" id="summernote" class="form-control"
                              rows="5">{{ old('answer', $lesson->answer) }}</textarea>
                    @error('answer')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Topshshirish</button>
                </div>

            </form>

        </div>
    </div>

@endsection
