@extends('admin.layout.app')
@section('content')

    @include('admin.success-alert')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        @foreach($charts as $chart)
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $chart->title }} {{ $user->name }}</h5>
                                    <p class="mb-4">{{ $chart->desc }}</p>
                                    @if(auth()->user()->can('edit'))
                                        <a href="{{ route('dashboard.edit', ['chart' => $chart]) }}"
                                           class="btn btn-sm btn-warning"><i class="bx bx-pencil"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img
                                        src="{{ asset('admin_assets/img/illustrations/man-with-laptop-light.png') }}"
                                        height="140"
                                        alt="View Badge User"
                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png"
                                    />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
{{--            <div class="col-lg-4 col-md-4 order-1">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6 col-md-12 col-6 mb-4">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="card-title d-flex align-items-start justify-content-between">--}}
{{--                                    <div class="avatar flex-shrink-0">--}}
{{--                                        <img--}}
{{--                                            src="{{ asset('admin_assets/img/icons/unicons/chart-success.png') }}"--}}
{{--                                            alt="chart success"--}}
{{--                                            class="rounded"--}}
{{--                                        />--}}
{{--                                    </div>--}}
{{--                                    <div class="dropdown">--}}
{{--                                        <button--}}
{{--                                            class="btn p-0"--}}
{{--                                            type="button"--}}
{{--                                            id="cardOpt3"--}}
{{--                                            data-bs-toggle="dropdown"--}}
{{--                                            aria-haspopup="true"--}}
{{--                                            aria-expanded="false"--}}
{{--                                        >--}}
{{--                                            <i class="bx bx-dots-vertical-rounded"></i>--}}
{{--                                        </button>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">--}}
{{--                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>--}}
{{--                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <span class="fw-semibold d-block mb-1">Profit</span>--}}
{{--                                <h3 class="card-title mb-2">$12,628</h3>--}}
{{--                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>--}}
{{--                                    +72.80%</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>

@endsection
