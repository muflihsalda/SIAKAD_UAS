<?php
require_once '../config/database.php';

class AuthController {

    public function login() {
        require '../app/views/auth/login.php';
    }

    public function process() {
        $db = new Database();
        $conn = $db->connect();

        $stmt = $conn->prepare(
            "SELECT * FROM users WHERE username = :username"
        );
        $stmt->execute([
            'username' => $_POST['username']
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $_POST['password'] === $user['password']) {

         
            $_SESSION['user'] = [
                'id'           => $user['id'],
                'username'     => $user['username'],
                'role'         => $user['role'],
                'mahasiswa_id' => $user['mahasiswa_id']
            ];

            header("Location: index.php?url=dashboard");
            exit;

        } else {
            header("Location: index.php?url=login&error=1");
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?url=login");
        exit;
    }
}
