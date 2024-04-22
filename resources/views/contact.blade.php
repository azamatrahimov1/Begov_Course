@extends('layout.app')
@section('content')

    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Bog'laning</h1>
                            @foreach($abouts as $about)
                                <p class="mb-4">{!! $about->desc !!}</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            <iframe class="rounded w-100"
                                    style="height: 400px;" src=""
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-7">
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <input type="text" name="full_name" class="w-100 form-control border-0 py-3 mb-4" placeholder="To'liq Ism" value="{{ isset($about->full_name) ? $about->full_name : old('full_name') }}">
                            @error('full_name')
                            <div class="alert alert-danger" role="alert">To'liq ism maydoni to'ldirilishi shart!</div>
                            @enderror

                            <input type="number" name="phone_number" class="w-100 form-control border-0 py-3 mb-4" placeholder="Telefon Raqami" value="{{ isset($about->phone_number) ? $about->phone_number : old('phone_number') }}">
                            @error('phone_number')
                            <div class="alert alert-danger" role="alert">Telefon raqam maydoni to'ldirilishi shart!</div>
                            @enderror

                            <textarea name="desc" class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Xabaringiz">{{ isset($about->desc) ? $about->desc : old('desc') }}</textarea>
                            @error('desc')
                            <div class="alert alert-danger" role="alert">Xabar maydoni to'ldirilishi shart!</div>
                            @enderror

                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary" type="submit">Yuborish</button>

                        </form>
                    </div>
                    <div class="col-lg-5">
                        @foreach($abouts as $about)
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Manzil</h4>
                                <p class="mb-2">{{ $about->address }}</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fab fa-telegram fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Telegram</h4>
                                <a class="mb-2" href="{{ $about->telegram_account }}">{{ $about->telegram_account }}</a>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Telefon Raqami</h4>
                                <p class="mb-2">{{ $about->phone_number }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Biz bilan bog'lanish</h6>
                <h1 class="mb-5">Har qanday so'rov uchun murojaat qiling</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5>Aloqa qiling</h5>
                    <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Office</h5>
                            <p class="mb-0">123 Street, New York, USA</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Mobile</h5>
                            <p class="mb-0">+012 345 67890</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Email</h5>
                            <p class="mb-0">info@example.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <iframe class="position-relative rounded w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                            frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                </div>
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
                                    <div class="alert alert-danger" role="alert">Telefon raqam maydoni to'ldirilishi shart!</div>
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
