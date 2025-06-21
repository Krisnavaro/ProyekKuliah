<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('admin/pelanggan') ?>" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Tambah Data Pelanggan Aktif</h2>
    </div>

    <div class="card p-4 shadow-sm">
        <form action="<?= base_url('admin/pelanggan/simpan') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label class="form-label fw-bold">Pilih Jenis Transaksi</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_transaksi" id="jenis_survey" value="survey" checked>
                    <label class="form-check-label" for="jenis_survey">Ini adalah transaksi Survey</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_transaksi" id="jenis_sewa" value="sewa">
                    <label class="form-check-label" for="jenis_sewa">Ini adalah transaksi Sewa</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
            </div>
             <div class="mb-3">
                <label for="no_telpon" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" id="no_telpon" name="no_telpon" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_survey" class="form-label">Tanggal Transaksi (Survey/Sewa)</label>
                <input type="date" class="form-control" id="tanggal_survey" name="tanggal_survey" required>
            </div>
            <div class="mb-3">
                <label for="lokasi_survey" class="form-label">Lokasi (Survey/Pengiriman)</label>
                <textarea class="form-control" id="lokasi_survey" name="lokasi_survey" rows="3" required></textarea>
            </div>
            <hr>
            <p class="text-muted">ID Pelanggan, ID Survey, dan ID Nama Sewa akan dibuat secara otomatis oleh sistem.</p>
            
            <button type="submit" class="btn btn-primary">Simpan Pelanggan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>