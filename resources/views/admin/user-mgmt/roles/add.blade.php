<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    id="addRole"
>
    <div
        class="modal-dialog"
        role="document"
    >
        <form
            method="post"
            action="{{ route('admin.roles.store') }}"
        >
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Buat Peran Baru!
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Izin</label>
                        <select class="custom-select select2" name="permissions[]" multiple style="width:100%">
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <label class="text-info">*tambahkan izin jika peran memiliki izin khusus</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mr-auto">
                        <a href="#">Butuh bantuan?</a>
                    </div>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Tutup
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>