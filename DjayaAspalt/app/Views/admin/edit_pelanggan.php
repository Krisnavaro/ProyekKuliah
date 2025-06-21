<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('admin/pelanggan') ?>" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Edit Data Pelanggan</h2>
    </div>

    <div class="card p-4 shadow-sm">
        <form action="<?= base_url('admin/pelanggan/update') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id_pelanggan" value="<?= esc($pelanggan['id_pelanggan']) ?>">

            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= esc($pelanggan['nama_lengkap']) ?>">
            </div>
             <div class="mb-3">
                <label for="no_telpon" class="form-label">No Telpon</label>
                <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="<?= esc($pelanggan['no_telpon']) ?>">
            </div>
             <div class="mb-3">
                <label for="tanggal_survey" class="form-label">Tanggal Survey</label>
                <input type="date" class="form-control" id="tanggal_survey" name="tanggal_survey" value="<?= esc($pelanggan['tanggal_survey']) ?>">
            </div>
            <div class="mb-3">
                <label for="lokasi_survey" class="form-label">Lokasi Survey</label>
                <textarea class="form-control" id="lokasi_survey" name="lokasi_survey" rows="3"><?= esc($pelanggan['lokasi_survey']) ?></textarea>
            </div>
             <div class="mb-3">
                <label for="id_survey" class="form-label">ID Survey</label>
                <input type="text" class="form-control" id="id_survey" name="id_survey" value="<?= esc($pelanggan['id_survey']) ?>">
            </div>
             <div class="mb-3">
                <label for="id_namasewa" class="form-label">ID Nama Sewa</label>
                <input type="text" class="form-control" id="id_namasewa" name="id_namasewa" value="<?= esc($pelanggan['id_namasewa']) ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
