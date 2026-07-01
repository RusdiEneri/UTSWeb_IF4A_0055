<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <style>
    .admin-wrapper{display:flex}
    .sidebar-area{width:240px;flex:0 0 240px}
    .main-area{flex:1;padding:28px}
    .card-hero{border-radius:16px;padding:20px}
  </style>
</head>
<body>
  <?php include __DIR__ . '/../includes/navbar.php'; ?>

  <div class="admin-wrapper">
    <aside class="sidebar-area">
      <?php include __DIR__ . '/../includes/sidebar.php'; ?>
    </aside>

    <main class="main-area">
      <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2>Dashboard</h2>
          <div>Selamat datang, Admin</div>
        </div>

        <div class="row g-4">
          <div class="col-md-6">
            <div class="info-card card-hero">
              <h5>Ringkasan</h5>
              <p class="text-muted">Statistik singkat akan muncul di sini.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-card card-hero">
              <h5>Aktivitas Terbaru</h5>
              <p class="text-muted">Log aktivitas admin dan booking.</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../assets/js/admin.js"></script>
</body>
</html>
