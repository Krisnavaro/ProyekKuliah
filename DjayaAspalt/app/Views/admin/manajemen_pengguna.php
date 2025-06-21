<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<style>
    .card-pelanggan {
        border: 2px solid #ff9933;
        border-radius: 15px;
        background-color: #fffaf0;
    }
    .card-pelanggan .card-header {
        background-color: #ff9933;
        color: black;
        font-weight: bold;
        border-bottom: 2px solid #ff8c1a;
    }
    .card-pelanggan .table {
        background-color: white;
    }
    .card-pelanggan .table th {
        background-color: #333;
        color: white;
        text-align: center;
        font-size: 0.9em;
    }
    .card-pelanggan .table td {
        text-align: center;
        vertical-align: middle;
        font-size: 0.85em;
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
    <h4 class="mb-0 fw-bold"><img src="<?= base_url('assets/pelanggan_icon.png') ?>" width="35" class="me-2" alt="Icon"> Pelanggan</h4>
    <a href="<?= base_url('admin/pelanggan/tambah') ?>" class="btn btn-success">
        <img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Icon Tambah" class="me-2"> Tambah Pelanggan Aktif
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (empty($pelanggan_per_bulan)): ?>
    <div class="card card-pelanggan">
         <div class="card-body empty-data-container">
            <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
            <p>Belum ada data pelanggan.</p>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($pelanggan_per_bulan as $bulan => $daftar_pelanggan): ?>
        <div class="card card-pelanggan mb-4">
            <div class="card-header">
                Data Pelanggan bulan <?= date('F Y', strtotime($bulan)) ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID Pelanggan</th>
                                <th>Id Survey</th>
                                <th>Id Nama Sewa</th>
                                <th>Nama Lengkap</th>
                                <th>No. Telepon</th>
                                <th>Tanggal Survey</th>
                                <th>Lokasi Survey</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($daftar_pelanggan as $pelanggan): ?>
                                <tr>
                                    <td><?= esc($pelanggan['id_pelanggan']) ?></td>
                                    <td><?= esc($pelanggan['id_survey']) ?></td>
                                    <td><?= esc($pelanggan['id_namasewa']) ?></td>
                                    <td><?= esc($pelanggan['nama_lengkap']) ?></td>
                                    <td><?= esc($pelanggan['no_telpon']) ?></td>
                                    <td><?= esc(date('d-m-Y', strtotime($pelanggan['tanggal_survey']))) ?></td>
                                    <td><?= esc($pelanggan['lokasi_survey']) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/pelanggan/edit/' . $pelanggan['id_pelanggan']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= base_url('admin/pelanggan/hapus/' . $pelanggan['id_pelanggan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin?')">Hapus</a>
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