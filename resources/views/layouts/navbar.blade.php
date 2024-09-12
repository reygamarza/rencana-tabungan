<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TabunganKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/tesicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.3/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TabunganKu</a>
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}
            <div>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> {{ Auth::user()->nama }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>

    <!-- Content -->
    @yield('content')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (Session::has('berhasil'))
                Swal.fire({
                    icon: "success",
                    title: "Berhasil! 😁👍",
                    text: "{{ Session::get('berhasil') }}",
                });
            @endif

            @if (Session::has('gagal'))
                Swal.fire({
                    icon: "error",
                    title: "Gagal! 😥🙏",
                    text: "{{ Session::get('gagal') }}",
                });
            @endif
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Kamu yakin? 🤔',
                text: "Kamu tidak dapat mengembalikan data yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form jika konfirmasi diterima
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        document.getElementById('nominal_terkumpul').addEventListener('input', function() {
            var nominalTerkumpul = parseFloat(document.getElementById('nominal_terkumpul').value) || 0;
            var targetNominal = parseFloat(document.getElementById('target_nominal').value) || 0;

            var alertElement = document.getElementById('alert-nominal');

            if (nominalTerkumpul > targetNominal && targetNominal > 0) {
                alertElement.style.display = 'block'; // Menampilkan alert
            } else {
                alertElement.style.display = 'none'; // Menyembunyikan alert jika tidak melebihi
            }
        });

        document.getElementById('target_nominal').addEventListener('input', function() {
            var nominalTerkumpul = parseFloat(document.getElementById('nominal_terkumpul').value) || 0;
            var targetNominal = parseFloat(document.getElementById('target_nominal').value) || 0;

            var alertElement = document.getElementById('alert-nominal');

            if (nominalTerkumpul > targetNominal) {
                alertElement.style.display = 'block'; // Menampilkan alert
            } else {
                alertElement.style.display = 'none'; // Menyembunyikan alert jika tidak melebihi
            }
        });
    </script>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
