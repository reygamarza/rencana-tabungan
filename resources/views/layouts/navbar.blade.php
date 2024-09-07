<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureFunds - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .navbar-custom {
            background-color:#40A2E3;
            padding: 20px;
            border-radius: 0px 0px 50px 50px
        }

        .navbar-brand {
            font-size: 24px;
            color: #FFF6E9;
            font-weight: 700;
            letter-spacing: 2px;
            margin-left: 15px;
        }

        .navbar-brand img {
            width: 40px;
            height: auto;
        }

        .navbar-nav {
            margin-right: 15px;
        }

        .navbar-nav .nav-item .nav-link {
            color: #FFF6E9;
            margin-left: 15px;
            font-weight: 500;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #e0f7fa;
        }

        .navbar-custom .form-inline {
            display: flex;
            align-items: center;
        }

        .navbar-custom .form-inline .btn {
            margin-left: 10px;
        }

        .content {
            padding: 20px;
        }

        .welcome-header {
            font-size: 2rem;
            font-weight: 500;
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
            background-color: #40A2E3;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }


        .welcome-description {
            font-size: 1.10rem;
            color: #444;
            text-align: center;
            margin-bottom: 30px;
        }

        .savings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .savings-card {
            background-color: #EEF7FF;
            color: #444444;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 15px;
        }

        .savings-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .savings-card-body {
            padding: 15px;
            color: #444444;
        }

        .savings-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .savings-card-info {
            font-size: 0.9rem;
            color: #444444;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .savings-card-info i {
            color: #1a237e;
            margin-right: 8px;
        }

        .savings-icon {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .savings-icon i {
            font-size: 40px;
            color: #1a237e;
        }

        .progress {
            height: 10px;
            margin-bottom: 10px;
            background-color: #e3e1e1;
        }

        .savings-card-status {
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .savings-card-status i {
            margin-right: 5px;
        }

        .status-achieved {
            color: #28a745;
        }

        .status-ongoing {
            color: #ffc107;
        }

        .btn-custom {
            color: #ffffff;
            border-radius: 15px;
            font-size: 1rem;
            padding: 8px 12px;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn-success.btn-custom:hover {
            background-color: #fff;
            color: #198754;
        }

        .btn-primary.btn-custom {
            background-color: #40A2E3;
            color: #fff;
        }

        .btn-primary.btn-custom:hover {
            background-color: #fff;
            color: #40A2E3;
        }


        .btn-danger.btn-custom:hover {
            background-color: #fff;
            color: #dc3545;
        }

        .btn-warning.btn-custom:hover {
            background-color: #fff;
            color: #ffc107;
        }

        @media (max-width: 767.98px) {
            .savings-card {
                padding: 10px;
            }

            .savings-card-title {
                font-size: 1rem;
            }

            .savings-card-info {
                font-size: 0.85rem;
            }

            .savings-icon i {
                font-size: 30px;
            }

            .progress {
                height: 8px;
            }

            .btn-custom {
                font-size: 0.9rem;
                padding: 6px 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">CitaCuan</a>
        <div class="container-fluid">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user"></i> {{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger btn-custom" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>

    <!-- Content -->
    <div class="content">
        <div class="welcome-section">
            {{-- <h1 class="welcome-header">Mulai tabunganmu hari ini dan wujudkan rencana masa depan dengan lebih mudah</h1>
            <p class="welcome-description"></p> --}}
            <!-- Tambahkan tombol tambah tabungan di sini -->
            <div class="text-center mb-4">
                <a href="#" class="btn btn-primary btn-lg btn-custom"><i class="fas fa-plus-circle"></i> Tambah Tabungan</a>
            </div>
        </div>

        <div class="savings-grid">
            <!-- Savings Goal 2 -->
            <div class="savings-card">
                <div class="savings-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <div class="savings-card-body">
                    <h5 class="savings-card-title">New Smartphone</h5>
                    <p class="savings-card-info"><i class="fas fa-bullseye"></i> Target : Rp 8,000,000</p>
                    <p class="savings-card-info"><i class="fas fa-calendar-alt"></i> Target Tanggal : 30 Jun 2024</p>
                    <p class="savings-card-info"><i class="fas fa-piggy-bank"></i> Nominal Terkumpul : Rp 6,400,000</p>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="savings-card-status status-ongoing"><i class="fas fa-hourglass-half"></i> In Progress</p>

                    <!-- Tambahkan tombol edit, hapus, dan menabung -->
                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-warning btn-lg btn-custom"><i class="fas fa-edit"></i> Edit</button>
                        <button class="btn btn-danger btn-lg btn-custom"><i class="fas fa-trash-alt"></i> Hapus</button>
                    </div>
                    <!-- Tambahkan tombol menabung -->
                    <div class="d-grid gap-2 mt-2">
                        <button class="btn btn-success btn-lg btn-custom"><i class="fas fa-piggy-bank"></i> Menabung</button>
                    </div>
                </div>
            </div>

            <!-- Savings Goal 3 -->
            <div class="savings-card">
                <div class="savings-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="savings-card-body">
                    <h5 class="savings-card-title">Emergency Fund</h5>
                    <p class="savings-card-info"><i class="fas fa-bullseye"></i> Target: Rp 25,000,000</p>
                    <p class="savings-card-info"><i class="fas fa-calendar-alt"></i> Target Date: 31 Dec 2023</p>
                    <p class="savings-card-info"><i class="fas fa-piggy-bank"></i> Current Savings: Rp 25,000,000</p>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="savings-card-status status-achieved"><i class="fas fa-check-circle"></i> Achieved</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
