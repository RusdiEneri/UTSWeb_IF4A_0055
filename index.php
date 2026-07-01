<?php
// Public homepage with dynamic services from DB
session_start();
require_once __DIR__ . '/config/database.php';
$isAdmin = !empty($_SESSION['admin_id']);
try {
  $stmt = $pdo->query('SELECT * FROM services ORDER BY id DESC');
  $services = $stmt->fetchAll();
} catch (Exception $e) {
  $services = [];
  $servicesError = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta
    name="description"
    content="Velora MotoCare adalah layanan detailing, perawatan, dan inspeksi motor harian berbasis website interaktif."
  >
  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >

  <!-- Bootstrap Icons -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    rel="stylesheet"
  >
  <!-- CSS Local -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="assets/css/animations.css">
  <link rel="stylesheet" href="assets/css/landing.css">
  <title>Velora MotoCare | Perawatan dan Detailing Motor Harian</title>
  <link rel="icon" type="image/x-icon" href="./assets/icons.png">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top main-navbar"> 
    <div class="container">
      <a class="navbar-brand fw-bold" href="#hero">
        <i class class ="bi bi-speedometer2 me-2"></i>
         Velora MotoCare
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarMenu"
        aria-controls="navbarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#problem">Masalah</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Layanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#packages">Paket</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#estimator">Estimator</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#checklist">Checklist</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#booking">Booking</a>
          </li>
          <?php if ($isAdmin): ?>
            <li class="nav-item">
              <a class="nav-link" href="admin/index.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link btn btn-primary-custom text-white ms-2" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
    </div>
    </div>
  </nav>
  <main>
    <!-- ===== SECTION: Hero ===== -->
     <section id="hero" class="hero-section section-padding">
      <div class="container">
        <div class="row align-items-center min-vh-100">
          <div class="col-lg-6">
            <span class="section-badge">Detailing • Perawatan • Inspeksi</span>

            <h1 class="hero-title mt-3">
  Bikin Motormu, <span id="typing-text"></span>
</h1>

            <p class="hero-description mt-3">
              Velora MotoCare membantu pengguna motor harian untuk menjaga performa,
              kenyamanan, dan tampilan motor melalui layanan servis ringan,
              detailing, serta inspeksi berkala.
            </p>

            <div class="hero-actions mt-4">
              <a href="#estimator" class="btn btn-primary-custom me-2">
                Cek Paket Servis
              </a>
              <a href="#services" class="btn btn-outline-light">
                Lihat Layanan
              </a>
            </div>
          </div>

          <div class="col-lg-6 mt-5 mt-lg-0">
            <div class="hero-card">
              <i class="bi bi-tools hero-icon"></i>
              <h3>Inspeksi Motor Harian</h3>
              <p>
                Cek oli, rem, ban, aki, lampu, CVT, dan kondisi tarikan motor
                sebelum masalah kecil jadi biaya besar.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== SECTION: Masalah Pengguna Motor Harian ===== -->
    <section id="problem" class="section-padding bg-light-custom">
      <div class="container">
        <div class="section-heading text-center">
          <span class="section-badge">Masalah Harian</span>
          <h2>Motor yang Sering <span>Diabaikan</span></h2>
          <p>
            Banyak pengguna motor baru sadar saat motor sudah berat, boros,
            atau tidak nyaman digunakan.
          </p>
        </div>

        <div class="row g-4 mt-4">
          <div class="col-md-6 col-lg-3">
            <div class="info-card">
              <i class="bi bi-exclamation-triangle"></i>
              <h5>Tarikan Berat</h5>
              <p>Motor terasa ngeden saat digas karena CVT, filter, atau busi kurang optimal.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="info-card">
              <i class="bi bi-droplet-half"></i>
              <h5>Oli Telat Ganti</h5>
              <p>Oli yang terlalu lama dipakai bisa membuat mesin lebih panas dan kasar.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="info-card">
              <i class="bi bi-disc"></i>
              <h5>Rem Kurang Pakem</h5>
              <p>Kampas rem, minyak rem, atau setelan rem perlu dicek secara berkala.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="info-card">
              <i class="bi bi-lightning-charge"></i>
              <h5>Aki Melemah</h5>
              <p>Aki lemah bisa membuat starter, lampu, dan kelistrikan tidak stabil.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== SECTION: Tentang Velora MotoCare ===== -->
    <section id="about" class="section-padding">
      <div class="container">
        <div class="row align-items-center g-5">
          <div class="section-heading col-lg-6">
            <span class="section-badge">Tentang Kami</span>
            <h2>Perawatan Motor yang <span>Lebih Terarah</span></h2>
            <p>
              Velora MotoCare adalah layanan perawatan dan detailing motor harian
              yang berfokus pada kebutuhan pengguna motor matic, bebek, dan sport
              untuk aktivitas harian.
            </p>
            <p>
              Kami tidak hanya membersihkan motor, tetapi juga membantu pengguna
              memahami kondisi motor melalui inspeksi ringan dan rekomendasi
              servis yang mudah dipahami.
            </p>
          </div>

          <div class="col-lg-6">
  <div class="about-highlight">
    <div>
      <h3 class="counter" data-target="3" data-suffix="+">0</h3>
      <p>Paket Perawatan</p>
    </div>
    <div>
      <h3 class="counter" data-target="6">0</h3>
      <p>Checklist Motor</p>
    </div>
    <div>
      <h3 class="counter" data-target="12" data-suffix="K">0</h3>
      <p>Rekomendasi KM</p>
    </div>
  </div>
</div>
        </div>
      </div>
    </section>
    
    <!-- ===== SECTION: Layanan Utama ===== -->
    <section id="services" class="section-padding bg-light-custom">
      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="section-heading text-center" style="flex:1">
            <span class="section-badge">Layanan</span>
            <h2>Layanan Utama <span>Velora MotoCare</span></h2>
            <p>
              Pilih layanan sesuai kebutuhan motor harianmu.
            </p>
          </div>
          <div class="ms-3">
            <?php if ($isAdmin): ?>
              <a href="admin/service_add.php" class="btn btn-primary-custom">Tambah Layanan</a>
            <?php endif; ?>
          </div>
        </div>

        <div class="filter-buttons text-center mt-4">
          <button class="btn btn-filter active" data-filter="all">Semua</button>
          <button class="btn btn-filter" data-filter="mesin">Mesin</button>
          <button class="btn btn-filter" data-filter="cvt">CVT</button>
          <button class="btn btn-filter" data-filter="kelistrikan">Kelistrikan</button>
          <button class="btn btn-filter" data-filter="detailing">Body Detailing</button>
          <button class="btn btn-filter" data-filter="safety">Safety Check</button>
        </div>

        <div class="row g-4 mt-4" id="serviceList">
          <?php if (!empty($servicesError)): ?>
            <div class="col-12"><div class="alert alert-danger"><?php echo htmlspecialchars($servicesError); ?></div></div>
          <?php endif; ?>

          <?php if (empty($services)): ?>
            <div class="col-12">
              <div class="service-card">Belum ada layanan tersedia.</div>
            </div>
          <?php else: ?>
            <?php foreach ($services as $row): ?>
              <div class="col-md-6 col-lg-4 service-item" data-category="all">
                <div class="service-card">
                  <?php if (!empty($row['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="img-fluid mb-3" style="border-radius:12px;max-height:160px;object-fit:cover;">
                  <?php endif; ?>
                  <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                  <p><?php echo htmlspecialchars($row['description']); ?></p>
                  <p class="fw-bold">Rp <?php echo number_format($row['price'],2,',','.'); ?></p>
                  <?php if ($isAdmin): ?>
                    <div class="mt-2">
                      <a href="admin/service_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                      <a href="admin/service_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus layanan ini?');">Delete</a>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

     <!-- ===== SECTION: Paket Perawatan ===== -->
    <section id="packages" class="section-padding">
      <div class="container">
        <div class="section-heading text-center">
          <span class="section-badge">Paket</span>
          <h2>Paket Perawatan <span>Motor</span></h2>
          <p>
            Paket dibuat agar pengguna motor tidak bingung memilih layanan.
          </p>
        </div>

        <div class="row g-4 mt-4">
  <div class="col-md-4">
    <div class="pricing-card">
      <h5>Basic</h5>
      <h3 class="price-title">Rp<span class="price-counter" data-target="35000">0</span></h3>
      <p>Cocok untuk pengecekan ringan.</p>
      <ul>
        <li>Cek oli</li>
        <li>Cek ban</li>
        <li>Cek rem</li>
      </ul>
    </div>
  </div>

  <div class="col-md-4">
    <div class="pricing-card featured">
      <h5>Daily Care</h5>
      <h3 class="price-title">Rp<span class="price-counter" data-target="85000">0</span></h3>
      <p>Cocok untuk motor harian aktif.</p>
      <ul>
        <li>Servis ringan</li>
        <li>Cek CVT</li>
        <li>Cek aki</li>
      </ul>
    </div>
  </div>

  <div class="col-md-4">
    <div class="pricing-card">
      <h5>Full Checkup</h5>
      <h3 class="price-title">Rp<span class="price-counter" data-target="150000">0</span></h3>
      <p>Cocok untuk pengecekan menyeluruh.</p>
      <ul>
        <li>Servis CVT</li>
        <li>Detailing body</li>
        <li>Safety check</li>
      </ul>
    </div>
  </div>
</div>
        </div>
      </div>
    </section>

    <!-- ===== SECTION: Simulasi Estimasi Biaya ===== -->
    <section id="estimator" class="section-padding">
      <div class="container">
        <div class="section-heading text-center">
          <span class="section-badge">Estimator</span>
          <h2>Simulasi Estimasi <span>Biaya Servis</span></h2>
          <p>
            Pilih jenis motor dan layanan untuk melihat estimasi awal.
          </p>
        </div>

        <div class="row justify-content-center mt-4">
          <div class="col-lg-8">
            <div class="estimator-box">
              <form id="estimatorForm">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="motorType" class="form-label">Jenis Motor</label>
                    <select id="motorType" class="form-select">
                      <option value="">Pilih jenis motor</option>
                      <option value="matic">Matic</option>
                      <option value="bebek">Bebek</option>
                      <option value="sport">Sport</option>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="mainService" class="form-label">Layanan Utama</label>
                    <select id="mainService" class="form-select">
                      <option value="">Pilih layanan</option>
                      <option value="ganti-oli">Ganti Oli</option>
                      <option value="servis-cvt">Servis CVT</option>
                      <option value="detailing">Detailing Body</option>
                      <option value="full-checkup">Full Checkup</option>
                    </select>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Tambahan</label>

                    <div class="form-check">
                      <input class="form-check-input additional-service" type="checkbox" value="cek-aki" id="cekAki">
                      <label class="form-check-label" for="cekAki">Cek Aki</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input additional-service" type="checkbox" value="cek-rem" id="cekRem">
                      <label class="form-check-label" for="cekRem">Cek Rem</label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input additional-service" type="checkbox" value="cek-ban" id="cekBan">
                      <label class="form-check-label" for="cekBan">Cek Ban</label>
                    </div>
                  </div>

                  <div class="col-12">
                    <button type="submit" class="btn btn-primary-custom">
                      Hitung Estimasi
                    </button>
                  </div>
                </div>
              </form>

              <div id="estimatorResult" class="result-box mt-4">
                Estimasi biaya akan muncul di sini.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== SECTION: Checklist Motor Sehat ===== -->
    <section id="checklist" class="section-padding bg-light-custom">
      <div class="container">
        <div class="section-heading text-center">
          <span class="section-badge">Checklist</span>
          <h2>Checklist Motormu <span>Sekarang!</span></h2>
          <p>
            Centang kondisi motor saat ini untuk melihat status sederhana.
          </p>
        </div>

        <div class="row justify-content-center mt-4">
          <div class="col-lg-8">
            <div class="checklist-box">
              <div class="row g-3">
                <div class="col-md-6">
                  <input class="form-check-input health-check" type="checkbox" id="oliCheck">
                  <label for="oliCheck">Oli sudah diganti</label>
                </div>

                <div class="col-md-6">
                  <input class="form-check-input health-check" type="checkbox" id="remCheck">
                  <label for="remCheck">Rem pakem</label>
                </div>

                <div class="col-md-6">
                  <input class="form-check-input health-check" type="checkbox" id="banCheck">
                  <label for="banCheck">Ban tidak gundul</label>
                </div>

                <div class="col-md-6">
                  <input class="form-check-input health-check" type="checkbox" id="lampuCheck">
                  <label for="lampuCheck">Lampu normal</label>
                </div>

                <div class="col-md-6">
                  <input class="form-check-input health-check" type="checkbox" id="akiCheck">
                  <label for="akiCheck">Aki kuat</label>
                </div>

                <div class="col-md-6">
                  <input class="form-check-input health-check" type="checkbox" id="tarikanCheck">
                  <label for="tarikanCheck">Tarikan halus</label>
                </div>
              </div>

              <div id="healthResult" class="result-box mt-4">
                Status motor akan muncul setelah checklist diisi.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== SECTION: Galeri Before After ===== -->
    <section id="gallery" class="section-padding">
      <div class="container">
        <div class="section-heading text-center">
          <span class="section-badge">Galeri</span>
          <h2>Galeri Proses <span>Pengerjaan</span></h2>
          <p>
            Hasil perawatan dan detailing motor harian.
          </p>
        </div>

        <div class="row g-4 mt-4">
          <div class="col-md-4">
            <div class="gallery-card">
              <div class="gallery-placeholder">
                <img src="./assets/detailing.jpg" alt="Proses Detailing Body Matic" class="img-fluid">
              </div>
              <h5>Detailing Body Matic</h5>
            </div>
          </div>

          <div class="col-md-4">
            <div class="gallery-card">
              <div class="gallery-placeholder">
                <img src="./assets/pembersihanCVT.jpg" alt="Proses Pembersihan Area CVT" class="img-fluid">
              </div>
              <h5>Pembersihan Area CVT</h5>
            </div>
          </div>

          <div class="col-md-4">
            <div class="gallery-card">
              <div class="gallery-placeholder">
                <img src="./assets/checkUP.jpg" alt="Proses Full Checkup Motor Harian" class="img-fluid">
              </div>
              <h5>Full Checkup Harian</h5>
            </div>
          </div>
        </div>
      </div>
    </section>

     <!-- ===== SECTION: Testimoni Pelanggan ===== -->
    <section id="testimonials" class="section-padding bg-light-custom">
      <div class="container">
        <div class="section-heading text-center">
          <span class="section-badge">Testimoni</span>
          <h2>Ulasan <span>Pelanggan</span></h2>
          <p>
            Berberapa masukan dari pengguna motor harian setelah memakai layanan dari Velora MotoCare.
          </p>
        </div>

        <div class="row g-4 mt-4">
          <div class="col-md-4">
            <div class="testimonial-card">
              <p>“Motor jadi lebih enteng dan saya jadi tahu bagian mana yang harus dicek secara rutin di website ini.”</p>
              <h6>Raka</h6>
              <span>Pengguna motor matic</span>
            </div>
          </div>

          <div class="col-md-4">
            <div class="testimonial-card">
              <p>“Estimator biayanya sangat membantu sebelum membooking servis ke bengkel terdekat.”</p>
              <h6>Dina</h6>
              <span>Mahasiswa</span>
            </div>
          </div>

          <div class="col-md-4">
            <div class="testimonial-card">
              <p>“Checklist motornya sederhana tetapi sangat amat berguna untuk pengguna harian seperti Saya.”</p>
              <h6>Fajar</h6>
              <span>Pekerja harian</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== SECTION: Kontak & Booking Servis ===== -->
    <section id="booking" class="section-padding bg-dark-custom text-white">
      <div class="container">
        <div class="section-heading text-center">
          <span class="section-badge">Booking</span>
          <h2>Kontak & <span>Booking Servis</span></h2>
          <p>
            Isi data berikut untuk simulasi booking layanan Velora MotoCare.
          </p>
        </div>

        <div class="row justify-content-center mt-4">
          <div class="col-lg-8">
            <form id="bookingForm" class="booking-form" action="#" method="post">
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="customerName" class="form-label">Nama</label>
                  <input type="text" id="customerName" name="customer_name" class="form-control" placeholder="Masukkan nama">
                </div>

                <div class="col-md-6">
                  <label for="bookingMotor" class="form-label">Jenis Motor</label>
                  <input type="text" id="bookingMotor" name="motor_type" class="form-control" placeholder="Contoh: Honda BeAT">
                </div>

                <div class="col-md-6">
                  <label for="bookingService" class="form-label">Layanan</label>
                  <select id="bookingService" name="service" class="form-select">
                    <option value="">Pilih layanan</option>
                    <option value="Servis Ringan">Servis Ringan</option>
                    <option value="Servis CVT">Servis CVT</option>
                    <option value="Detailing Body">Detailing Body</option>
                    <option value="Full Checkup">Full Checkup</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="bookingDate" class="form-label">Tanggal Booking</label>
                  <input type="date" id="bookingDate" name="booking_date" class="form-control">
                </div>

                <div class="col-12">
                  <button type="submit" class="btn btn-primary-custom">
                    Kirim Booking
                  </button>
                </div>
              </div>
            </form>

            <div id="bookingResult" class="result-box mt-4">
              Data booking akan muncul di sini.
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

    <!-- footer and scripts copied from original -->
  <footer class="footer">
    <div class="container text-center">
      <p class="mb-1">&copy; 2026 Velora MotoCare. All Rights Reserved.</p>
      <p class="mb-0">Website company profile | Velora MotoCare</p>
    </div>
  </footer>

  <!-- jQuery CDN (full build for AJAX) -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap 5 JS Bundle -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
  </script>

  <!-- AOS for scroll animations -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="assets/js/main.js"></script>

  <!-- Custom JavaScript -->
  <script src="script.js"></script>

</body>
</html>
