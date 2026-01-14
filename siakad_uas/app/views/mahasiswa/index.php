<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<?php if (isset($_GET['success'])): ?>
<div class="alert alert-success">
    Data berhasil <?= htmlspecialchars($_GET['success']) ?>
</div>
<?php endif; ?>

<h3>Data Mahasiswa</h3>

<!-- FORM SEARCH -->
<form method="get" class="mb-3">
    <input type="hidden" name="url" value="mahasiswa">
    <div class="input-group w-50">
        <input type="text" name="search" class="form-control"
               placeholder="Cari NIM atau Nama"
               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button class="btn btn-primary">Cari</button>
        <a href="index.php?url=mahasiswa" class="btn btn-secondary">Reset</a>
    </div>
</form>

<!-- FORM TAMBAH (ADMIN SAJA) -->
<?php if ($_SESSION['user']['role'] === 'admin'): ?>
<form method="post" action="index.php?url=mahasiswa/store" class="row g-2 mb-4">
    <div class="col-md-2">
        <input name="nim" class="form-control" placeholder="NIM" required>
    </div>
    <div class="col-md-3">
        <input name="nama" class="form-control" placeholder="Nama" required>
    </div>
    <div class="col-md-3">
        <input name="jurusan" class="form-control" placeholder="Jurusan">
    </div>
    <div class="col-md-3">
        <input name="email" class="form-control" placeholder="Email">
    </div>
    <div class="col-md-1">
        <button class="btn btn-success">Tambah</button>
    </div>
</form>
<?php endif; ?>

<table class="table table-bordered table-striped">
<tr>
    <th>No</th>
    <th>NIM</th>
    <th>Nama</th>
    <th>Jurusan</th>
    <th>Email</th>
    <th>Aksi</th>
</tr>

<?php $no=1; foreach ($data as $m): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($m['nim']) ?></td>
    <td><?= htmlspecialchars($m['nama']) ?></td>
    <td><?= htmlspecialchars($m['jurusan']) ?></td>
    <td><?= htmlspecialchars($m['email']) ?></td>
    <td>
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="index.php?url=mahasiswa/edit&id=<?= $m['id'] ?>"
               class="btn btn-warning btn-sm">Edit</a>

            <a href="index.php?url=mahasiswa/delete&id=<?= $m['id'] ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Hapus data?')">Hapus</a>
        <?php else: ?>
            <span class="text-muted">Read Only</span>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>

<!-- PAGINATION -->
<?php if ($totalPage > 1): ?>
<nav>
    <ul class="pagination">
        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link"
               href="index.php?url=mahasiswa&page=<?= $page - 1 ?>&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>">
               Previous
            </a>
        </li>

        <?php for ($i = 1; $i <= $totalPage; $i++): ?>
        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
            <a class="page-link"
               href="index.php?url=mahasiswa&page=<?= $i ?>&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>">
               <?= $i ?>
            </a>
        </li>
        <?php endfor; ?>

        <li class="page-item <?= ($page >= $totalPage) ? 'disabled' : '' ?>">
            <a class="page-link"
               href="index.php?url=mahasiswa&page=<?= $page + 1 ?>&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>">
               Next
            </a>
        </li>
    </ul>
</nav>
<?php endif; ?>

<a href="index.php?url=dashboard" class="btn btn-secondary">Kembali</a>

</body>
</html>
