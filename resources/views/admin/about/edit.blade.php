@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tahrirlash/</span> Biz Haqimizda</h4>




    <!-- Form controls -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="post" action="{{ route('abouts.update', $about->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="desc" class="form-label"></label>
                    <textarea name="desc" id="tinymce" class="form-control"
                              rows="5">{{ old('desc', $about->desc) }}</textarea>
                    @error('desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address', $about->address) }}"
                           required>
                    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telegram_account" class="form-label">Telegram Account</label>
                    <input type="text" class="form-control" name="telegram_account"
                           value="{{ old('telegram_account', $about->telegram_account) }}" required>
                    @error('telegram_account')
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

