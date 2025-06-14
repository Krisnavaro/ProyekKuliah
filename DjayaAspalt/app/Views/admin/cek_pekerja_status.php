<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Cek Pekerja</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <div class="admin-card h-100">
                <img src="<?= base_url('assets/pekerja_sedang_bekerja.png') ?>" alt="Pekerja Sedang Bekerja" style="max-width: 150px;">
                <h5 class="fw-bold">Pekerja <span class="text-success">Sedang Bekerja</span></h5>
                <p>Pekerja: <?= $pekerja_sedang_bekerja ?> Orang</p>
                <div class="mt-3">
                    <a href="<?= base_url('admin/cek-pekerja-detail/bekerja') ?>" class="btn btn-info btn-sm me-2">Cek</a>
                    <button class="btn btn-success btn-sm me-2">Tambahkan</button>
                    <button class="btn btn-warning btn-sm">Edit</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="admin-card h-100">
                <img src="<?= base_url('assets/pekerja_tidak_bekerja.png') ?>" alt="Pekerja Tidak Bekerja" style="max-width: 150px;">
                <h5 class="fw-bold">Pekerja <span class="text-danger">Tidak Bekerja</span></h5>
                <p>Pekerja: <?= $pekerja_tidak_bekerja ?> Orang</p>
                <div class="mt-3">
                    <a href="<?= base_url('admin/cek-pekerja-detail/tidak-bekerja') ?>" class="btn btn-info btn-sm me-2">Cek</a>
                    <button class="btn btn-success btn-sm me-2">Tambahkan</button>
                    <button class="btn btn-warning btn-sm">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>