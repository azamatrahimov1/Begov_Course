<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Begov</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owlcarousel/layout/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
<!-- Spinner Start -->
<div id="spinner"
     class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->

<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            @foreach($abouts as $about)
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-white"></i><a href="#"
                                                                                                     class="text-white">{{ $about->address }}</a></small>
                    <small class="me-3"><i class="fas fa-phone me-2 text-white"></i><a href="#"
                                                                                              class="text-white">{{ $about->phone_number }}</a></small>
                </div>
            @endforeach
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Grammar</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Pre IELTS</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">with Begov</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="#" class="navbar-brand"><h1 class="text-primary display-6">Begov</h1></a>
            <div class="d-flex">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary text-primary navbar-toggler py-2 px-3 me-3">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary text-primary navbar-toggler py-2 px-3 me-4">Log In</a>
                @endauth
            @endif

            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            </div>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('index') }}"
                       class="nav-item nav-link @if(Route::Is('home')) active @endif">Home</a>
                    <a href="{{ route('contact') }}"
                       class="nav-item nav-link @if(Route::Is('contact.index')) active @endif">Contact</a>
                </div>
                <div class="d-flex m-3 me-0">
                    @if (Route::has('login'))
                        <div class="justify-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn bg-white text-primary my-auto">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn bg-white text-primary my-auto">Log In</a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->


@yield('content')

<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i></a>All right reserved.</span>
            </div>
            <div class="col-md-6 my-auto text-center text-md-end text-white">
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                Designed By <a class="border-bottom" href=""></a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Template Javascript -->
<script src="{{ asset('assets/js/main.js') }}"></script>
@yield('script')

</body>

</html>
