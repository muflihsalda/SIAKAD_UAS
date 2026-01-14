<?php
require_once '../config/database.php';

class Mahasiswa {

    private $conn;

    public function all() {
    $stmt = $this->conn->query(
        "SELECT * FROM mahasiswa ORDER BY nama ASC"
    );
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function paginate($limit, $offset, $search = '') {
        if ($search) {
            $stmt = $this->conn->prepare(
                "SELECT * FROM mahasiswa
                 WHERE nim LIKE :s OR nama LIKE :s
                 ORDER BY id DESC
                 LIMIT :l OFFSET :o"
            );
            $stmt->bindValue(':s', "%$search%");
        } else {
            $stmt = $this->conn->prepare(
                "SELECT * FROM mahasiswa
                 ORDER BY id DESC
                 LIMIT :l OFFSET :o"
            );
        }

        $stmt->bindValue(':l', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':o', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countData($search = '') {
        if ($search) {
            $stmt = $this->conn->prepare(
                "SELECT COUNT(*) FROM mahasiswa
                 WHERE nim LIKE :s OR nama LIKE :s"
            );
            $stmt->execute(['s' => "%$search%"]);
            return $stmt->fetchColumn();
        }
        return $this->conn->query("SELECT COUNT(*) FROM mahasiswa")->fetchColumn();
    }

    public function insert($data) {
        $stmt = $this->conn->prepare(
            "INSERT INTO mahasiswa (nim,nama,jurusan,email)
             VALUES (:nim,:nama,:jurusan,:email)"
        );
        $stmt->execute($data);
    }

    public function find($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM mahasiswa WHERE id = :id"
        );
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $stmt = $this->conn->prepare(
            "UPDATE mahasiswa SET
             nim=:nim, nama=:nama, jurusan=:jurusan, email=:email
             WHERE id=:id"
        );
        $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM mahasiswa WHERE id=:id"
        );
        $stmt->execute(['id'=>$id]);
    }
}
