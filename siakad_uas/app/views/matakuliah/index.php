<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Data Mata Kuliah</h3>

<!-- FORM TAMBAH (ADMIN ONLY) -->
<?php if ($_SESSION['user']['role'] === 'admin'): ?>
<form method="post" action="index.php?url=matakuliah/store" class="row g-2 mb-4">
    <div class="col-md-3">
        <input name="kode_mk" class="form-control" placeholder="Kode MK" required>
    </div>
    <div class="col-md-5">
        <input name="nama_mk" class="form-control" placeholder="Nama Mata Kuliah" required>
    </div>
    <div class="col-md-2">
        <input name="sks" type="number" class="form-control" placeholder="SKS" required>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success">Tambah</button>
    </div>
</form>
<?php endif; ?>


<table class="table table-bordered">
<tr>
    <th>No</th>
    <th>Kode</th>
    <th>Nama</th>
    <th>SKS</th>
    <th>Aksi</th>
</tr>

<?php $no=1; foreach ($data as $m): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($m['kode_mk']) ?></td>
    <td><?= htmlspecialchars($m['nama_mk']) ?></td>
    <td><?= $m['sks'] ?></td>
    <td>
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="index.php?url=matakuliah/delete&id=<?= $m['id'] ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Hapus data?')">Hapus</a>
        <?php else: ?>
            <span class="badge bg-secondary">Read Only</span>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>

<a href="index.php?url=dashboard" class="btn btn-secondary">Kembali</a>

</body>
</html>
