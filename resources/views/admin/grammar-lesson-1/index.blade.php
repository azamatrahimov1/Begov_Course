@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Darslar /</span>  1-Dars</h4>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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

    @if(auth()->user()->can('create'))
        <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>

                    <form method="POST" action="{{ route('lesson-1.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">

                            <div class="row g-2 mb-3">
                                <div class="col mb-0">
                                    <label for="name_video" class="form-label">Video Nomi</label>
                                    <input type="text" id="emailExLarge" class="form-control" name="name_video"
                                           value="{{ old('name_video') }}" required/>
                                </div>
                                <div class="col mb-0">
                                    <label for="video" class="form-label">Video</label>
                                    <input type="file" id="dobExLarge" name="video" class="form-control"
                                           value="{{ old('video') }}" required/>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col mb-0">
                                    <label for="name_image" class="form-label">Fotosurat Nomi</label>
                                    <input type="text" id="emailExLarge" name="name_image" class="form-control"
                                           value="{{ old('name_image') }}" required/>
                                </div>
                                <div class="col mb-0">
                                    <label for="image" class="form-label">Fotosurat</label>
                                    <input type="file" id="dobExLarge" name="image" class="form-control"
                                           value="{{ old('image') }}" required/>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col mb-0">
                                    <label for="pdf" class="form-label">Docx yoki PDF</label>
                                    <input type="file" id="emailExLarge" name="pdf" class="form-control"
                                           value="{{ old('pdf') }}" required/>
                                </div>
                                <div class="col mb-0">
                                    <label for="voice" class="form-label">Ovoz</label>
                                    <input type="file" id="dobExLarge" name="voice" class="form-control"
                                           value="{{ old('voice') }}" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="homework" class="form-label">Yu Vazifasi</label>
                                    <textarea name="homework" id="tinymce" class="form-control"
                                              rows="5">{{ old('homework') }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="answer" class="form-label">Javob</label>
                                    <textarea name="answer" id="tinymce" class="form-control"
                                              rows="5">{{ old('answer') }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Yopmoq
                            </button>
                            <button type="submit" class="btn btn-primary">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="demo-inline-spacing mb-3">
            <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#exLargeModal"
            ><i class="bx bx-plus me-1"></i>
                Yaratmoq
            </button>
        </div>
    @endif

    @foreach($lessons as $lesson)
        <div class="row mb-5">
            <div class="col-md-6 col-lg-8 mb-2 mx-auto my-auto">
                <div class="card">
                    <video class="card-img-top" controls>
                        <source src="{{ asset('storage/'.$lesson->video) }}" type="video/mp4">
                    </video>
                    <div class="card-body">
                        <h5 class="card-title">{{ $lesson->name_video }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-6 col-lg-8 mb-2 mx-auto my-auto">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/'.$lesson->image) }}"
                         alt="Card image cap"/>
                    <div class="card-body">
                        <p class="card-text">
                            {{ $lesson->name_image }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6 col-lg-8 mx-auto my-auto">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <p class="card-text">
                                    {!! $lesson->homework !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6 col-lg-8 mx-auto my-auto">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <p class="card-text">
                                    {!! $lesson->answer !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6 col-lg-4 mx-auto my-auto">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Vocabulary</h5>
                        <audio class="card-text mt-2" controls>
                            <source src="{{ asset('storage/'. $lesson->voice) }}" type="audio/mp3">
                            Your browser does not support the audio element.
                        </audio>
                        <a href="{{ asset('storage/'. $lesson->pdf) }}" class="btn btn-primary mt-2">Faylni Yuklab Olish</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <section id="component-footer">

            <footer class="footer bg-light mb-3">
                <div
                    class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
                    <div>
                        <a href="#" target="_blank" class="footer-text fw-bolder">
                            1-Dars
                        </a>
                    </div>
                    <div>
                        <div class="footer-link me-3">
                            @if(auth()->user()->can('edit'))
                                <a href="{{ route('lesson-1.edit', ['lesson_1' => $lesson->id]) }}"
                                   class="btn btn-warning"
                                ><i class="bx bx-pen me-2"></i>Tahrirlash
                                </a>
                            @endif
                        </div>
                        <div class="footer-link me-3">
                            @if(auth()->user()->can('delete'))
                                <form action="{{ route('lesson-1.delete', $lesson->id) }}" method="POST"
                                      id="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="btn btn-danger"
                                            onclick="delete_button({{$lesson->id}})">
                                        <i class="bx bx-trash me-2"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </footer>
        </section>
    @endforeach

@endsection

@section('script')
    <script>
        form = document.getElementById('form-delete');

        function delete_button(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.action = '/lesson-1/' + id;
                    form.submit()
                }
            })
        }

    </script>

@endsection
