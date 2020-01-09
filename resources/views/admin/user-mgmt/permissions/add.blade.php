
<div
class="modal fade"
tabindex="-1"
role="dialog"
id="addPermission"
>
<div
    class="modal-dialog"
    role="document"
>
    <form
        method="post"
        action="{{ route('admin.permissions.store') }}"
    >
        @csrf

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Tambah Izin Baru!
                </h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tetapkan Nama</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Pilih Peran</label>
                    <select class="custom-select select2" name="roles[]" multiple style="width:100%">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <label class="text-info">*biarkan kosong jika izin tidak terikat dengan peran</label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="mr-auto">
                    <a href="#">Butuh bantuan?</a>
                    {{-- helps?category=permission&subcategory=new --}}
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