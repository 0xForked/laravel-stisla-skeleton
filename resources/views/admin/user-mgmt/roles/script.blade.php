<script type="text/javascript">
    $('input[type=search]').on('search', function () {
        if($(this).val().length < 1) {
            window.location='{{ route('admin.roles.index') }}'
        }
    });
    $('#detailRole').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var role = button.data('role')
        var modal = $(this)
        modal.find('.modal-title').text(role.name+ ' detail!')
        modal.find('.modal-body #name').val(role.name)
        modal.find('.modal-body #alias').val(role.guard_name)
        getPermission(role.id)
    })
    async function getPermission(id) {
        try {
            var apiUri = '/api/v1/role/'+id+'/permissions'
            const apiUrl = await(fetch(apiUri))
            const permissions = await apiUrl.json()
            showPermissions(permissions)
        }
        catch(err) { console.log(err); }
    }
    function showPermissions(permissions) {
        let container = document.querySelector('#roleDetailContainer')
        let strAvailableData = "";
        permissions.forEach(permission => {
            strAvailableData += '<span class="badge badge-primary" style="margin-right:3px;margin-top:5px">'+ permission.name +'</span>'
        });
        return container.innerHTML = strAvailableData
    }
</script>