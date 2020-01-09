<script type="text/javascript">
    $('input[type=search]').on('search', function () {
        if($(this).val().length < 1) {
            window.location='{{ route('admin.permissions.index') }}'
        }
    });
</script>