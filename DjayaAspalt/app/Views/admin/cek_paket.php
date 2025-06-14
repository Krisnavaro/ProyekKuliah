<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Cek Paket</h2>
    </div>

    <div class="row justify-content-center">
        <?php foreach ($paket as $p): ?>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="admin-card h-100">
                <h4 class="card-title fw-bold">Paket <?= $p['nama'] ?> <br>Rp <?= $p['harga'] ?>:</h4>
                <ul class="list-unstyled text-start mt-3">
                    <?php foreach ($p['layanan'] as $layanan): ?>
                        <li><?= $layanan ?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="mt-3">
                    <button class="btn btn-success btn-sm me-2">Tambahkan</button>
                    <button class="btn btn-warning btn-sm">Edit</button>
                </div>
                <p class="mt-3 fw-bold text-success"><?= $p['status_stok'] ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-4">
        <a href="<?= base_url('admin/cek-stok-full') ?>" class="btn btn-dark">Cek Stok Full</a>
    </div>
</div>

<?= $this->endSection() ?>