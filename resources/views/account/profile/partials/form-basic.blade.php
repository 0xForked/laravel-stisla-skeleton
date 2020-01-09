    <div class="col-12 col-md-6 p-2">
        <div class="bg-white p-5 h-100">
            <h5>Basic</h5>
            <p>Change basic information</p>
            <form method="POST" action="{{ route('account.basic') }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="d-block">
                        <label for="email" class="control-label">{{ __('Name') }}</label>
                    </div>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $account->name }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>
                    </div>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $account->email }}" required autocomplete="email" tabindex="1" autofocus disabled>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="phone" class="control-label">{{ __('Phone Number') }}</label>
                    </div>

                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $account->phone }}" required autocomplete="phone" tabindex="1" autofocus>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group text-right">
                    <button type="submit" id="submit-basic" class="btn btn-primary btn-lg btn-icon icon-right" disabled>
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>