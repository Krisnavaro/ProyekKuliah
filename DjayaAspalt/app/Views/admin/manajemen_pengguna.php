<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Pelanggan</h2>
    </div>

    <div class="admin-table p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold">Data Pelanggan bulan Desember</h4>
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
                        <th>Id Pelanggan</th>
                        <th>Id Survey</th>
                        <th>Id Sewa</th>
                        <th>Nama Lengkap</th>
                        <th>No Telpon</th>
                        <th>Tanggal Survey</th>
                        <th>Lokasi Survey/Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bulan_desember)): ?>
                        <?php foreach ($bulan_desember as $pelanggan): ?>
                            <tr>
                                <td><?= esc($pelanggan['id_pelanggan']) ?></td>
                                <td><?= esc($pelanggan['id_survey']) ?></td>
                                <td><?= esc($pelanggan['id_sewa']) ?></td>
                                <td><?= esc($pelanggan['nama_lengkap']) ?></td>
                                <td><?= esc($pelanggan['no_telpon']) ?></td>
                                <td><?= esc($pelanggan['tanggal_survey']) ?></td>
                                <td><?= esc($pelanggan['lokasi']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center">Tidak ada data pelanggan bulan Desember.</td></tr>
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
            <h4 class="mb-0 fw-bold">Data Pelanggan bulan November</h4>
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
                        <th>Id Pelanggan</th>
                        <th>Id Survey</th>
                        <th>Id Sewa</th>
                        <th>Nama Lengkap</th>
                        <th>No Telpon</th>
                        <th>Tanggal Survey</th>
                        <th>Lokasi Survey/Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="text-center mt-5">
                <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" class="cat-illustration">
                <h4 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan/Penyewaan</h4>
            </div>
        <?php endif; ?>
        <div class="text-center mt-3">
            <i class="fas fa-chevron-down fa-2x"></i>
        </div>
    </div>
</div>
<?= $this->endSection() ?>