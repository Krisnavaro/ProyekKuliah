<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Data Pelaksanaan</h2>
    </div>

    <div class="admin-table p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold">Daftar Semua Pelaksanaan</h4>
            <div>
                <button class="btn btn-sm btn-success btn-table"><img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Tambahkan"> Tambahkan</button>
            </div>
        </div>
        
        <?php if (!empty($pelaksanaan_list)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Pelaksanaan</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Alamat</th>
                        <th>Waktu Pengerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pelaksanaan_list as $item): ?>
                        <tr>
                            <td><?= esc($item['id_pelaksanaan']) ?></td>
                            <td><?= esc($item['nama_lengkap']) ?></td> <td><?= esc($item['tanggal_pelaksanaan']) ?></td>
                            <td><?= esc($item['alamat_pelaksanaan']) ?></td>
                            <td><?= esc($item['waktu_pengerjaan']) ?></td>
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
                <h4 class="text-danger mt-3 fw-bold">Belum Ada Data Pelaksanaan</h4>
                <p>Silakan tambahkan data baru.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>