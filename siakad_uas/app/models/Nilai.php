<?php
require_once '../config/database.php';

class Nilai {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function countData() {
    return $this->conn->query("SELECT COUNT(*) FROM nilai")->fetchColumn();
}

// Ambil nilai berdasarkan mahasiswa tertentu (UNTUK USER)
    public function byMahasiswa($mahasiswa_id) {
            $stmt = $this->conn->prepare(
                "SELECT n.id, m.nama AS mahasiswa, mk.nama_mk, n.nilai
                FROM nilai n
                JOIN mahasiswa m ON n.mahasiswa_id = m.id
                JOIN matakuliah mk ON n.matakuliah_id = mk.id
                WHERE n.mahasiswa_id = :mid
                ORDER BY n.id DESC"
            );
            $stmt->execute(['mid' => $mahasiswa_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  
         }


    public function all() {
        $stmt = $this->conn->query(
            "SELECT n.id, m.nama AS mahasiswa, mk.nama_mk, n.nilai
             FROM nilai n
             JOIN mahasiswa m ON n.mahasiswa_id = m.id
             JOIN matakuliah mk ON n.matakuliah_id = mk.id
             ORDER BY n.id DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $stmt = $this->conn->prepare(
            "INSERT INTO nilai (mahasiswa_id, matakuliah_id, nilai)
             VALUES (:mahasiswa_id, :matakuliah_id, :nilai)"
        );
        return $stmt->execute([
            'mahasiswa_id'  => $data['mahasiswa_id'],
            'matakuliah_id' => $data['matakuliah_id'],
            'nilai'         => $data['nilai']
        ]);

     }public function delete($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM nilai WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }

public function find($id) {
    $stmt = $this->conn->prepare(
        "SELECT * FROM nilai WHERE id = :id"
    );
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function update($data) {
    $stmt = $this->conn->prepare(
        "UPDATE nilai SET
            mahasiswa_id  = :mahasiswa_id,
            matakuliah_id = :matakuliah_id,
            nilai         = :nilai
         WHERE id = :id"
    );
    return $stmt->execute([
        'id'            => $data['id'],
        'mahasiswa_id'  => $data['mahasiswa_id'],
        'matakuliah_id' => $data['matakuliah_id'],
        'nilai'         => $data['nilai']
    ]);
}

}

