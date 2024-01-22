@extends('admin.layout.app')
@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Create</span> Role</h4>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <!-- Switches -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route('role.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="defaultFormControlInput"
                                       placeholder="Name"
                                       aria-describedby="defaultFormControlHelp"
                                />
                            </div>
                            @foreach($permissions as $permission)
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="{{$permission->id}}"
                                           name="permissions[]" value="{{$permission->id}}"/>
                                    <label class="form-check-label" for="{{$permission->id}}"
                                    >{{$permission->name}}</label
                                    >
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


