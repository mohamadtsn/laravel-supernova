@if (Session::has('alert.config'))
    <script>
        RegistererOnLoadCallback.booted(function () {
            window.preloader.then(() => {
                Swal.fire({!! Session::pull('alert.config') !!});
            });
        });
    </script>
@endif
