<?php
require_once '../app/models/Nilai.php';
require_once '../app/models/Mahasiswa.php';
require_once '../app/models/Matakuliah.php';

class NilaiController {

public function index() {
    $nilai = new Nilai();
    $mahasiswa = new Mahasiswa();
    $matakuliah = new Matakuliah();

    // ADMIN → lihat semua nilai
    if ($_SESSION['user']['role'] === 'admin') {
        $dataNilai = $nilai->all();
        $dataMahasiswa = $mahasiswa->all();
        $dataMatakuliah = $matakuliah->all();
    }
    // USER → lihat nilai milik sendiri
    else {
        if (empty($_SESSION['user']['mahasiswa_id'])) {
            die('Mahasiswa belum terhubung dengan user');
        }

        $dataNilai = $nilai->byMahasiswa($_SESSION['user']['mahasiswa_id']);
        $dataMahasiswa = [];
        $dataMatakuliah = [];
    }

    require '../app/views/nilai/index.php';
}


    public function store() {
        $nilai = new Nilai();
        $nilai->insert($_POST);
        header("Location: index.php?url=nilai");
        exit;
    }
        public function edit() {
    if ($_SESSION['user']['role'] !== 'admin') {
        echo "Akses ditolak";
        exit;
    }

    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo "ID tidak ditemukan";
        exit;
    }

    $nilai = new Nilai();
    $mahasiswa = new Mahasiswa();
    $matakuliah = new Matakuliah();

    $dataNilai = $nilai->find($id);
    $dataMahasiswa = $mahasiswa->all();
    $dataMatakuliah = $matakuliah->all();

    require '../app/views/nilai/edit.php';
}

public function update() {
    if ($_SESSION['user']['role'] !== 'admin') {
        echo "Akses ditolak";
        exit;
    }

    $nilai = new Nilai();
    $nilai->update($_POST);

    header("Location: index.php?url=nilai");
    exit;
}


public function delete() {
    // Proteksi admin
    if ($_SESSION['user']['role'] !== 'admin') {
        echo "Akses ditolak";
        exit;
    }

    $id = $_GET['id'] ?? null;

    if (!$id) {
        echo "ID tidak ditemukan";
        exit;
    }

    $nilai = new Nilai();
    $nilai->delete($id);

    header("Location: index.php?url=nilai");
    exit;
}


}
