@extends('layout.app')
@section('content')

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Biz bilan bog'lanish</h6>
                <h1 class="mb-5">Har qanday so'rov uchun murojaat qiling</h1>
            </div>
            <div class="row g-4">
                @foreach($abouts as $about)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5>Aloqa qiling</h5>
                    <p class="mb-4">{{ $about->desc }}</p>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Manzil</h5>
                            <p class="mb-0">{{ $about->address }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Telefon Raqam</h5>
                            <p class="mb-0">{{ $about->phone_number }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fab fa-telegram text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Telegram</h5>
                            <p class="mb-0">{{ $about->telegram }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <iframe class="position-relative rounded w-100 h-100"
                            src="{{ $about->map }}"
                            frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                </div>
                @endforeach
                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="full_name" class="form-control" id="name" placeholder="To'liq Ism" value="{{ old('full_name') }}">
                                    <label for="name">To'liq Ism</label>
                                    @error('full_name')
                                    <div class="alert alert-danger" role="alert">To'liq ism maydoni to'ldirilishi shart!</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" name="phone_number" class="form-control" id="subject" placeholder="Telefon Raqam" value="{{ old('phone_number') }}">
                                    <label for="subject">Telefon Raqam</label>
                                    @error('phone_number')
                                    <div class="alert alert-danger" role="alert">Telefon raqam maydoni muammo bor!</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="desc" class="form-control" placeholder="Xabar" id="message" style="height: 150px">{{ old('desc') }}</textarea>
                                    <label for="message">Xabar</label>
                                    @error('desc')
                                    <div class="alert alert-danger" role="alert">Xabar maydoni to'ldirilishi shart!</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Yuborish</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection

@section('script')
    <script>

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '{{session('success')}}',
            showConfirmButton: false,
            timer: 2000
        })
        @endif

    </script>

@endsection
