@extends('admin.layout.app')

@section('content')
    <div>
        <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Darslar/</span> {{ $lesson->name }}</h4>

        <div class="row mb-5">
            <div class="col-md-6 col-lg-8 mb-2 mx-auto my-auto">
                <div class="card">
                    <video class="card-img-top" controls>
                        <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                    </video>
                    <div class="card-body">
                        <h5 class="card-title">{{ $lesson->name_video }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-6 col-lg-8 mx-auto my-auto">
                <div class="card position-relative">

                    <button class="btn btn-navigation btn-prev" onclick="showPreviousImage()">&#8249;</button>
                    <button class="btn btn-navigation btn-next" onclick="showNextImage()">&#8250;</button>
                    @php
                        $firstPhoto = $lesson->photos->first();
                    @endphp

                    @if ($firstPhoto)
                        <img id="lesson-image" class="card-img-top" src="{{ asset('storage/' . $firstPhoto->path) }}" alt="Lesson Photo"/>
                    @else
                        <p>No images for this lesson</p>
                    @endif


                    <div class="card-body">
                        <p class="card-text">{{ $lesson->name_image ?? 'No Name' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-6 col-lg-8 mx-auto my-auto">
                <div class="card table-responsive">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Homework</h5>
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
                <div class="card table-responsive">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Answer</h5>
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
                        <div class="text-center">
                            <audio class="card-text mt-2" controls>
                                <source src="{{ asset('storage/'. $lesson->voice) }}" type="audio/mp3">
                                Your browser does not support the audio element.
                            </audio>
                            <a href="{{ asset('storage/'. $lesson->pdf) }}" class="btn btn-primary mt-2">
                                <i class="bx bx-download me-2"></i> Faylni Yuklab Olish</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
        <style>
            /* Стиль для кнопок навигации */
            .btn-navigation {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: #007bff; /* Основной цвет */
                color: white;
                border: none;
                border-radius: 50%; /* Закругленные углы */
                width: 40px;
                height: 40px;
                font-size: 20px; /* Размер символа */
                transition: background-color 0.3s, transform 0.3s; /* Анимация при наведении */
            }

            /* Кнопка "назад" слева */
            .btn-prev {
                left: 10px; /* Положение по горизонтали */
            }

            /* Кнопка "вперед" справа */
            .btn-next {
                right: 10px; /* Положение по горизонтали */
            }
            .btn-navigation:hover {
                background: white;
                transform: translateY(-50%) scale(1.1);
                transition: background-color 0.3s, transform 0.3s;
            }
        </style>

@section('script')
            <script>
                const images = {!! json_encode($lesson->photos->pluck('path')) !!};
                let currentImageIndex = 0;

                function showPreviousImage() {
                    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                    updateImage();
                }

                function showNextImage() {
                    currentImageIndex = (currentImageIndex + 1) % images.length;
                    updateImage();
                }

                function updateImage() {
                    const imageElement = document.getElementById('lesson-image');
                    imageElement.src = '{{ asset('storage/') }}' + '/' + images[currentImageIndex];
                }
            </script>
@endsection
