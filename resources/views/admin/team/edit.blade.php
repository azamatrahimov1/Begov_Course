@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tahrirlash/</span> Bizning jamoa a'zolari</h4>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('team.update', $team->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">To'liq ism</label>
                    <input type="text" class="form-control" name="name" value="{{ $team->name }}">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="job" class="form-label">Ishi</label>
                    <input type="text" class="form-control" name="job" value="{{ $team->job }}">
                    @error('job')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Fotosurat</label>
                    <input type="file" class="form-control" name="image" value="{{ $team->image }}" accept="image/*">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telegram" class="form-label">Telegram</label>
                    <input type="text" class="form-control" name="telegram" value="{{ $team->telegram }}">
                </div>
                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" class="form-control" name="instagram" value="{{ $team->instagram }}">
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="{{ $team->facebook }}">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Topshirish</button>
                </div>

            </form>
        </div>
    </div>

@endsection
