<?php
$role = $_SESSION['user']['role'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">SIAKAD Mini</span>
        <a href="index.php?url=logout" class="btn btn-sm btn-light">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>Dashboard <?= ucfirst($role) ?></h3>
    <p>Selamat datang di Sistem Informasi Akademik Mini</p>

    <!-- RINGKASAN DATA -->
    <div class="row mt-3">

        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5>Total Mahasiswa</h5>
                    <h2><?= $totalMahasiswa ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5>Total Mata Kuliah</h5>
                    <h2><?= $totalMatakuliah ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5>Total Nilai</h5>
                    <h2><?= $totalNilai ?></h2>
                </div>
            </div>
        </div>

    </div>

    <!-- MENU -->
    <div class="row mt-4">

        <!-- MAHASISWA -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Data Mahasiswa</h5>
                    <p><?= $role === 'admin' ? 'Kelola data mahasiswa' : 'Lihat data mahasiswa' ?></p>
                    <a href="index.php?url=mahasiswa" class="btn btn-primary">
                        <?= $role === 'admin' ? 'Kelola' : 'Lihat' ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- MATA KULIAH -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Data Mata Kuliah</h5>
                    <p><?= $role === 'admin' ? 'Kelola mata kuliah' : 'Lihat mata kuliah' ?></p>
                    <a href="index.php?url=matakuliah" class="btn btn-success">
                        <?= $role === 'admin' ? 'Kelola' : 'Lihat' ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- NILAI -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Data Nilai</h5>
                    <p><?= $role === 'admin' ? 'Kelola nilai mahasiswa' : 'Lihat nilai' ?></p>
                    <a href="index.php?url=nilai" class="btn btn-warning">
                        <?= $role === 'admin' ? 'Kelola' : 'Lihat' ?>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
