<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
require_once __DIR__ . '/../config/database.php';

// fetch bookings (assume admin may delete table; do not auto-create it)
try{
  $stmt = $pdo->query('SELECT * FROM bookings ORDER BY id DESC');
  $bookings = $stmt->fetchAll();
} catch(Exception $e){
  // If table doesn't exist or other DB error, show empty list without recreating table
  $bookings = [];
  $err = $e->getMessage();
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Bookings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
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
          <h3>Manajemen Booking</h3>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="bookingsTable" class="table table-striped table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Motor</th>
                    <th>Layanan</th>
                    <th>Tanggal Booking</th>
                    <th>Created At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($bookings)): ?>
                    <tr>
                      <td class="text-center">-</td>
                      <td class="text-center">-</td>
                      <td class="text-center">-</td>
                      <td class="text-center">-</td>
                      <td class="text-center">-</td>
                      <td class="text-center">-</td>
                    </tr>
                  <?php else: foreach($bookings as $b): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($b['id']); ?></td>
                      <td><?php echo htmlspecialchars($b['customer_name']); ?></td>
                      <td><?php echo htmlspecialchars($b['motor_type']); ?></td>
                      <td><?php echo htmlspecialchars($b['service']); ?></td>
                      <td><?php echo htmlspecialchars($b['booking_date']); ?></td>
                      <td><?php echo htmlspecialchars($b['created_at']); ?></td>
                    </tr>
                  <?php endforeach; endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function(){ $('#bookingsTable').DataTable({ responsive:true, order:[[0,'desc']] }); });
  </script>
</body>
</html>
