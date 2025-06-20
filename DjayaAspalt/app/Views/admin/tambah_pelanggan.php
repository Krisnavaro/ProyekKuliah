<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Tambah Data Pelanggan</h2>
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

        <form action="<?= base_url('admin/pelanggan/simpan') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_telpon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="<?= old('no_telpon') ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_survey" class="form-label">Tanggal Survey</label>
                <input type="date" class="form-control" id="tanggal_survey" name="tanggal_survey" value="<?= old('tanggal_survey') ?>" required>
            </div>
            <div class="mb-3">
                <label for="lokasi_survey" class="form-label">Lokasi Survey/Pengiriman</label>
                <textarea class="form-control" id="lokasi_survey" name="lokasi_survey" rows="3" required><?= old('lokasi_survey') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="id_namasewa" class="form-label">ID Nama Sewa (Opsional)</label>
                <input type="text" class="form-control" id="id_namasewa" name="id_namasewa" value="<?= old('id_namasewa') ?>">
                <small class="form-text text-muted">Isi ini jika pelanggan ini terkait dengan nama sewa tertentu. Kosongkan jika tidak ada.</small>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Pelanggan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>