<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Tambah Data Pelanggan (Survey/Sewa)</h2>
    </div>

    <div class="admin-table p-4 mb-4">
        <h4 class="mb-3 fw-bold">Form Tambah Pelanggan</h4>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/manajemen-pelanggan-survey/simpan') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= old('id_pelanggan') ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_survey" class="form-label">ID Survey</label>
                <input type="text" class="form-control" id="id_survey" name="id_survey" value="<?= old('id_survey') ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_namasewa" class="form-label">ID Nama Sewa</label>
                <input type="text" class="form-control" id="id_namasewa" name="id_namasewa" value="<?= old('id_namasewa') ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_telpon" class="form-label">No. Telepon</label>
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
            
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="<?= base_url('admin/manajemen-pelanggan-survey') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>