<?= $this->extend('layout/admin_kosong') ?>

<?= $this->section('content') ?>

<style>
    .card-revisi { border-radius: 15px; background-color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.05); border: none; }
    .card-header { background-color: #ff9933; color: black; font-weight: bold; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; border-top-left-radius: 15px; border-top-right-radius: 15px; }
    .card-header .btn-sm { margin-left: 5px; }
    .table thead th { background-color: #343a40; color: white; text-align: center; font-weight: 600; vertical-align: middle; }
    .table tbody td { text-align: center; vertical-align: middle; }
    .info-alat { max-width: 300px; white-space: normal; text-align: left !important; }
    .action-buttons a { margin: 0 3px; }
    .action-buttons img { width: 20px; height: 20px; }
    .empty-state { padding: 4rem; text-align: center; }
    .empty-state img { max-width: 150px; margin-bottom: 1.5rem; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0"><?= esc($page_title) ?></h4>
    <a href="#" class="btn btn-success">Tambahkan Alat</a>
</div>

<div class="card card-revisi">
    <div class="card-header">
        <span>Daftar Semua Alat</span>
        <div>
            <a href="#" class="btn btn-light btn-sm">Cari</a>
            <a href="#" class="btn btn-dark btn-sm">View</a>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped mb-0">
            <thead>
                <tr>
                    <th>ID Alat</th>
                    <th>Cek Alat</th>
                    <th>Nama Alat</th>
                    <th>Stok</th>
                    <th>Informasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($alat_list)): ?>
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
                                <h5 class="text-danger">Tidak Ada Data Alat</h5>
                                <p>Silakan tambahkan data alat baru.</p>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($alat_list as $item): ?>
                        <tr>
                            <td><?= esc($item['id_alat']) ?></td>
                            <td>
                                <?php if ($item['stok_alat'] > 0): ?>
                                    <span class="badge bg-success">Tersedia</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Habis</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($item['nama_alat']) ?></td>
                            <td><?= esc($item['stok_alat']) ?></td>
                            <td class="info-alat"><?= esc($item['informasi_alat']) ?></td>
                            <td class="action-buttons">
                                <a href="#" class="btn btn-dark btn-sm" title="Lihat"><img src="<?= base_url('assets/view_icon.png') ?>" alt="View"></a>
                                <a href="#" class="btn btn-warning btn-sm" title="Edit"><img src="<?= base_url('assets/edit_icon.png') ?>" alt="Edit"></a>
                                <a href="#" class="btn btn-danger btn-sm" title="Hapus"><img src="<?= base_url('assets/delete_icon.png') ?>" alt="Delete"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>