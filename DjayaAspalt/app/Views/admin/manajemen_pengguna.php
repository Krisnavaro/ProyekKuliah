<?= $this->extend('layout/admin_kosong') ?>

<?= $this->section('content') ?>
<style>
    .card-revisi { border-radius: 15px; background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: none; }
    .card-revisi .card-header { background-color: #ff9933; color: black; font-weight: bold; border-top-left-radius: 15px; border-top-right-radius: 15px; padding: 1rem 1.5rem; }
    .table thead th { background-color: #343a40; color: white; text-align: center; font-weight: 600; vertical-align: middle; }
    .table tbody td { text-align: center; vertical-align: middle; }
    .action-buttons .btn { color: white !important; font-weight: bold; padding: 0.25rem 0.5rem; font-size: 0.8rem; border: none; }
    .action-buttons .btn-dark img, .action-buttons .btn-warning img, .action-buttons .btn-danger img { display: none; } /* Sembunyikan ikon jika ada */
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0"><?= esc($page_title ?? 'Manajemen Pelanggan') ?></h4>
    <a href="#" class="btn btn-success">Tambahkan Pelanggan</a>
</div>

<?php if (empty($pelanggan_per_bulan)): ?>
    <div class="card card-revisi">
        <div class="card-body text-center p-5">
            <h5 class="text-danger">Tidak Ada Data Pelanggan</h5>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($pelanggan_per_bulan as $bulan => $items): ?>
    <div class="card card-revisi mb-4">
        <div class="card-header">Data Pelanggan bulan <?= $bulan ?></div>
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID Pelanggan</th><th>ID Survey</th><th>ID Sewa</th><th>Nama Lengkap</th>
                        <th>No Telpon</th><th>Tgl Survey</th><th>Lokasi</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= esc($item['id_pelanggan']) ?></td>
                            <td><?= esc($item['id_survey']) ?></td>
                            <td><?= esc($item['id_namasewa']) ?></td>
                            <td><?= esc($item['nama_lengkap']) ?></td>
                            <td><?= esc($item['no_telpon']) ?></td>
                            <td><?= date('d-m-Y', strtotime($item['tanggal_survey'])) ?></td>
                            <td><?= esc($item['lokasi_survey']) ?></td>
                            <td class="action-buttons">
                                <a href="#" class="btn btn-dark btn-sm">View</a>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
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