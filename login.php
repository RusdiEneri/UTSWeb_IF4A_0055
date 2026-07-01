<?php
session_start();
if (!empty($_SESSION['admin_id'])) {
    header('Location: admin/index.php');
    exit;
}

// Include PDO connection (returns $pdo)
require_once __DIR__ . '/config/database.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Silakan masukkan username dan password.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $user['id'];
            header('Location: admin/index.php');
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Velora MotoCare</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --velora-bg:#0b1220; /* dark navy */
      --velora-accent:#ff7a00; /* orange */
      --velora-card:#ffffff;
    }
    body{background-color:var(--velora-bg);color:#fff;min-height:100vh}
    .login-card{max-width:900px;margin:6rem auto;padding:2rem;border-radius:14px;background:var(--velora-card);color:#111}
    .brand{color:var(--velora-accent);font-weight:700}
    .btn-velora{background:var(--velora-accent);border-color:var(--velora-accent);color:#fff}
    .btn-velora:hover{background:#e36a00;border-color:#e36a00}
    .form-label{color:#374151}
    .help-box{border:2px dashed rgba(255,122,0,0.15);padding:1rem;border-radius:8px;color:#111;background:#fff}
  </style>
</head>
<body>
  <div class="container">
    <div class="login-card shadow">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h1 class="brand">Velora <span style="color:#111;font-weight:600">MotoCare</span></h1>
          <p class="text-muted">Masuk untuk mengelola layanan dan booking.</p>
        </div>
        <div class="col-md-6">
          <?php if ($error): ?>
            <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></div>
          <?php endif; ?>
          <form method="post" action="">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input name="username" type="text" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input name="password" type="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-velora btn-lg">Masuk</button>
            </div>
          </form>
          <div class="mt-3 text-muted small">Gunakan akun admin untuk mengakses panel.</div>
        </div>
      </div>
    </div>
    <div class="text-center mt-3 help-box">Jika lupa password, hubungi administrator.</div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
