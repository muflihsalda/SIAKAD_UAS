# SIAKAD_UAS
Nama :Muflih Salda Maulana


Nim :312410527


Kelas:TI.24.A5

---

**LANGKAH MEMBANGUN SISTEM SIAKAD (Admin & User)**

# Struktur Folder

<img width="435" height="660" alt="image" src="https://github.com/user-attachments/assets/609c37f6-2f92-4f21-ad35-a492befb2fa6" />

Sistem ini dibangun menggunakan:

* PHP
* MySQL
* Konsep MVC
* Role: **Admin & User**

---

# 1. Membuat Database

### 1.1 Membuat Database

```sql
CREATE DATABASE siakad_uas;
USE siakad_uas;
```

---

### 1.2 Tabel Users

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  password VARCHAR(255),
  role ENUM('admin','user')
);
```

Contoh data:

```sql
INSERT INTO users (username, password, role)
VALUES ('admin', MD5('admin123'), 'admin'),
       ('mhs1', MD5('12345'), 'user');
```

---

### 1.3 Tabel Mahasiswa

```sql
CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(20),
  nama VARCHAR(100),
  jurusan VARCHAR(50)
);
```

---

### 1.4 Tabel Mata Kuliah

```sql
CREATE TABLE matakuliah (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode VARCHAR(20),
  nama VARCHAR(100),
  sks INT
);
```

---

### 1.5 Tabel Nilai

```sql
CREATE TABLE nilai (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT,
  matakuliah_id INT,
  nilai VARCHAR(5)
);
```

---

# 2. Koneksi Database (config/database.php)

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "siakad_uas";

$conn = mysqli_connect($host,$user,$pass,$db);
?>
```

---

# 3. Sistem Login

### 3.1 Form Login (View)

```php
<form method="post" action="login.php">
  <input type="text" name="username">
  <input type="password" name="password">
  <button type="submit">Login</button>
</form>
```

---

### 3.2 Proses Login

```php
session_start();
include 'database.php';

$user = $_POST['username'];
$pass = md5($_POST['password']);

$q = mysqli_query($conn,"SELECT * FROM users WHERE username='$user' AND password='$pass'");
$data = mysqli_fetch_assoc($q);

if($data){
  $_SESSION['role'] = $data['role'];
  header("Location: dashboard.php");
}
```

---

# 4. Sistem Role (Admin & User)

Di setiap halaman:

```php
session_start();
if($_SESSION['role'] != 'admin'){
   header("Location: user_dashboard.php");
}
```

Ini membuat:

* Admin → halaman kelola
* User → halaman lihat saja

---

# 5. Menampilkan Data Mahasiswa

```php
$data = mysqli_query($conn,"SELECT * FROM mahasiswa");
while($m = mysqli_fetch_array($data)){
  echo $m['nama'];
}
```

---

# 6. Tambah Data (Admin)

```php
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];

mysqli_query($conn,"INSERT INTO mahasiswa VALUES('','$nim','$nama','$jurusan')");
```

---

# 7. Data Nilai

```php
mysqli_query($conn,"INSERT INTO nilai VALUES('','$mhs','$mk','$nilai')");
```

---

# 8. User hanya melihat

```php
SELECT mahasiswa.nama, matakuliah.nama, nilai.nilai
FROM nilai
JOIN mahasiswa ON nilai.mahasiswa_id = mahasiswa.id
JOIN matakuliah ON nilai.matakuliah_id = matakuliah.id
WHERE mahasiswa.id = $_SESSION[id];
```

---

# Kesimpulan Arsitektur

| Bagian   | Fungsi               |
| -------- | -------------------- |
| Database | Menyimpan data       |
| PHP      | Logika               |
| Session  | Keamanan             |
| Role     | Pembeda Admin & User |
| MVC      | Kode rapi            |

---


