<!DOCTYPE html>
<html>
<head>
    <title>Login SIAKAD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

<h3>Login SIAKAD Mini</h3>

<?php if (isset($_GET['error'])): ?>
<div class="alert alert-danger">Username atau Password salah</div>
<?php endif; ?>

<form method="post" action="index.php?url=login/process">
    <input name="username" class="form-control mb-2" placeholder="Username" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
    <button class="btn btn-primary">Login</button>
</form>

</body>
</html>
