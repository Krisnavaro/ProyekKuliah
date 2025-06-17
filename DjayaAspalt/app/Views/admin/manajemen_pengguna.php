<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Manajemen Klien</h2>
    </div>

    <div class="admin-table p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold">Daftar Semua Klien</h4>
            <div>
                <a href="<?= base_url('admin/pelanggan/tambah') ?>" class="btn btn-sm btn-success btn-table">
                    <img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Tambahkan"> Tambahkan
                </a>
            </div>
        </div>
        
        <?php if (!empty($pelanggan_list)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pelanggan_list as $pelanggan): ?>
                        <tr>
                            <td><?= esc($pelanggan['id']) ?></td>
                            <td><?= esc($pelanggan['nama_lengkap']) ?></td>
                            <td><?= esc($pelanggan['username']) ?></td>
                            <td><?= esc($pelanggan['email']) ?></td>
                            <td>
                                <a href="<?= base_url('admin/pelanggan/edit/' . $pelanggan['id']) ?>" class="btn btn-sm btn-warning btn-table">Edit</a>
                                
                                <a href="<?= base_url('admin/pelanggan/hapus/' . $pelanggan['id']) ?>" class="btn btn-sm btn-danger btn-table" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center mt-5">
                <h4 class="text-danger mt-3 fw-bold">Belum Ada Data Klien</h4>
                <p>Silakan tambahkan data klien baru melalui tombol "Tambahkan".</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>