@extends('layouts._body.auth')

@section('title', 'Setel Ulang Kata Sandi')

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
                    <div class="card-header"><h4>{{ __('Setel Ulang Kata Sandi') }}</h4></div>

                    <div class="card-body">
                    <p class="text-muted">Silahkan masukkan kata sandi baru.</p>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email">{{ __('Alamat E-Mail') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Kata Sandi') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror pwstrength" data-indicator="pwindicator" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Konfirmasi Kata Sandi') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                {{ __('Setel Ulang') }}
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
