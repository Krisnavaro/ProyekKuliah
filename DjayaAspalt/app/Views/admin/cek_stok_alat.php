<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Data Stok Alat</h2>
    </div>

    <div class="admin-table p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold">Daftar Semua Alat</h4>
            <div>
                <button class="btn btn-sm btn-success btn-table"><img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Tambahkan"> Tambahkan</button>
            </div>
        </div>
        
        <?php if (!empty($alat_list)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Alat</th>
                        <th>Nama Alat</th>
                        <th>Status</th>
                        <th>Stok</th>
                        <th>Informasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alat_list as $alat): ?>
                        <tr>
                            <td><?= esc($alat['id_alat']) ?></td>
                            <td><?= esc($alat['nama_alat']) ?></td>
                            <td>
                                <?php if ($alat['cek_alat'] === 'Tersedia'): ?>
                                    <span class="badge bg-success">Tersedia</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Tidak Tersedia</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($alat['stok_alat']) ?></td>
                            <td style="max-width: 300px;"><?= esc($alat['informasi_alat']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-table">Edit</button>
                                <button class="btn btn-sm btn-danger btn-table">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center mt-5">
                <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" style="max-width: 150px;">
                <h4 class="text-danger mt-3 fw-bold">Belum Ada Data Alat</h4>
                <p>Silakan tambahkan data alat baru.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>