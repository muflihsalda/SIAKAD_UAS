<?php
require_once '../app/models/Mahasiswa.php';
require_once '../app/models/Matakuliah.php';
require_once '../app/models/Nilai.php';

class DashboardController {

    public function index() {
        $mahasiswa  = new Mahasiswa();
        $matakuliah = new Matakuliah();
        $nilai      = new Nilai();

        $totalMahasiswa  = $mahasiswa->countData();
        $totalMatakuliah = $matakuliah->countData();
        $totalNilai      = $nilai->countData();

        require '../app/views/dashboard/index.php';
    }
}
