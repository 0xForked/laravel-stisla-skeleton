@extends('layouts.main')

@section('title', 'My Activity')

@section('body-class', 'layout-3')

@section('body')
    <div id="app">
        <div class="main-wrapper p-5">
            <!-- Main Content -->
            <div id="back">
                <a href="#">

                </a>
            </div>

            <a href="{{ route('route-verify') }}" class="btn btn-primary mb-5 ml-3">
                <i class="fas fa-chevron-circle-left"></i>
                Back to Home
            </a>

            @yield('content')


            @include('layouts._part.footer')
        </div>
    </div>
@endsection
