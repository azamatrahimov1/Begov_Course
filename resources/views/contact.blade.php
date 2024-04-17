@extends('layout.app')
@section('content')

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Aloqa</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"></li>
            <li class="breadcrumb-item active text-white">Aloqa</li>
            <li class="breadcrumb-item"></li>
        </ol>
    </div>
    <!-- Single Page Header End -->

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
                                    style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d516.9806147765208!2d60.61385553732713!3d41.566335945101265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x41dfc91a18538bad%3A0xd12e674ac5fba536!2sTOP%20LC!5e0!3m2!1sru!2s!4v1704638357871!5m2!1sru!2s"
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-7">
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <input type="text" name="full_name" class="w-100 form-control border-0 py-3 mb-4" placeholder="To'liq Ism">
                            @error('full_name')
                            <div class="alert alert-danger" role="alert">Ushbu maydon bo'sh bo'lishi mumkin emas!</div>
                            @enderror
                            <input type="number" name="phone_number" class="w-100 form-control border-0 py-3 mb-4" placeholder="Telefon Raqami">
                            @error('phone_number')
                            <div class="alert alert-danger" role="alert">Ushbu maydon bo'sh bo'lishi mumkin emas!</div>
                            @enderror
                            <textarea name="desc" class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Xabaringiz"></textarea>
                            @error('desc')
                            <div class="alert alert-danger" role="alert">Ushbu maydon bo'sh bo'lishi mumkin emas!</div>
                            @enderror
                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary "
                                    type="submit">Yuborish
                            </button>
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
