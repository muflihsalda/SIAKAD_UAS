<!DOCTYPE html>
<html>
<head>
    <title>Edit Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Edit Nilai Mahasiswa</h3>

<form method="post" action="index.php?url=nilai/update">
    <input type="hidden" name="id" value="<?= $dataNilai['id'] ?>">

    <div class="mb-2">
        <label>Mahasiswa</label>
        <select name="mahasiswa_id" class="form-control" required>
            <?php foreach ($dataMahasiswa as $m): ?>
                <option value="<?= $m['id'] ?>"
                    <?= ($m['id'] == $dataNilai['mahasiswa_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($m['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-2">
        <label>Mata Kuliah</label>
        <select name="matakuliah_id" class="form-control" required>
            <?php foreach ($dataMatakuliah as $mk): ?>
                <option value="<?= $mk['id'] ?>"
                    <?= ($mk['id'] == $dataNilai['matakuliah_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($mk['nama_mk']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-2">
        <label>Nilai</label>
        <input name="nilai" class="form-control"
               value="<?= htmlspecialchars($dataNilai['nilai']) ?>" required>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="index.php?url=nilai" class="btn btn-secondary">Batal</a>
</form>

</body>
</html>
