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
                <a href="<?= base_url('admin/pelaksanaan/tambah') ?>" class="btn btn-sm btn-success btn-table">
                    <img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Tambahkan"> Tambahkan
                </a>
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
                            <td>
                                <?php
                                    $nama_pelanggan = $customer_map[$item['id_pelanggan']] ?? 'Pelanggan Dihapus';
                                    echo esc($nama_pelanggan);
                                ?>
                            </td>
                            <td><?= esc($item['tanggal_pelaksanaan']) ?></td>
                            <td><?= esc($item['alamat_pelaksanaan']) ?></td>
                            <td><?= esc($item['waktu_pengerjaan']) ?></td>
                            <td>
                                <a href="<?= base_url('admin/pelaksanaan/edit/' . $item['id_pelaksanaan']) ?>" class="btn btn-sm btn-warning btn-table">Edit</a>
                                <a href="<?= base_url('admin/pelaksanaan/hapus/' . $item['id_pelaksanaan']) ?>" class="btn btn-sm btn-danger btn-table" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center mt-5">
                <h4 class="text-danger mt-3 fw-bold">Belum Ada Data Pelaksanaan</h4>
                <p>Silakan tambahkan data baru melalui tombol "Tambahkan".</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>