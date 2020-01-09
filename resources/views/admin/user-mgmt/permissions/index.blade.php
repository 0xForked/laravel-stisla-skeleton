@extends('layouts._body.admin')

@section('title', 'Izin Pengguna')

@section('content')
<div class="section-body">
    <h2 class="section-title">Izin pengguna</h2>
    <p class="section-lead">Daftar izin pengguna yang di terapkan pada fungsi atau modul atau fitur.</p>
    @include('layouts._part.flash')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar izin pengguna </h4>
                    <div class="card-header-form">
                        <form
                            method="GET"
                            action="{{ route('admin.permissions.index') }}"
                        >
                            <div class="input-group">
                                <input
                                    type="search"
                                    class="form-control"
                                    placeholder="Cari"
                                    name="search"
                                    value="{{ (app('request')->input('search')) ? app('request')->input('search') : ''}}"
                                >
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" value="search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button
                        data-toggle="modal"
                        data-target="#addPermission"
                        class="btn btn-primary ml-2"
                    ><i class="fas fa-plus"></i> Tambah baru</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Guard</th>
                                <th width="200">Aksi</th>
                            </tr>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="text-center">
                                        {{ ($permissions->currentpage()-1) * $permissions->perpage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->guard_name }}</td>
                                    <td>
                                        <a
                                            href="#"
                                            class="btn btn-danger"
                                            onclick="deleteData({{ $permission->id }}, 'permissions')"
                                            data-toggle="modal"
                                            data-target="#deleteModal"
                                        >
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke text-center">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            {{ $permissions->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-include')
@include('admin.user-mgmt.permissions.add')
@endsection

@section('custom-script')
@include('admin.user-mgmt.permissions.script')
@endsection