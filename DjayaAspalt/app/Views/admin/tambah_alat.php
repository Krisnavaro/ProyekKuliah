<?= $this->extend('layout/admin_kosong') ?>
<?= $this->section('content') ?>
<h4 class="mb-4 fw-bold">Tambah Data Alat / Material Baru</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="<?= base_url('admin/alat/simpan') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <input type="hidden" name="mode" value="baru">

            <div class="mb-3">
                <label for="kategori" class="form-label fw-bold">Pilih Kategori</label>
                <select name="kategori" id="kategori" class="form-select" required>
                    <option value="Alat Berat">Alat Berat</option>
                    <option value="Material">Material</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="nama_alat" class="form-label">Nama Alat / Material</label>
                <input type="text" class="form-control" id="nama_alat" name="nama_alat" value="<?= old('nama_alat') ?>" required>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_alat" class="form-label">ID Alat / Material</label>
                    <input type="text" class="form-control" id="id_alat" name="id_alat" value="<?= old('id_alat') ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                     <label for="stok_alat" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok_alat" name="stok_alat" min="0" value="<?= old('stok_alat') ?>" required>
                </div>
            </div>
             <div class="mb-3">
                <label for="harga_sewa" class="form-label">Harga Sewa / Satuan (Rp)</label>
                <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" min="0" value="<?= old('harga_sewa') ?>" required>
            </div>
            <div class="mb-3">
                <label for="informasi_alat" class="form-label">Informasi</label>
                <textarea class="form-control" id="informasi_alat" name="informasi_alat" rows="4" required><?= old('informasi_alat') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="gambar_alat" class="form-label">Gambar</label>
                <input class="form-control" type="file" id="gambar_alat" name="gambar_alat">
            </div>
            <input type="hidden" name="cek_alat" value="Tersedia">
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('admin/alat') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>