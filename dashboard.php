<?php
session_start();

// proteksi halaman
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{ background:#f4f6f9; }
        .sidebar{
            min-height:100vh;
            background:#667eea;
            color:white;
        }
        .sidebar a{
            color:white;
            display:block;
            padding:10px;
            text-decoration:none;
            border-radius:8px;
        }
        .sidebar a:hover{
            background:rgba(255,255,255,.2);
        }
        .card{
            border-radius:1rem;
            box-shadow:0 6px 20px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 sidebar p-4">
            <h4 class="fw-bold">🚗 Parkir</h4>
            <hr>
            <a href="#">Dashboard</a>
            <a href="#">Data Kendaraan</a>
            <a href="#">Parkir Masuk</a>
            <a href="#">Parkir Keluar</a>
            <a href="logout.php" class="text-warning mt-3">Logout</a>
        </div>

        <!-- KONTEN -->
        <div class="col-md-9 col-lg-10 p-4">
            <h3 class="fw-bold">
                Selamat Datang, <?= $_SESSION['username']; ?>
            </h3>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card p-4">
                        <h6>Total Kendaraan</h6>
                        <h2>120</h2>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-4">
                        <h6>Parkir Masuk</h6>
                        <h2 class="text-success">75</h2>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-4">
                        <h6>Parkir Keluar</h6>
                        <h2 class="text-danger">45</h2>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>