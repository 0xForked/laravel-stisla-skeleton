@extends('layouts._body.account')

@section('title', 'My Profile')

@section('content')
<div class="section-body">
    <h2 class="section-title">Profile</h2>
    <p class="section-lead">This page is show user profile.</p>

    @include('layouts._part.flash')

    <div class="card">
        <div class="card-header">
            <h4>My Profile</h4>
        </div>

        <div class="card-footer bg-whitesmoke">
            <div class="row is-flex">
                @include('account.profile.partials.form-basic')
                @include('account.profile.partials.form-password')
            </div>
        </div>
    </div>
    <div class="row">
        @include('account.profile.partials.info-activity')
        @include('account.profile.partials.info-login')
    </div>
</div>
@endsection

@section('custom-script')
    @include('account.profile.scripts.button')
@endsection