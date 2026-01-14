<!DOCTYPE html>
<html>
<head>
    <title>Data Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Data Nilai Mahasiswa</h3>

<!-- ================= FORM TAMBAH NILAI (ADMIN ONLY) ================= -->
<?php if ($_SESSION['user']['role'] === 'admin'): ?>
<form method="post" action="index.php?url=nilai/store" class="row g-2 mb-4">
    <div class="col-md-4">
        <select name="mahasiswa_id" class="form-control" required>
            <option value="">-- Pilih Mahasiswa --</option>
            <?php foreach ($dataMahasiswa as $m): ?>
                <option value="<?= $m['id'] ?>">
                    <?= htmlspecialchars($m['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-4">
        <select name="matakuliah_id" class="form-control" required>
            <option value="">-- Pilih Mata Kuliah --</option>
            <?php foreach ($dataMatakuliah as $mk): ?>
                <option value="<?= $mk['id'] ?>">
                    <?= htmlspecialchars($mk['nama_mk']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-2">
        <input name="nilai" class="form-control" placeholder="Nilai (A / B / C)" required>
    </div>

    <div class="col-md-2">
        <button class="btn btn-success w-100">Tambah</button>
    </div>
</form>
<?php endif; ?>

<!-- ================= TABEL DATA NILAI ================= -->
<table class="table table-bordered table-striped">
<tr class="table-dark">
    <th>No</th>
    <th>Mahasiswa</th>
    <th>Mata Kuliah</th>
    <th>Nilai</th>

    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <th>Aksi</th>
    <?php endif; ?>
</tr>

<?php if (!empty($dataNilai)): ?>
    <?php $no = 1; foreach ($dataNilai as $n): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($n['mahasiswa']) ?></td>
        <td><?= htmlspecialchars($n['nama_mk']) ?></td>
        <td><?= htmlspecialchars($n['nilai']) ?></td>

        <!-- ===== DELETE ADMIN ONLY ===== -->
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
       <td>
            <a href="index.php?url=nilai/edit&id=<?= $n['id'] ?>"
            class="btn btn-warning btn-sm">Edit</a>

            <a href="index.php?url=nilai/delete&id=<?= $n['id'] ?>"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
     </td>

        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="<?= ($_SESSION['user']['role'] === 'admin') ? 5 : 4 ?>" class="text-center">
            Data nilai belum tersedia
        </td>
    </tr>
<?php endif; ?>
</table>

<a href="index.php?url=dashboard" class="btn btn-secondary mt-3">Kembali</a>

</body>
</html>
