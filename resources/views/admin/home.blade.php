@extends('layouts._body.admin')

@section('title', 'Beranda')

@section('content')
<div class="section-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endsection
