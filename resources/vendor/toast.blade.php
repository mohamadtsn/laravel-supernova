<script>
    RegistererOnLoadCallback.booted(function () {
        window.preloader.then(() => {
            {!! str_replace(['<script type="text/javascript">', '</script>'], '', app('toastr')->render()) !!}
        });
    });
</script>
