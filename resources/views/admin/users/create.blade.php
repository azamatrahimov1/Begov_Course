@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Create</span> User</h4>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('phone_number')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="card mb-4">
        <div class="card-body">

            <form method="post" action="{{ route('user.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="defaultInput" class="form-control" type="text" name="name" value="{{ old('name') }}"/>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="defaultInput" class="form-control" type="email" name="email" value="{{ old('email') }}"/>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="defaultInput" class="form-control" type="password" name="password"
                           value="{{ old('password') }}"/>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input id="defaultInput" class="form-control" type="tel" name="phone_number"
                           value="{{ old('phone_number') }}"/>
                </div>
                <div class="mb-3">
                    <label for="end_date" class="col-md-2 col-form-label">End Date</label>
                    <input
                        class="form-control"
                        type="datetime-local"
                        value="{{ old('end_date') }}"
                        name="end_date"
                    />
                </div>

                <!-- You should use a button here, as the anchor is only used for the example  -->
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </form>
        </div>
    </div>

@endsection
