<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Detail Data Pelanggan (Survey/Sewa)</h2>
    </div>

    <div class="admin-table p-4 mb-4">
        <h4 class="mb-3 fw-bold">Detail Informasi Pelanggan</h4>

        <?php if (!empty($pelanggan_data)): ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>ID Pelanggan:</strong>
                    <p><?= esc($pelanggan_data['id_pelanggan']) ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>ID Survey:</strong>
                    <p><?= esc($pelanggan_data['id_survey']) ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>ID Nama Sewa:</strong>
                    <p><?= esc($pelanggan_data['id_namasewa']) ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>Nama Lengkap:</strong>
                    <p><?= esc($pelanggan_data['nama_lengkap']) ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>No. Telepon:</strong>
                    <p><?= esc($pelanggan_data['no_telpon']) ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>Tanggal Survey:</strong>
                    <p><?= esc($pelanggan_data['tanggal_survey']) ?></p>
                </div>
                <div class="col-12 mb-3">
                    <strong>Lokasi Survey/Pengiriman:</strong>
                    <p><?= esc($pelanggan_data['lokasi_survey']) ?></p>
                </div>
            </div>
            <a href="<?= base_url('admin/manajemen-pelanggan-survey/edit/' . esc($pelanggan_data['id_pelanggan'])) ?>" class="btn btn-warning">Edit</a>
            <a href="<?= base_url('admin/manajemen-pelanggan-survey') ?>" class="btn btn-secondary">Kembali ke Daftar</a>
        <?php else: ?>
            <div class="alert alert-warning text-center">Data pelanggan tidak ditemukan.</div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>