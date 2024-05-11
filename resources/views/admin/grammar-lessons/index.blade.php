@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light"></span> Darslar</h4>

    @include('admin.success-alert')

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
    @error('photos')
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

                    <form method="POST" action="{{ route('lessons.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">№ - Dars</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name_video" class="form-label">Video Nomi</label>
                                    <input type="text" id="emailExLarge" class="form-control" name="name_video"
                                           value="{{ old('name_video') }}" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="video" class="form-label">Video</label>
                                    <input type="file" id="dobExLarge" name="video" class="form-control"
                                           value="{{ old('video') }}" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name_image" class="form-label">Fotosurat Nomi</label>
                                    <input type="text" id="emailExLarge" name="name_image" class="form-control"
                                           value="{{ old('name_image') }}" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="photos" class="form-label">Fotosurat(lar)</label>
                                    <input type="file" id="dobExLarge" name="photos[]" class="form-control" multiple required value="{{ old('photos') }}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="pdf" class="form-label">Docx yoki PDF</label>
                                    <input type="file" id="emailExLarge" name="pdf" class="form-control"
                                           value="{{ old('pdf') }}" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
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
                                    <textarea name="answer" id="summernote" class="form-control"
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
            </button>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Darslar</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @php
                    $i = 1;
                @endphp
                @foreach($lessons as $lesson)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $lesson->name }}</td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('show-grammar-lessons'))
                                    <a href="{{ route('lessons.show', $lesson->id) }}"
                                       class="btn btn-info me-2"><i class="bx bx-show"></i></a>
                                @endif
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('lessons.edit', ['lesson' => $lesson->id]) }}"
                                       class="btn btn-warning me-2"><i class="bx bx-pencil"></i></a>
                                @endif
                                @if(auth()->user()->can('delete'))
                                    <form action="{{ route('lessons.destroy', ['lesson' => $lesson->id]) }}"
                                          method="POST"
                                          id="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="btn btn-danger me-2"
                                                onclick="delete_button({{$lesson->id}})">
                                            <i class="bx bx-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                                @if(Auth::user()->likesLesson($lesson))
                                    <form action="{{ route('lessons.unlike', $lesson->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i
                                                class="bx bx-like me-2"></i>{{ $lesson->likes()->count() }}
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('lessons.like', $lesson->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i
                                                class="bx bx-like me-2"></i>{{ $lesson->likes()->count() }}</button>
                                    </form>
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
                    form.action = '/lessons/' + id;
                    form.submit()
                }
            })
        }

    </script>

@endsection



