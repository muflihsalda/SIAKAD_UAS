<?php
session_start();

require_once '../config/database.php';

require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/DashboardController.php';
require_once '../app/controllers/MahasiswaController.php';
require_once '../app/controllers/MatakuliahController.php';
require_once '../app/controllers/NilaiController.php';

$dashboardController = new DashboardController();

$url = $_GET['url'] ?? 'login';

/* ================= PROTEKSI LOGIN ================= */
$protected = [
    'dashboard',

    'mahasiswa',
    'mahasiswa/store',
    'mahasiswa/edit',
    'mahasiswa/update',
    'mahasiswa/delete',

    'matakuliah',
    'matakuliah/store',
    'matakuliah/delete',

    'nilai',
    'nilai/store',
    'nilai/delete',

    'logout'
];

if (in_array($url, $protected) && !isset($_SESSION['user'])) {
    header("Location: index.php?url=login");
    exit;
}

/* ================= ROLE USER ================= */
if (
    isset($_SESSION['user']) &&
    $_SESSION['user']['role'] === 'user' &&
    in_array($url, [
        'mahasiswa/store',
        'mahasiswa/edit',
        'mahasiswa/update',
        'mahasiswa/delete',
        'matakuliah/store',
        'matakuliah/delete'
    ])
) {
    echo "Akses ditolak";
    exit;
}

/* ===== BLOK CRUD UNTUK ROLE USER ===== */
if (
    isset($_SESSION['user']) &&
    $_SESSION['user']['role'] === 'user' &&
    in_array($url, [
        // MAHASISWA
        'mahasiswa/store',
        'mahasiswa/edit',
        'mahasiswa/update',
        'mahasiswa/delete',

        // MATAKULIAH
        'matakuliah/store',
        'matakuliah/edit',
        'matakuliah/update',
        'matakuliah/delete',

        // NILAI
        'nilai/store',
        'nilai/edit',
        'nilai/update',
        'nilai/delete'
    ])
) {
    echo "<h3>Akses ditolak (User hanya bisa melihat data)</h3>";
    exit;
}

/* ================= BLOK ADMIN CRUD ================= */
if (
    isset($_SESSION['user']) &&
    $_SESSION['user']['role'] === 'admin' &&
    in_array($url, [
        // CRUD NILAI (ADMIN SAJA)
        'nilai/store',
        'nilai/delete'
    ])
) {
    // ADMIN DIIZINKAN
    // (tidak perlu exit)
}

/* ================= CONTROLLER ================= */
$auth        = new AuthController();
$dashboard   = new DashboardController();
$mahasiswa   = new MahasiswaController();
$matakuliah  = new MatakuliahController();
$nilai       = new NilaiController();

/* ================= ROUTING ================= */
switch ($url) {

    case 'login':
        $auth->login();
        break;

    case 'login/process':
        $auth->process();
        break;

    case 'logout':
        $auth->logout();
        break;

   case 'dashboard':
    $dashboardController->index();
    break;


    case 'mahasiswa':
        $mahasiswa->index();
        break;

    case 'mahasiswa/store':
        $mahasiswa->store();
        break;

    case 'mahasiswa/edit':
        $mahasiswa->edit();
        break;

    case 'mahasiswa/update':
        $mahasiswa->update();
        break;

    case 'mahasiswa/delete':
        $mahasiswa->destroy();
        break;

    case 'matakuliah':
        $matakuliah->index();
        break;

    case 'matakuliah/store':
        $matakuliah->store();
        break;

    case 'matakuliah/delete':
        $matakuliah->delete();
        break;

    case 'nilai':
        $nilai->index();
        break;

    case 'nilai/store':
        $nilai->store();
        break;
        
    case 'nilai/delete':
        $nilai->delete();
        break;

    case 'nilai/edit':
        $nilai->edit();
        break;

    case 'nilai/update':
        $nilai->update();
        break;


    default:
        echo "404 - Halaman tidak ditemukan";
}
