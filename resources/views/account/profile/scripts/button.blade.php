<script type="text/javascript">
    $(document).ready(function () {
        $('#name').on('change paste keyup', function() {
            var old_value = '{{$account->name}}';
            var new_value = $(this).val();
            if (old_value !== new_value && new_value !== old_value + ' ') {
                $('#submit-basic').prop('disabled', false);
            } else {
                $('#submit-basic').prop('disabled', true);
            }
        });

        $('#phone').on('change paste keyup', function() {
            var old_value = '{{$account->phone}}';
            var new_value = $(this).val();
            if (old_value !== new_value && new_value !== old_value + ' ') {
                $('#submit-basic').prop('disabled', false);
            } else {
                $('#submit-basic').prop('disabled', true);
            }
        });
    });
</script>
