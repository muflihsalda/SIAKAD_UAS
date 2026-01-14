<?php
require_once '../app/models/Mahasiswa.php';

class MahasiswaController {

    private $model;

    public function __construct() {
        $this->model = new Mahasiswa();
    }

    public function index() {
        $search = $_GET['search'] ?? '';
        $page   = max(1, $_GET['page'] ?? 1);
        $limit  = 5;
        $offset = ($page - 1) * $limit;

        $data = $this->model->paginate($limit, $offset, $search);
        $totalData = $this->model->countData($search);
        $totalPage = ceil($totalData / $limit);

        require '../app/views/mahasiswa/index.php';
    }

    public function store() {
        $this->model->insert($_POST);
        header("Location: index.php?url=mahasiswa&success=ditambahkan");
    }

    public function edit() {
        $mahasiswa = $this->model->find($_GET['id']);
        require '../app/views/mahasiswa/edit.php';
    }

    public function update() {
        $this->model->update($_POST);
        header("Location: index.php?url=mahasiswa&success=diupdate");
    }

    public function destroy() {
        $this->model->delete($_GET['id']);
        header("Location: index.php?url=mahasiswa&success=dihapus");
    }
}
