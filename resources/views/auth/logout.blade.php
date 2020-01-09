<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    id="logoutModal"
>
    <div
        class="modal-dialog modal-sm"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apakah Anda yakin?</h5>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >
                    Tutup
                </button>
                <a  href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();
                    logoutProcess();"
                    class="btn btn-danger"
                >
                    Biarkan saya keluar!
                </a>

                <form
                    id="logout-form"
                    action="{{ route('logout') }}"
                    method="POST"
                    style="display: none;"
                >
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
