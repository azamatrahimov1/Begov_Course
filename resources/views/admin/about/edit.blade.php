@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tahrirlash/</span> Biz Haqimizda</h4>

    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="{{ route('abouts.update', $about->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Sarlavha</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $about->title) }}">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="map" class="form-label">Xarita manzili</label>
                    <input type="text" class="form-control" name="map" value="{{ old('map', $about->map) }}">
                    @error('map')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="desc" class="form-label">Tavsif</label>
                    <textarea name="desc" id="tinymce" class="form-control"
                              rows="5">{{ old('desc', $about->desc) }}</textarea>
                    @error('desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Manzil</label>
                    <input type="text" class="form-control" name="address"
                           value="{{ old('address', $about->address) }}">
                    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="video" class="form-label">Video</label>
                    <input type="file" class="form-control mb-1" name="video" accept="video/*"
                           value="{{ old('video', $about->video) }}">
                    @error('video')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <p>Current Video: {{ $about->video }}</p>
                </div>

                <div class="mb-3">
                    <label for="telegram_account" class="form-label">Telegram</label>
                    <input type="text" class="form-control" name="telegram_account"
                           value="{{ old('telegram_account', $about->telegram_account) }}">
                    @error('telegram_account')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" class="form-control" name="instagram"
                           value="{{ old('instagram', $about->instagram) }}">
                    @error('instagram')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="text" class="form-control" name="facebook"
                           value="{{ old('instagram', $about->facebook) }}">
                    @error('facebook')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" name="phone_number"
                           value="{{ old('phone_number', $about->phone_number) }}">
                    @error('phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        Topshirish
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

