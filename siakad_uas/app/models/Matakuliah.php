<?php
require_once '../config/database.php';

class Matakuliah {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function countData() {
    return $this->conn->query("SELECT COUNT(*) FROM matakuliah")->fetchColumn();
}


    public function all() {
        $stmt = $this->conn->query(
            "SELECT * FROM matakuliah ORDER BY id DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $stmt = $this->conn->prepare(
            "INSERT INTO matakuliah (kode_mk, nama_mk, sks)
             VALUES (:kode_mk, :nama_mk, :sks)"
        );
        return $stmt->execute([
            'kode_mk' => $data['kode_mk'],
            'nama_mk' => $data['nama_mk'],
            'sks'     => $data['sks']
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM matakuliah WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}
