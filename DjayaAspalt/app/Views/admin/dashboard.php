<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner rounded">
    <div class="carousel-item active">
      <img src="<?= base_url('assets/banner1.png') ?>" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('assets/banner2.png') ?>" class="d-block w-100" alt="Banner 2">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('assets/banner3.png') ?>" class="d-block w-100" alt="Banner 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="card p-4 shadow-sm" style="background-color: #ffe0b2;">
    <h4 class="fw-bold">Catatan untuk admin:</h4>
    <ol>
        <li>Pastikan semua pesanan pelanggan diproses tepat waktu.</li>
        <li>Periksa ketersediaan alat penyewaan sebelum mengkonfirmasi pemesanan.</li>
        <li>Pantau pembayaran yang masuk dan segera konfirmasi kepada pelanggan.</li>
        <li>Pastikan pengembalian alat dilakukan sesuai jadwal dan dalam kondisi baik.</li>
        <li>Update informasi pelanggan secara berkala untuk menjaga data tetap akurat.</li>
    </ol>
</div>

<?= $this->endSection() ?>