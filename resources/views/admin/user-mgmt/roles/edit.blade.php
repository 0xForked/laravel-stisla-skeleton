@extends('layouts._body.admin')

@section('title', 'Ubah Peran Pengguna')

@section('content')
<div class="section-body">
    <h2 class="section-title">
        Ubah Peran -(<code>{{$role->name}}</code>)-
    </h2>
    <p class="section-lead">Halaman ini untuk merubah data peran.</p>
    @include('layouts._part.flash')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('admin.roles.update', $role->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="name" value="{{ $role->name}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Daftar Izin</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="row">
                                    @foreach($permissions as $permission)
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                             <div class="custom-control custom-checkbox" style="margin-bottom:15px">
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    id="permissions{{$permission->id}}"
                                                    value="{{$permission->id}}"
                                                    name="permissions[]"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : ''}}
                                                >
                                                <label
                                                    class="custom-control-label"
                                                    for="permissions{{$permission->id}}"
                                                >
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary" type="submit">Perbaharui</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection