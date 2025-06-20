<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Edit Data Pelanggan</h2>
    </div>

    <div class="card shadow-sm p-4">
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/pelanggan/update') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id_pelanggan_lama" value="<?= esc($pelanggan['id_pelanggan']) ?>">

            <div class="mb-3">
                <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= esc($pelanggan['id_pelanggan']) ?>" readonly>
                <small class="form-text text-muted">ID Pelanggan dibuat otomatis dan tidak bisa diubah.</small>
            </div>
            <div class="mb-3">
                <label for="id_survey" class="form-label">ID Survey</label>
                <input type="text" class="form-control" id="id_survey" name="id_survey" value="<?= old('id_survey', $pelanggan['id_survey']) ?>">
                <small class="form-text text-muted">ID Survey dapat diisi manual jika diperlukan, atau akan kosong jika tidak ada survey.</small>
            </div>
            
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap', $pelanggan['nama_lengkap']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_telpon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="<?= old('no_telpon', $pelanggan['no_telpon']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_survey" class="form-label">Tanggal Survey</label>
                <input type="date" class="form-control" id="tanggal_survey" name="tanggal_survey" value="<?= old('tanggal_survey', $pelanggan['tanggal_survey']) ?>">
            </div>
            <div class="mb-3">
                <label for="lokasi_survey" class="form-label">Lokasi Survey/Pengiriman</label>
                <textarea class="form-control" id="lokasi_survey" name="lokasi_survey" rows="3"><?= old('lokasi_survey', $pelanggan['lokasi_survey']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="id_namasewa" class="form-label">ID Nama Sewa</label>
                <input type="text" class="form-control" id="id_namasewa" name="id_namasewa" value="<?= old('id_namasewa', $pelanggan['id_namasewa']) ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update Pelanggan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>