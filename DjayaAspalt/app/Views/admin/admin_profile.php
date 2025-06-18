<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Informasi Akun Admin</h2>
    </div>

    <div class="card p-4 shadow-sm">
        <div class="row">
            <div class="col-md-3 text-center">
                
                <img src="<?= $foto_profil ? base_url('uploads/avatars/' . $foto_profil) : base_url('assets/admin_profile_pic.png') ?>" class="img-fluid rounded-circle mb-3" alt="Admin Avatar" style="width: 180px; height: 180px; object-fit: cover;">
                
            </div>
            <div class="col-md-9">
                <h4 class="fw-bold"><?= esc($nama_lengkap) ?></h4>
                <p class="text-muted"><?= esc(ucfirst($role)) ?></p>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <strong>Username:</strong>
                        <p><?= esc($username) ?></p>
                    </div>
                    <div class="col-6">
                        <strong>Email:</strong>
                        <p><?= esc($email) ?></p>
                    </div>
                </div>
                <a href="<?= base_url('admin/profile/edit') ?>" class="btn btn-primary mt-3">Edit Profile</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>