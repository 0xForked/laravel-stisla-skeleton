@extends('layouts._body.admin')

@section('title', 'Pengguna')

@section('content')
<div class="section-body">
    <h2 class="section-title">Pengguna</h2>
    <p class="section-lead">Tambah data pengguna untuk mengakses sistem.</p>
    @include('layouts._part.flash')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('admin.users.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="username"
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Ponsel</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="phone"
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                >
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Peran</label>
                            <div class="col-sm-12 col-md-7">
                                <select
                                    class="custom-select select2"
                                    name="role"
                                    style="width:100%"
                                >
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection