<?php
require_once '../app/models/Matakuliah.php';

class MatakuliahController {
    private $model;

    public function __construct() {
        $this->model = new Matakuliah();
    }

    public function index() {
        $data = $this->model->all();
        require '../app/views/matakuliah/index.php';
    }

    public function store() {
        $this->model->insert($_POST);
        header("Location: index.php?url=matakuliah");
        exit;
    }

    public function delete() {
        $this->model->delete($_GET['id']);
        header("Location: index.php?url=matakuliah");
        exit;
    }
}
