<script type="text/javascript">
    $(function() {
        $(".clickable-row").click(function() {
            console.log("ditekan")
            window.location = $(this).data("href");
        });
    });
</script>
