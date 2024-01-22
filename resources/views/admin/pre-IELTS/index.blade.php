@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Pre IELTS</h4>
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
                <a class="nav-link active" href="{{route('pre-IELTS.create')}}"><i class="bx bx-plus me-1"></i>
                    Create</a>
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
                    <th>Action</th>
                </tr>
                </thead>
                @foreach($preIELTSs as $PreIELTS)
                    <tbody class="table-border-bottom-0">
                    <tr>
                        <td>{{$PreIELTS->id}}</td>
                        <td>{{$PreIELTS->name}}</td>
                        <td>
                            <div class="d-flex">
                                @if(auth()->user()->can('show'))
                                    <a href="{{ route('pre-IELTS.show', ['pre_IELT' => $PreIELTS->id]) }}"
                                       class="btn btn-primary me-2">Show</a>
                                @endif
                                @if(auth()->user()->can('edit'))
                                    <a href="{{ route('pre-IELTS.edit', ['pre_IELT' => $PreIELTS->id]) }}"
                                       class="btn btn-warning me-2">Edit</a>
                                @endif
                                @if(auth()->user()->can('delete'))
                                    <form
                                        action="{{ route('pre-IELTS.delete', ['pre_IELT' => $PreIELTS->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this chapter?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                            </svg>
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
        {!! $preIELTSs->links() !!}
    </div>

@endsection
