<?= $this->extend('layout/admin_kosong') ?>

<?= $this->section('content') ?>
<style>
    /* DESAIN INI DISALIN DARI HALAMAN PELAKSANAAN SESUAI PERMINTAAN ANDA */
    .card-revisi { border-radius: 15px; background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: none; }
    .card-revisi .card-header { background-color: #ff9933; color: black; font-weight: bold; border-top-left-radius: 15px; border-top-right-radius: 15px; padding: 1rem 1.5rem; }
    .table thead th { background-color: #343a40; color: white; text-align: center; font-weight: 600; vertical-align: middle; }
    .table tbody td { text-align: center; vertical-align: middle; }
    .action-buttons .btn { margin: 0 2px; }
    .action-buttons .btn-warning { color: black !important; }
    .action-buttons .btn-danger { color: white !important; }
    .action-buttons .btn-info { color: white !important; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0">Data Penyewaan</h4>
    <a href="<?= base_url('admin/penyewaan/tambah') ?>" class="btn btn-primary">Tambahkan Penyewaan</a>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (empty($penyewaan_per_bulan)): ?>
    <div class="card card-revisi">
        <div class="card-body empty-state" style="text-align: center; padding: 50px;">
            <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" style="max-width: 150px; margin-bottom: 20px;">
            <h5 class="text-danger">Tidak Ada Data Penyewaan</h5>
            <p>Silakan tambahkan data penyewaan baru.</p>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($penyewaan_per_bulan as $bulan => $items): ?>
    <div class="card card-revisi mb-4">
        <div class="card-header">Data Penyewaan bulan <?= $bulan ?></div>
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID Sewa</th>
                        <th>Nama Penyewa</th>
                        <th>ID Alat</th>
                        <th>Tgl Sewa</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= esc($item['id_sewa']) ?></td>
                            <td><?= esc($item['nama_penyewa']) ?></td>
                            <td><?= esc($item['id_alat']) ?></td>
                            <td><?= date('d M Y', strtotime($item['tanggal_penyewaan'])) ?></td>
                            <td>Rp. <?= number_format($item['harga_alatdisewa'] ?? 0, 0, ',', '.') ?></td>
                            <td><span class="badge bg-primary"><?= esc($item['status']) ?></span></td>
                           <td class="action-buttons">
                                <a href="<?= base_url('admin/penyewaan/view/' . $item['id_sewa']) ?>" class="btn btn-info btn-sm">Lihat</a>
                                <a href="<?= base_url('admin/penyewaan/edit/' . $item['id_sewa']) ?>" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="<?= base_url('admin/penyewaan/hapus/' . $item['id_sewa']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>