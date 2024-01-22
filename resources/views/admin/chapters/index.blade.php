@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Chapters</h4>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Basic Bootstrap Table -->
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
        <li class="nav-item">
            @if(auth()->user()->can('create'))
                <a class="nav-link active" href="{{route('chapters.create')}}"
                ><i class="bx bx-plus me-1"></i> Create</a>
            @endif
        </li>
    </ul>
    <div class="card">

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                </thead>
                @foreach($chapters as $chapter)
                    <tbody class="table-border-bottom-0">
                    <tr>
                        <td>{{$chapter->id}}</td>
                        <td>{{$chapter->name}}</td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('create'))
                                    <a class="btn btn-warning me-2"
                                       href="{{ route('chapters.edit', ['chapter' => $chapter->id]) }}"
                                    > Edit</a>
                                @endif
                                @if(auth()->user()->can('create'))
                                        <form action="{{ route('chapters.destroy', ['chapter' => $chapter->id]) }}" method="POST"  id="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-danger"
                                                    onclick="delete_button({{$chapter->id}})">
                                                <i class="bx bx-trash me-2"></i>
                                            </button>
                                        </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
        {!! $chapters->links() !!}
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
                    form.action = '/chapters/' + id;
                    form.submit()
                }
            })
        }

    </script>

@endsection
