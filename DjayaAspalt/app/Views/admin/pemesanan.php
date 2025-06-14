<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Pemesanan</h2>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <a href="<?= base_url('admin/cek-paket') ?>" class="text-decoration-none text-dark">
                <div class="admin-card py-3 mb-3">
                    <h5 class="mb-0 fw-bold">Cek Paket</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="<?= base_url('admin/cek-stok-full') ?>" class="text-decoration-none text-dark">
                <div class="admin-card py-3 mb-3">
                    <h5 class="mb-0 fw-bold">Cek Stok</h5>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="<?= base_url('admin/cek-pekerja-status') ?>" class="text-decoration-none text-dark">
                <div class="admin-card py-3 mb-3">
                    <h5 class="mb-0 fw-bold">Cek Pekerja</h5>
                </div>
            </a>
        </div>
    </div>

    <div class="admin-table p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold">Data Pemesanan bulan Desember</h4>
            <div>
                <button class="btn btn-sm btn-light btn-table"><img src="<?= base_url('assets/search_icon.png') ?>" width="18" alt="Cari"> Cari</button>
                <button class="btn btn-sm btn-success btn-table"><img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Tambahkan"> Tambahkan</button>
                <button class="btn btn-sm btn-info btn-table"><img src="<?= base_url('assets/view_icon.png') ?>" width="18" alt="View"> View</button>
                <button class="btn btn-sm btn-warning btn-table"><img src="<?= base_url('assets/edit_icon.png') ?>" width="18" alt="Edit"> Edit</button>
                <button class="btn btn-sm btn-danger btn-table"><img src="<?= base_url('assets/delete_icon.png') ?>" width="18" alt="Hapus"> Hapus</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-dark">
                        <th>Id Pesanan</th>
                        <th>Id Pelaksanaan</th>
                        <th>Nama Paket Di Pesan</th>
                        <th>Harga Paket Di Pesan</th>
                        <th>Tanggal Pemesanan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bulan_desember)): ?>
                        <?php foreach ($bulan_desember as $pesanan): ?>
                            <tr>
                                <td><?= esc($pesanan['id_pesanan']) ?></td>
                                <td><?= esc($pesanan['id_pelaksanaan']) ?></td>
                                <td><?= esc($pesanan['nama_paket_di_pesan']) ?></td>
                                <td><?= esc($pesanan['harga_paket_di_pesan']) ?></td>
                                <td><?= esc($pesanan['tanggal_pemesanan']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">Tidak ada data pemesanan bulan Desember.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <i class="fas fa-chevron-down fa-2x"></i>
        </div>
    </div>

    <div class="admin-table p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold">Data Pemesanan bulan November</h4>
            <div>
                <button class="btn btn-sm btn-light btn-table"><img src="<?= base_url('assets/search_icon.png') ?>" width="18" alt="Cari"> Cari</button>
                <button class="btn btn-sm btn-success btn-table"><img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Tambahkan"> Tambahkan</button>
                <button class="btn btn-sm btn-info btn-table"><img src="<?= base_url('assets/view_icon.png') ?>" width="18" alt="View"> View</button>
                <button class="btn btn-sm btn-warning btn-table"><img src="<?= base_url('assets/edit_icon.png') ?>" width="18" alt="Edit"> Edit</button>
                <button class="btn btn-sm btn-danger btn-table"><img src="<?= base_url('assets/delete_icon.png') ?>" width="18" alt="Hapus"> Hapus</button>
            </div>
        </div>
        <?php if ($bulan_november_ada_data): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-dark">
                        <th>Id Pesanan</th>
                        <th>Id Pelaksanaan</th>
                        <th>Nama Paket Di Pesan</th>
                        <th>Harga Paket Di Pesan</th>
                        <th>Tanggal Pemesanan</th>
                    </tr>
                </thead>
                <tbody>
                    </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="text-center mt-5">
                <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" class="cat-illustration">
                <h4 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan</h4>
            </div>
        <?php endif; ?>
        <div class="text-center mt-3">
            <i class="fas fa-chevron-down fa-2x"></i>
        </div>
    </div>
</div>
<?= $this->endSection() ?>