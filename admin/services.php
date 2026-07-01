<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
require_once __DIR__ . '/../config/database.php';
// Fetch services
try {
    $stmt = $pdo->query('SELECT * FROM services ORDER BY id DESC');
    $services = $stmt->fetchAll();
} catch (Exception $e) {
    $services = [];
    $fetchError = $e->getMessage();
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Manajemen Layanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <style>.table-img{width:80px;height:auto;object-fit:cover;border-radius:8px}</style>
</head>
<body>
  <?php include __DIR__ . '/../includes/navbar.php'; ?>
  <div class="d-flex">
    <aside class="sidebar-area">
      <?php include __DIR__ . '/../includes/sidebar.php'; ?>
    </aside>

    <main class="main-area">
      <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3>Manajemen Layanan</h3>
          <a href="service_add.php" class="btn btn-primary-custom">Tambah Layanan</a>
        </div>

        <?php if (!empty($fetchError)): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($fetchError); ?></div>
        <?php endif; ?>

        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($services)): ?>
                    <tr><td colspan="6" class="text-center">Belum ada data layanan.</td></tr>
                  <?php else: ?>
                    <?php foreach ($services as $s): ?>
                      <tr>
                        <td><?php echo htmlspecialchars($s['id']); ?></td>
                        <td>
                          <?php if (!empty($s['image_url'])): ?>
                            <img src="<?php echo htmlspecialchars($s['image_url']); ?>" class="table-img" alt="">
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($s['title']); ?></td>
                        <td><?php echo htmlspecialchars($s['description']); ?></td>
                        <td>Rp <?php echo number_format($s['price'],2,',','.'); ?></td>
                        <td>
                          <a href="service_edit.php?id=<?php echo $s['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                          <a href="service_delete.php?id=<?php echo $s['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus layanan ini?');">Delete</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
