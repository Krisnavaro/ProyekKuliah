<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<style>
    .data-section {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 25px; 
    }
    .data-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    .data-header h4 {
        margin-bottom: 0;
        font-weight: bold;
    }
    .action-buttons .btn {
        margin-left: 5px;
        font-size: 0.8em;
        padding: 0.25rem 0.5rem;
    }
    .admin-table-custom table {
        /* CSS DIUBAH DI SINI: Menghapus min-width agar tabel mengikuti lebar kotak */
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        table-layout: fixed; /* Memaksa tabel mengikuti lebar yang ditentukan */
    }
    .admin-table-custom th, .admin-table-custom td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
        font-size: 0.8em;
        vertical-align: middle;
        word-wrap: break-word; /* Memastikan teks panjang turun ke bawah */
    }
    .admin-table-custom th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    .empty-state {
        padding: 40px 20px;
        border: 2px dashed #ddd;
        border-radius: 10px;
        margin-top: 15px;
    }
    .empty-state img {
        max-width: 120px;
        opacity: 0.6;
    }
    /* Menghapus CSS untuk wrapper scroll */
</style>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Pelanggan</h2>
    </div>

    <div class="data-section">
        <div class="data-header">
            <h4>Data Pelanggan bulan Desember</h4>
            <div class="action-buttons">
                <button class="btn btn-sm btn-info text-white">Cari</button>
                <a href="<?= base_url('admin/pelanggan/tambah') ?>" class="btn btn-sm btn-success">Tambahkan</a>
                <button class="btn btn-sm btn-dark text-white">View</button>
                <button class="btn btn-sm btn-warning text-white">Edit</button>
                <button class="btn btn-sm btn-danger">Hapus</button>
            </div>
        </div>
        <div class="admin-table-custom">
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%;">Id Pelanggan</th>
                        <th style="width: 10%;">Id Survey</th>
                        <th style="width: 10%;">Id Nama Sewa</th>
                        <th style="width: 12%;">Nama Lengkap</th>
                        <th style="width: 10%;">No Telpon</th>
                        <th style="width: 13%;">Tanggal Survey</th>
                        <th style="width: 35%;">Lokasi Survey/Lokasi Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pelanggan_desember)): ?>
                        <?php foreach ($pelanggan_desember as $item): ?>
                            <tr>
                                <td><?= esc($item['id_pelanggan']) ?></td>
                                <td><?= esc($item['id_survey']) ?></td>
                                <td><?= esc($item['id_nama_sewa']) ?></td>
                                <td><?= esc($item['nama_lengkap']) ?></td>
                                <td><?= esc($item['no_telpon']) ?></td>
                                <td><?= esc($item['tanggal_survey']) ?></td>
                                <td style="text-align: left;"><?= esc($item['lokasi']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <img src="<?= base_url('assets/More-01.png') ?>" alt="More" style="width: 25px; cursor: pointer;">
        </div>
    </div>

    <div class="data-section">
        <div class="data-header">
            <h4>Data Pelanggan bulan November</h4>
            <div class="action-buttons">
                <button class="btn btn-sm btn-info text-white">Cari</button>
                <a href="<?= base_url('admin/pelanggan/tambah') ?>" class="btn btn-sm btn-success">Tambahkan</a>
                <button class="btn btn-sm btn-dark text-white">View</button>
                <button class="btn btn-sm btn-warning text-white">Edit</button>
                <button class="btn btn-sm btn-danger">Hapus</button>
            </div>
        </div>
        <div class="text-center empty-state">
            <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
            <h5 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan/Penyewaan</h5>
        </div>
        <div class="text-center mt-3">
            <img src="<?= base_url('assets/More-01.png') ?>" alt="More" style="width: 25px; cursor: pointer;">
        </div>
    </div>

    <div class="data-section">
        <div class="data-header">
            <h4>Data Pelanggan bulan Oktober</h4>
            <div class="action-buttons">
                <button class="btn btn-sm btn-info text-white">Cari</button>
                <a href="<?= base_url('admin/pelanggan/tambah') ?>" class="btn btn-sm btn-success">Tambahkan</a>
                <button class="btn btn-sm btn-dark text-white">View</button>
                <button class="btn btn-sm btn-warning text-white">Edit</button>
                <button class="btn btn-sm btn-danger">Hapus</button>
            </div>
        </div>
        <div class="text-center empty-state">
            <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
            <h5 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan/Penyewaan</h5>
        </div>
        <div class="text-center mt-3">
            <img src="<?= base_url('assets/More-01.png') ?>" alt="More" style="width: 25px; cursor: pointer;">
        </div>
    </div>

</div>

<?= $this->endSection() ?>