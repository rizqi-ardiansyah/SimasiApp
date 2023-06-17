<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item">
                <a href="javascript:;"   onclick="logoutConfirmation()" class="nav-link">
                    <i class="nav-icon fas fa-power-off"></i>
                </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<script type="text/javascript">
        function logoutConfirmation() {
            swal.fire({
                title: "Keluar?",
                icon: 'question',
                text: "Apakah Anda yakin?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Iya, keluar!",
                cancelButtonText: "Batal!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "{{url('/logout')}}",
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        // success: function(results) {
                        //     if (results.success === true) {
                        //         swal.fire("Berhasil!", results.message, "success");
                        //         // refresh page after 2 seconds
                        //         setTimeout(function() {
                        //             location.reload();
                        //         }, 1000);
                        //     } else {
                        //         // swal.fire("Gagal!", results.message, "error");
                        //     }
                        // }
                    });

                    // location.reload();
                    location.href = "{{'/login'}}";

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
    </script>