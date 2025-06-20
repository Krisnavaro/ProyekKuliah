<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<style>
    .data-section {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 25px; /* Spasi antar bagian bulan */
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
        font-size: 0.8em; /* Ukuran font lebih kecil untuk tombol */
        padding: 0.25rem 0.5rem; /* Padding lebih kecil */
    }
    .admin-table-wrapper { /* Wrapper untuk scroll */
        overflow-x: auto; /* Aktifkan scroll horizontal */
        width: 100%; /* Pastikan wrapper mengambil lebar penuh */
    }
    .admin-table-custom table {
        width: 100%; /* Lebar tabel 100% dari parent (admin-table-wrapper) */
        border-collapse: collapse;
        margin-top: 15px;
        /* Hapus table-layout: fixed; jika ada, biarkan konten menentukan lebar kolom secara default atau atur secara spesifik */
    }
    .admin-table-custom th, .admin-table-custom td {
        border: 1px solid #000; /* Border hitam */
        padding: 8px;
        text-align: center;
        font-size: 0.8em; /* Ukuran font lebih kecil untuk tabel */
        vertical-align: middle;
        white-space: nowrap; /* Mencegah teks wrapping secara default di sel tabel */
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
    /* Menyesuaikan lebar kolom agar sesuai dengan konten di screenshot */
    .admin-table-custom th:nth-child(1) { width: 10%; } /* Id Pelanggan */
    .admin-table-custom th:nth-child(2) { width: 10%; } /* Id Survey */
    .admin-table-custom th:nth-child(3) { width: 10%; } /* Id Nama Sewa */
    .admin-table-custom th:nth-child(4) { width: 12%; } /* Nama Lengkap */
    .admin-table-custom th:nth-child(5) { width: 10%; } /* No Telpon */
    .admin-table-custom th:nth-child(6) { width: 13%; } /* Tanggal Survey */
    .admin-table-custom th:nth-child(7) { width: 35%; } /* Lokasi Survey/Lokasi Pengiriman */
    .admin-table-custom td:nth-child(7) { white-space: normal; text-align: left; } /* Khusus lokasi, biarkan wrapping dan rata kiri */

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
        <div class="admin-table-wrapper"> <div class="admin-table-custom">
                <table>
                    <thead>
                        <tr>
                            <th>Id Pelanggan</th>
                            <th>Id Survey</th>
                            <th>Id Nama Sewa</th>
                            <th>Nama Lengkap</th>
                            <th>No Telpon</th>
                            <th>Tanggal Survey</th>
                            <th>Lokasi Survey/Lokasi Pengiriman</th>
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
                                    <td><?= esc($item['lokasi']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div class="empty-state">
                                        <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
                                        <h5 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan/Penyewaan</h5>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
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
        <div class="admin-table-wrapper">
            <div class="admin-table-custom">
                <table>
                    <thead>
                        <tr>
                            <th>Id Pelanggan</th>
                            <th>Id Survey</th>
                            <th>Id Nama Sewa</th>
                            <th>Nama Lengkap</th>
                            <th>No Telpon</th>
                            <th>Tanggal Survey</th>
                            <th>Lokasi Survey/Lokasi Pengiriman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pelanggan_november)): ?>
                            <?php foreach ($pelanggan_november as $item): ?>
                                <tr>
                                    <td><?= esc($item['id_pelanggan']) ?></td>
                                    <td><?= esc($item['id_survey']) ?></td>
                                    <td><?= esc($item['id_nama_sewa']) ?></td>
                                    <td><?= esc($item['nama_lengkap']) ?></td>
                                    <td><?= esc($item['no_telpon']) ?></td>
                                    <td><?= esc($item['tanggal_survey']) ?></td>
                                    <td><?= esc($item['lokasi']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div class="empty-state">
                                        <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
                                        <h5 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan/Penyewaan</h5>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
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
        <div class="admin-table-wrapper">
            <div class="admin-table-custom">
                <table>
                    <thead>
                        <tr>
                            <th>Id Pelanggan</th>
                            <th>Id Survey</th>
                            <th>Id Nama Sewa</th>
                            <th>Nama Lengkap</th>
                            <th>No Telpon</th>
                            <th>Tanggal Survey</th>
                            <th>Lokasi Survey/Lokasi Pengiriman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pelanggan_oktober)): ?>
                            <?php foreach ($pelanggan_oktober as $item): ?>
                                <tr>
                                    <td><?= esc($item['id_pelanggan']) ?></td>
                                    <td><?= esc($item['id_survey']) ?></td>
                                    <td><?= esc($item['id_nama_sewa']) ?></td>
                                    <td><?= esc($item['nama_lengkap']) ?></td>
                                    <td><?= esc($item['no_telpon']) ?></td>
                                    <td><?= esc($item['tanggal_survey']) ?></td>
                                    <td><?= esc($item['lokasi']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div class="empty-state">
                                        <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
                                        <h5 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan/Penyewaan</h5>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center mt-3">
            <img src="<?= base_url('assets/More-01.png') ?>" alt="More" style="width: 25px; cursor: pointer;">
        </div>
    </div>

</div>

<?= $this->endSection() ?>