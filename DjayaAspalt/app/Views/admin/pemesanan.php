<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Data Pemesanan</h2>
    </div>

    <div class="admin-table p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold">Daftar Semua Pemesanan</h4>
            <div>
                <button class="btn btn-sm btn-success btn-table"><img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Tambahkan"> Tambahkan</button>
            </div>
        </div>
        
        <?php if (!empty($pemesanan_list)): ?>
            {{-- DATA PEMESANAN BULAN DESEMBER (contoh dari screenshot) --}}
            <div class="data-section mb-4">
                <div class="data-header">
                    <h4>Data Pemesanan bulan Desember</h4>
                    <div class="action-buttons">
                        <button class="btn btn-sm btn-info btn-table">Cari</button>
                        <button class="btn btn-sm btn-success btn-table">Tambahkan</button>
                        <button class="btn btn-sm btn-warning btn-table">Edit</button>
                        <button class="btn btn-sm btn-danger btn-table">Hapus</button>
                    </div>
                </div>
                <table>
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
                        <?php foreach ($pemesanan_list as $item): ?>
                            {{-- Filter atau tampilkan sesuai bulan Desember jika data real --}}
                            {{-- Untuk sementara, saya tampilkan semua yang ada di $pemesanan_list --}}
                            <tr>
                                <td><?= esc($item['id_pesanan']) ?></td>
                                <td><?= esc($item['id_pelaksanaan']) ?></td>
                                <td><?= esc($item['nama_paketdipesan']) ?></td>
                                <td>Rp. <?= number_format(esc($item['harga_paketdipesan']), 0, ',', '.') ?></td>
                                <td><?= esc($item['tanggal_pemesanan']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <img src="<?= base_url('assets/arrow_down_icon.png') ?>" alt="More" style="width: 20px;">
                </div>
            </div>

            {{-- DATA PEMESANAN BULAN NOVEMBER (contoh dari screenshot) --}}
            <div class="data-section mb-4">
                <div class="data-header">
                    <h4>Data Pemesanan bulan November</h4>
                    <div class="action-buttons">
                        <button class="btn btn-sm btn-info btn-table">Cari</button>
                        <button class="btn btn-sm btn-success btn-table">Tambahkan</button>
                        <button class="btn btn-sm btn-warning btn-table">Edit</button>
                        <button class="btn btn-sm btn-danger btn-table">Hapus</button>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" style="max-width: 150px;">
                    <h4 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan</h4>
                    <p>Belum ada data pemesanan yang tercatat di database.</p>
                </div>
                <div class="text-center mt-3">
                    <img src="<?= base_url('assets/arrow_down_icon.png') ?>" alt="More" style="width: 20px;">
                </div>
            </div>

            {{-- DATA PEMESANAN BULAN OKTOBER (contoh dari screenshot) --}}
            <div class="data-section mb-4">
                <div class="data-header">
                    <h4>Data Pemesanan bulan Oktober</h4>
                    <div class="action-buttons">
                        <button class="btn btn-sm btn-info btn-table">Cari</button>
                        <button class="btn btn-sm btn-success btn-table">Tambahkan</button>
                        <button class="btn btn-sm btn-warning btn-table">Edit</button>
                        <button class="btn btn-sm btn-danger btn-table">Hapus</button>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" style="max-width: 150px;">
                    <h4 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan</h4>
                    <p>Belum ada data pemesanan yang tercatat di database.</p>
                </div>
                <div class="text-center mt-3">
                    <img src="<?= base_url('assets/arrow_down_icon.png') ?>" alt="More" style="width: 20px;">
                </div>
            </div>

        <?php else: ?>
            <div class="text-center mt-5">
                <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" style="max-width: 150px;">
                <h4 class="text-danger mt-3 fw-bold">Belum Ada Data Pemesanan</h4>
                <p>Belum ada data pemesanan yang tercatat di database.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<style>
    /* Styling tambahan khusus untuk view ini jika diperlukan,
       tapi sebagian besar sudah di layout/admin_main.php */
    .data-section {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 20px; /* Jarak antar bagian bulan */
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
    .action-buttons button {
        margin-left: 5px;
    }
    .admin-table table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    .admin-table th, .admin-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        font-size: 0.9em;
    }
    .admin-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    .admin-table .btn-table {
        padding: 5px 10px;
        font-size: 0.8em;
        margin: 0 2px;
    }
    .admin-table .cat-illustration {
        max-width: 150px;
        margin: 20px auto;
        display: block;
    }
</style>

<?= $this->endSection() ?>