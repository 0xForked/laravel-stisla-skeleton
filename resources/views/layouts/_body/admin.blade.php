@extends('layouts.main')

@section('body-class', 'none')

@section('body')
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>

            @include('layouts._part.toolbar')

            @include('layouts._part.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @include('layouts._part.breadcrumb')

                    @yield('content')

                </section>
            </div>

            @include('layouts._part.footer')
        </div>
    </div>
@endsection

@section('custom-script')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/js/modules/jquery-ui.min.js') }}"></script>
@endsection

