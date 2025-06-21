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
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/pelanggan/simpan') ?>" method="post">
            <?= csrf_field() ?>
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
                <label for="lokasi_survey" class="form-label">Lokasi Survey / Pengiriman</label>
                <textarea class="form-control" id="lokasi_survey" name="lokasi_survey" rows="3" required><?= old('lokasi_survey') ?></textarea>
            </div>
            <hr>
            <p class="text-muted">Isi ID di bawah ini jika ada (opsional).</p>
            <div class="mb-3">
                <label for="id_survey" class="form-label">ID Survey</label>
                <input type="text" class="form-control" id="id_survey" name="id_survey" value="<?= old('id_survey') ?>">
            </div>
            <div class="mb-3">
                <label for="id_namasewa" class="form-label">ID Nama Sewa</label>
                <input type="text" class="form-control" id="id_namasewa" name="id_namasewa" value="<?= old('id_namasewa') ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Pelanggan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>