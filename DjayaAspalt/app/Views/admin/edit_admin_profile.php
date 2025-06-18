<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="<?= base_url('admin/profile') ?>" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Edit Profil Admin</h2>
    </div>

    <div class="card p-4 shadow-sm">
        <form action="<?= base_url('admin/profile/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row mb-4 align-items-center">
                <div class="col-md-3 text-center">
                    <img src="<?= session()->get('foto_profil') ? base_url('uploads/avatars/' . session()->get('foto_profil')) : base_url('assets/admin_profile_pic.png') ?>" class="img-fluid rounded-circle mb-2" alt="Admin Avatar" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                <div class="col-md-9">
                     <label for="foto_profil" class="form-label">Ubah Foto Profil</label>
                     <input type="file" class="form-control" name="foto_profil" id="foto_profil">
                     <small class="text-muted">Pilih file gambar (jpg, png, jpeg). Ukuran maks 1MB.</small>
                </div>
            </div>
            <hr>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" value="<?= esc(session()->get('username')) ?>" disabled>
                <small class="text-muted">Username tidak dapat diubah.</small>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value="<?= esc(session()->get('email')) ?>" disabled>
                <small class="text-muted">Email tidak dapat diubah.</small>
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= esc(session()->get('nama_lengkap')) ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>