@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit</span> Role</h4>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="{{route('role.update', $role->id)}}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            type="text"
                            value="{{$role->name}}"
                            class="form-control"
                            id="defaultFormControlInput"
                            name="name"
                            aria-describedby="defaultFormControlHelp"/>
                    </div>

                    <div class="mb-3">
                        @foreach($permissions as $permission)
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input"
                                       @if($role->hasPermissionTo($permission->name)) checked
                                       @endif name="permissions[]"
                                       id="{{$permission->id}}" value="{{$permission->id}}">
                                <label class="form-check-label"
                                       for="{{$permission->id}}">{{$permission->name}}</label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit"
                            class="btn btn-primary">
                        Save
                    </button>
            </form>
        </div>
    </div>

@endsection

