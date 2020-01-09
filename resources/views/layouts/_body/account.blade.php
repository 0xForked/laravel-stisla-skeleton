@extends('layouts.main')

@section('body-class', 'layout-3')

@section('body')
    <div id="app">
        <div class="main-wrapper container">
            <!-- Main Content -->
            <div class="main-content" style="padding-top:80px !important">
                <section class="section">
                    <div id="back">
                        <a href="{{ route('route-verify') }}" class="btn btn-primary mb-5 ml-3">
                            <i class="fas fa-chevron-circle-left"></i>
                            Back to Home
                        </a>
                    </div>

                    <div class="mt-3">
                        @include('layouts._part.breadcrumb')
                    </div>

                    @yield('content')
                </section>
            </div>

            @include('layouts._part.footer')
        </div>
    </div>
@endsection
