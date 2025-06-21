<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><img src="<?= base_url('assets/pelanggan_icon.png') ?>" width="35" class="me-2" alt="Icon"> Pelanggan</h4>
</div>

<form action="<?= base_url('admin/pelanggan') ?>" method="get" class="mb-4">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari berdasarkan nama lengkap..." name="cari" value="<?= esc($keyword ?? '') ?>">
        <button class="btn btn-primary" type="submit">Cari</button>
    </div>
</form>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php for ($i = 0; $i < 3; $i++): ?>
    <?php
        $nama_bulan_ini = $nama_bulan_list[$i] ?? 'Bulan Tidak Diketahui';
        $data_bulan_ini = $data_per_bulan[$i] ?? [];
    ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Pelanggan bulan <?= esc($nama_bulan_ini) ?></h5>
            <a href="<?= base_url('admin/pelanggan/tambah') ?>" class="btn btn-sm btn-success">Tambahkan</a>
        </div>
        <div class="card-body">
            <?php if (!empty($data_bulan_ini)): ?>
                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID Pelanggan</th>
                                <th>Nama Lengkap</th>
                                <th>No Telpon</th>
                                <th>Tanggal Survey</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_bulan_ini as $pelanggan): ?>
                                <tr>
                                    <td><?= esc($pelanggan['id_pelanggan']) ?></td>
                                    <td><?= esc($pelanggan['nama_lengkap']) ?></td>
                                    <td><?= esc($pelanggan['no_telpon']) ?></td>
                                    <td><?= esc(date('d F Y', strtotime($pelanggan['tanggal_survey']))) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/pelanggan/view/' . $pelanggan['id_pelanggan']) ?>" class="btn btn-sm btn-info">View</a>
                                        <a href="<?= base_url('admin/pelanggan/edit/' . $pelanggan['id_pelanggan']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= base_url('admin/pelanggan/hapus/' . $pelanggan['id_pelanggan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini secara permanen?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="#">More</a>
                </div>
            <?php else: ?>
                <div class="text-center py-4">
                    <p class="text-muted">Tidak Ada Data untuk bulan <?= esc($nama_bulan_ini) ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endfor; ?>

<?= $this->endSection() ?>
