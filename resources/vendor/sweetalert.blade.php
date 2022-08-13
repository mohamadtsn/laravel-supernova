@if (Session::has('alert.config'))
    <script>
        window.RegistererOnLoadCallback.booted(function () {
            window.preloader.then(() => {
                window.Swal.fire({!! Session::pull('alert.config') !!});
            });
        });
    </script>
@endif
