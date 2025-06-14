<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Cek Stok</h2>
    </div>

    <div class="row justify-content-center">
        <?php foreach ($materials as $material): ?>
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="admin-card h-100">
                <img src="<?= base_url('assets/' . $material['image']) ?>" alt="<?= $material['nama'] ?>">
                <h5 class="fw-bold"><?= $material['nama'] ?></h5>
                <p>Stok: <?= $material['stok'] ?></p>
                <div class="mt-3">
                    <button class="btn btn-success btn-sm me-2">Tambahkan</button>
                    <button class="btn btn-warning btn-sm">Edit</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>