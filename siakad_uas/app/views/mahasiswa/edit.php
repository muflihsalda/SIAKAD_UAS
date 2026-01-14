<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Edit Mahasiswa</h3>

<form method="post" action="index.php?url=mahasiswa/update">
    <input type="hidden" name="id" value="<?= $mahasiswa['id'] ?>">

    <input name="nim" class="form-control mb-2"
           value="<?= htmlspecialchars($mahasiswa['nim']) ?>" required>

    <input name="nama" class="form-control mb-2"
           value="<?= htmlspecialchars($mahasiswa['nama']) ?>" required>

    <input name="jurusan" class="form-control mb-2"
           value="<?= htmlspecialchars($mahasiswa['jurusan']) ?>">

    <input name="email" class="form-control mb-2"
           value="<?= htmlspecialchars($mahasiswa['email']) ?>">

    <button class="btn btn-primary">Update</button>
    <a href="index.php?url=mahasiswa" class="btn btn-secondary">Batal</a>
</form>

</body>
</html>
