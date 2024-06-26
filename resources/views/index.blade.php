@extends('layout.app')
@section('content')

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            @foreach($mainScreens as $mainScreen)
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('storage/'. $mainScreen->image) }}" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                         style="background: rgba(24, 29, 56, .7);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-sm-10 col-lg-8">
                                    <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online
                                        Courses</h5>
                                    <h1 class="display-3 text-white animated slideInDown">{{ $mainScreen->title }}</h1>
                                    <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                        More</a>
                                    <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Type of Lessons Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp p-2" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Kurslar</h6>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($onlines as $online)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src="{{ asset('storage/'. $online->image) }}" alt="">
                                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                    <form action="{{ route('register', $online->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="amount" value="{{ $online->price }}">
                                        <button type="submit" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 30px;">Bosh</button>
                                    </form>
                                </div>

                            </div>
                            <div class="text-center p-4 pb-0">
                                <h3 class="mb-0">{{ $online->price }}</h3>
                                <div class="mb-3">
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small>(123)</small>
                                </div>
                                <h5 class="mb-4">{{ $online->title }}</h5>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-user-tie text-primary me-2"></i>{{ $online->teacher }}</small>
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-clock text-primary me-2"></i>{{ $online->hour }}</small>
                                <small class="flex-fill text-center py-2"><i
                                        class="fa fa-user text-primary me-2"></i>{{ $online->student }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($oflines as $offline)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src="{{ asset('storage/'. $offline->image) }}" alt="">
                                <div
                                    class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end"
                                       style="border-radius: 30px 0 0 30px;">Read More</a>
                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3"
                                       style="border-radius: 0 30px 30px 0;">Join Now</a>
                                </div>
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h3 class="mb-0">{{ $offline->price }}</h3>
                                <div class="mb-3">
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small>(123)</small>
                                </div>
                                <h5 class="mb-4">{{ $offline->title }}</h5>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-user-tie text-primary me-2"></i>{{ $offline->teacher }}</small>
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-clock text-primary me-2"></i>{{ $offline->hour }}</small>
                                <small class="flex-fill text-center py-2"><i
                                        class="fa fa-user text-primary me-2"></i>{{ $offline->student }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Type of Lessons End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="text-center wow fadeInUp p-2" data-wow-delay="0.1s">
                    <h6 class="section-title bg-white text-center text-primary px-3">Biz haqimizda</h6>
                </div>
                @foreach($abouts as $about)
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <video class="img-fluid position-absolute w-100 h-100" controls>
                                <source src="{{ asset('storage/' . $about->video) }}" type="video/mp4"
                                        style="object-fit: cover;">
                            </video>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <h1 class="mb-4">{{ $about->title }}</h1>
                        <p class="mb-4">{!! $about->desc !!}</p>
                        <div class="row gy-2 gx-4 mb-4">
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International
                                    Certificate</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International
                                    Certificate</p>
                            </div>
                        </div>
                        <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Gallery Start -->
    @if($galleries->isNotEmpty())
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="text-center p-2">
                    <h6 class="section-title bg-white text-center text-primary px-3">Galereya</h6>
                </div>
                <div class="owl-carousel testimonial-carousel position-relative">
                    @foreach($galleries as $gallery)
                        <div class="testimonial-item text-center">
                            <img class="p-2 mx-auto mb-3" src="{{ asset('storage/' . $gallery->image) }}" alt=""
                                 style="object-fit: cover; height: 400px">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3"
                                 style="margin:  1px;">
                                <h5 class="m-0">{{ $gallery->title }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Gallery End -->

    <!-- Team Start -->
    @if($teams->isNotEmpty())
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title bg-white text-center text-primary px-3">Bizning jamoa a'zolari</h6>
                </div>
                <div id="teamCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="row justify-content-center">
                            @foreach($teams as $team)
                                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.{{ $team->id }}s">
                                    <div class="team-item bg-light">
                                        <div class="overflow-hidden">
                                            <img class="img-fluid" src="{{ asset('storage/'. $team->image) }}" alt=""
                                                 style="height: 350px">
                                        </div>
                                        <div class="position-relative d-flex justify-content-center"
                                             style="margin-top: -23px;">
                                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                                <a class="btn btn-sm-square btn-primary mx-1"
                                                   href="{{ $team->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                                <a class="btn btn-sm-square btn-primary mx-1"
                                                   href="{{ $team->telegram }}"><i class="fab fa-telegram"></i></a>
                                                <a class="btn btn-sm-square btn-primary mx-1"
                                                   href="{{ $team->instagram }}"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center p-4">
                                            <h5 class="mb-0">{{ $team->name }}</h5>
                                            <small>{{ $team->job }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    <!-- Team End -->


    <!-- Testimonial Start -->
    @if($galleries->isNotEmpty())
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="text-center p-2">
                    <h6 class="section-title bg-white text-center text-primary px-3">Biznig o'quvchilarimiz</h6>
                </div>
                <div class="owl-carousel testimonial-carousel position-relative">
                    @foreach($students as $student)
                        <div class="testimonial-item text-center">
                            <img class="border rounded-circle p-2 mx-auto mb-3"
                                 src="{{ asset('storage/'. $student->image) }}"
                                 style="width: 80px; height: 80px;">
                            <h5 class="mb-0 p-1">{{ $student->name }}</h5>
                            <div class="testimonial-text bg-light text-center p-4">
                                <p class="mb-0">{{ $student->desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Testimonial End -->

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 5000,
                dots: true,
                nav: true,
            });
        });
    </script>
@endsection
