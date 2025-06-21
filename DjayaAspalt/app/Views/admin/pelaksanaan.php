<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<style>
    .card-pelaksanaan {
        border: 2px solid #ff9933;
        border-radius: 15px;
        background-color: #fffaf0;
    }
    .card-pelaksanaan .card-header {
        background-color: #ff9933;
        color: black;
        font-weight: bold;
        border-bottom: 2px solid #ff8c1a;
    }
    .card-pelaksanaan .table {
        background-color: white;
    }
    .card-pelaksanaan .table th {
        background-color: #333;
        color: white;
        text-align: center;
    }
     .card-pelaksanaan .table td {
        vertical-align: middle;
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
    <h4 class="mb-0 fw-bold"><img src="<?= base_url('assets/pelaksanaan_icon.png') ?>" width="35" class="me-2" alt="Icon"> Data Pelaksanaan</h4>
    <a href="<?= base_url('admin/pelaksanaan/tambah') ?>" class="btn btn-success">
        <img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Icon Tambah" class="me-2"> Tambah Data Pelaksanaan
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (empty($pelaksanaan_per_bulan)): ?>
    <div class="card card-pelaksanaan">
         <div class="card-body empty-data-container">
            <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
            <p>Belum ada data pelaksanaan.</p>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($pelaksanaan_per_bulan as $bulan => $daftar_pelaksanaan): ?>
        <div class="card card-pelaksanaan mb-4">
            <div class="card-header">
                Data Pelaksanaan bulan <?= date('F Y', strtotime($bulan)) ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID Pelaksanaan</th>
                                <th>ID Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Alamat Pelaksanaan</th>
                                <th>Waktu Pengerjaan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($daftar_pelaksanaan as $item): ?>
                                <tr>
                                    <td class="text-center"><?= esc($item['id_pelaksanaan']) ?></td>
                                    <td class="text-center"><?= esc($item['id_pelanggan']) ?></td>
                                    <td><?= esc($item['nama_lengkap']) ?></td>
                                    <td class="text-center"><?= esc(date('d-m-Y', strtotime($item['tanggal_pelaksanaan']))) ?></td>
                                    <td><?= esc($item['alamat_pelaksanaan']) ?></td>
                                    <td class="text-center"><span class="badge bg-primary"><?= esc($item['waktu_pengerjaan']) ?></span></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/pelaksanaan/edit/' . $item['id_pelaksanaan']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= base_url('admin/pelaksanaan/hapus/' . $item['id_pelaksanaan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin?')">Hapus</a>
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