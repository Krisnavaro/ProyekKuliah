<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<style>
    /* Menggunakan style yang sama persis dengan halaman Pelaksanaan */
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
        border: 1px solid #dee2e6;
    }
    .card-pemesanan .table th {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 0.75rem;
    }
    .card-pemesanan .table td {
        vertical-align: middle;
        text-align: center;
        padding: 0.75rem;
    }
    .card-pemesanan .card-body {
        padding: 1.5rem;
    }
    .header-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
        margin-top: -40px; /* Menarik tombol ke atas sejajar dengan judul */
    }
    .btn-action {
        padding: 0.25rem 0.75rem;
        font-size: 0.8rem;
        font-weight: bold;
    }
    .empty-data-container {
        padding: 40px 20px;
        text-align: center;
    }
    .empty-data-container img {
        max-width: 150px;
        margin-bottom: 15px;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><img src="<?= base_url('assets/pemesanan_icon.png') ?>" width="35" class="me-2" alt="Icon"> Data Pemesanan</h4>
</div>

<?php if (empty($pemesanan_per_bulan)): ?>
    <div class="card card-pemesanan">
         <div class="card-body empty-data-container">
            <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
            <h4 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan</h4>
         </div>
    </div>
<?php else: ?>
    <?php foreach ($pemesanan_per_bulan as $bulan => $daftar_pemesanan): ?>
        <div class="card card-pemesanan mb-4">
            <div class="card-header">
                Data Pemesanan bulan <?= date('F Y', strtotime($bulan)) ?>
                <div class="header-actions">
                    <a href="#" class="btn btn-light btn-sm btn-action">🔍 Cari</a>
                    <a href="<?= base_url('admin/pemesanan/tambah') ?>" class="btn btn-success btn-sm btn-action">Tambahkan</a>
                    <a href="#" class="btn btn-dark btn-sm btn-action">View</a>
                    <a href="#" class="btn btn-warning btn-sm btn-action">Edit</a>
                    <a href="#" class="btn btn-danger btn-sm btn-action">Hapus</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id Pesanan</th>
                                <th>Id Pelaksanaan</th>
                                <th>Nama Paket Di Pesan</th>
                                <th>Harga Paket Di Pesan</th>
                                <th>Tanggal Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($daftar_pemesanan as $item): ?>
                                <tr>
                                    <td><?= esc($item['id_pesanan']) ?></td>
                                    <td><?= esc($item['id_pelaksanaan']) ?></td>
                                    <td><?= esc($item['nama_paketdipesan']) ?></td>
                                    <td>Rp. <?= number_format($item['harga_paketdipesan'], 0, ',', '.') ?></td>
                                    <td><?= esc(date('d-m-Y', strtotime($item['tanggal_pemesanan']))) ?></td>
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