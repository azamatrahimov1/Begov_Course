@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit</span> User</h4>

    <!-- Form controls -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Toliq Ismi</label>
                    <input type="text" class="p-2 mb-2 bg-light text-dark form-control" name="name"
                           value="{{ $user->name }}">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">Tugash Sanasi</label>
                    <input type="datetime-local" id="end_date" class="p-2 mb-2 bg-light text-dark form-control"
                           name="end_date"
                           value="{{ $user->end_date }}">
                    @error('end_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Rollar</label>
                    <select class="form-select" name="role_id" aria-label="Default select example">
                        @foreach($roles as $role)
                            <option value="{{ $role['id'] }}"
                                    @if($user->hasRole($role['name'])) selected @endif>{{ $role['name'] }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    Topshirish
                </button>
            </form>
        </div>
    </div>

@endsection
