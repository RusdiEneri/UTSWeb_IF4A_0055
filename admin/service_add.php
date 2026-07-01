<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
require_once __DIR__ . '/../config/database.php';

$errors = [];
$title = '';
$description = '';
$price = '';
$image_url = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '0');
    $image_url = trim($_POST['image_url'] ?? '');

    if ($title === '') {
        $errors[] = 'Judul wajib diisi.';
    }
    if (!is_numeric($price)) {
        $errors[] = 'Harga harus berupa angka.';
    }

    if (empty($errors)) {
        $sql = 'INSERT INTO services (title, description, image_url, price) VALUES (:title, :description, :image_url, :price)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':image_url', $image_url);
        $stmt->bindValue(':price', (float)$price);
        $stmt->execute();
        header('Location: services.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Layanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <?php include __DIR__ . '/../includes/navbar.php'; ?>
  <div class="d-flex">
    <aside class="sidebar-area">
      <?php include __DIR__ . '/../includes/sidebar.php'; ?>
    </aside>
    <main class="main-area">
      <div class="container-fluid">
        <h3>Tambah Layanan</h3>
        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger">
            <ul class="mb-0">
              <?php foreach ($errors as $err): ?><li><?php echo htmlspecialchars($err); ?></li><?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <form method="post" action="">
          <div class="mb-3">
            <label class="form-label">Judul</label>
            <input name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control"><?php echo htmlspecialchars($description); ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">URL Gambar</label>
            <input name="image_url" class="form-control" value="<?php echo htmlspecialchars($image_url); ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Harga</label>
            <input name="price" class="form-control" value="<?php echo htmlspecialchars($price); ?>" required>
          </div>
          <div class="d-flex gap-2">
            <button class="btn btn-velora" type="submit">Simpan</button>
            <a href="services.php" class="btn btn-secondary">Batal</a>
          </div>
        </form>
      </div>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
