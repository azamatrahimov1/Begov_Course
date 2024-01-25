@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Darslar/</span> {{ $lesson->name }}</h4>

    <div class="row mb-5">
        <div class="col-md-6 col-lg-8 mb-2 mx-auto my-auto">
            <div class="card">
                <video class="card-img-top" controls>
                    <source src="{{ asset('storage/'.$lesson->video) }}" type="video/mp4">
                </video>
                <div class="card-body">
                    <h5 class="card-title">{{ $lesson->name_video }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 col-lg-8 mb-2 mx-auto my-auto">
            <div class="card">
                <img class="card-img-top" src="{{ asset('storage/'.$lesson->image) }}"
                     alt="Card image cap"/>
                <div class="card-body">
                    <p class="card-text">
                        {{ $lesson->name_image }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-6 col-lg-8 mx-auto my-auto">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">
                                {!! $lesson->homework !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-6 col-lg-8 mx-auto my-auto">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">
                                {!! $lesson->answer !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-6 col-lg-4 mx-auto my-auto">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Vocabulary</h5>
                    <audio class="card-text mt-2" controls>
                        <source src="{{ asset('storage/'. $lesson->voice) }}" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                    <a href="{{ asset('storage/'. $lesson->pdf) }}" class="btn btn-primary mt-2">Faylni Yuklab
                        Olish</a>
                </div>
            </div>
        </div>
    </div>

@endsection
