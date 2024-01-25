@extends('layout.app')
@section('content')

    <!-- Hero Start -->

        <div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    @foreach($mainScreens as $index => $mainScreen)
                    <div class="col-md-12 col-lg-7">
                        <h1 class="mb-5 display-3 text-primary">{{ $mainScreen->title }}</h1>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }} rounded">
                                    <img src="{{ asset('storage/'.$mainScreen->image) }}"
                                         class="img-fluid w-100 h-100 bg-secondary rounded" alt="Первый слайд">
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    <!-- Hero End -->

    <!-- Video Start-->
    {{--    <div class="container-fluid fruite py-5">--}}
    {{--        <div class="container py-5">--}}
    {{--            <div class="tab-class text-center">--}}
    {{--                <div class="row g-4">--}}
    {{--                    <div class="col-lg-4 text-start">--}}
    {{--                        <h1>Our Video Courses</h1>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-8 text-end">--}}
    {{--                        <ul class="nav nav-pills d-inline-flex text-center mb-5">--}}
    {{--                            @foreach($chapters as $chapter)--}}
    {{--                                <li class="nav-item">--}}
    {{--                                    <a class="d-flex py-2 m-2 bg-light rounded-pill @if(url()->current() == route('chapters', $chapter->id)) active @endif"--}}
    {{--                                       data-bs-toggle=""--}}
    {{--                                       href="{{ route('chapters', ['chapter' => $chapter->id]) }}">--}}
    {{--                                        <span class="text-dark" style="width: 130px;">{{ $chapter->name }}</span>--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                            @endforeach--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="tab-content">--}}
    {{--                    <div id="tab-1" class="tab-pane fade show p-0 active">--}}
    {{--                        <div class="row g-4">--}}
    {{--                            <div class="col-lg-12">--}}
    {{--                                <div class="row g-4">--}}
    {{--                                    @forelse($videos as $video)--}}
    {{--                                        <div class="col-md-6 col-lg-4 col-xl-3">--}}
    {{--                                            <div class="rounded position-relative fruite-item">--}}
    {{--                                                <div class="fruite-img">--}}
    {{--                                                    <video width="100%" height="100%" controls>--}}
    {{--                                                        <source src="{{ asset('storage/'.$video->video) }}"--}}
    {{--                                                                type="video/mp4">--}}
    {{--                                                    </video>--}}
    {{--                                                </div>--}}
    {{--                                                <div class="p-4  border-top-0 rounded-bottom">--}}
    {{--                                                    <h4>{{ $video->title }}</h4>--}}
    {{--                                                    <p>{{ $video->description }}</p>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    @empty--}}
    {{--                                        <p>No videos available.</p>--}}
    {{--                                    @endforelse--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="pagination-container d-flex justify-content-center">--}}
    {{--                {{ $videos->links() }}--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- Video End-->

    <!-- Featurs Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="#" class="text-white">
                        <div class="service-item bg-dark rounded border border-dark">
                            @foreach($offlines as $offline)
                                <img src="{{ asset('storage/'. $offline->image) }}"
                                     class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <h3 class="text-white text-center mt-1">{{ $offline->title }}</h3>
                                    <p class="text-white mt-3">{!! $offline->desc !!}</p>
                                    @if (Route::has('register'))
                                        <a href="#"
                                           class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4 text-white">Batafsil</a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#" class="text-white">
                        <div class="service-item bg-dark rounded border border-dark">
                            @foreach($onlines as $online)
                            <img src="{{ asset('storage/'. $online->image) }}"
                                 class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <h3 class="text-white text-center mt-1">{{ $online->title }}</h3>
                                <p class="text-white mt-3">{!! $online->desc !!}</p>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4 text-white">Batafsil</a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs End -->

@endsection
