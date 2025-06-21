<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<style>
    /* Menggunakan style yang sama dengan halaman lainnya */
    .card-pemesanan {
        border: 2px solid #ff9933;
        border-radius: 15px;
        background-color: #fffaf0;
    }
    .card-pemesanan .card-header {
        background-color: #ff9933;
        color: black;
        font-weight: bold;
        border-bottom: 2px solid #ff8c1a;
    }
    .card-pemesanan .table {
        background-color: white;
    }
    .card-pemesanan .table th {
        background-color: #333;
        color: white;
        text-align: center;
    }
    .card-pemesanan .table td {
        vertical-align: middle;
        text-align: center;
    }
    .empty-data-container {
        padding: 40px 20px;
        text-align: center;
    }
    .empty-data-container img {
        max-width: 150px;
        margin-bottom: 15px;
    }
    .empty-data-container p {
        font-size: 1.2rem;
        color: #dc3545;
        font-weight: bold;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><img src="<?= base_url('assets/pemesanan_icon.png') ?>" width="35" class="me-2" alt="Icon"> Data Pemesanan</h4>
    <a href="#" class="btn btn-success">
        <img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Icon Tambah" class="me-2"> Tambah Pemesanan
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (empty($pemesanan_per_bulan)): ?>
    <div class="card card-pemesanan">
         <div class="card-body empty-data-container">
            <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
            <p>Belum ada data pemesanan.</p>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($pemesanan_per_bulan as $bulan => $daftar_pemesanan): ?>
        <div class="card card-pemesanan mb-4">
            <div class="card-header">
                Data Pemesanan bulan <?= date('F Y', strtotime($bulan)) ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>ID Pelaksanaan</th>
                                <th>Nama Paket</th>
                                <th>Harga Paket</th>
                                <th>Tanggal Pemesanan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($daftar_pemesanan as $item): ?>
                                <tr>
                                    <td><?= esc($item['id_pesanan']) ?></td>
                                    <td><?= esc($item['id_pelaksanaan'] ?? '-') ?></td>
                                    <td><?= esc($item['nama_paketdipesan']) ?></td>
                                    <td>Rp. <?= number_format($item['harga_paketdipesan'], 0, ',', '.') ?></td>
                                    <td><?= esc(date('d-m-Y', strtotime($item['tanggal_pemesanan']))) ?></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
