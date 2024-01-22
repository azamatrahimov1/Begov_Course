@extends('admin.layout.app')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Show /</span> Pre IELTS</h4>

    <div class="row">
        <!-- File input -->
        <div class="card">
            <div class="card-body">
                <div class="mb-3">

                    <div class="mb-3">
                        <h3 class="text-center">{{ $preIELTS->name }}</h3>
                    </div>

                    <div class="mb-3">
                        {!! $preIELTS->desc !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
