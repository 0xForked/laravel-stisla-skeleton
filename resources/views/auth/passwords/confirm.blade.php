@extends('layouts._body.auth')

@section('title', 'Konfirmasi sandi')

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img
                        src="{{ asset('assets/img/sites/' . app_settings()['site_logo']->value) }}"
                        alt="logo" width="80"
                        class="shadow-light mt-2"
                    >
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>{{ __('Konfirmasi sandi') }}</h4>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="text-muted">
                            {{ __('Please confirm your password before continuing.') }}
                        </p>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    {{ __('Konfirmasi sandi') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
