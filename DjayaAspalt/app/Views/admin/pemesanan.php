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
            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Paket Dipesan</th>
                        <th>Harga Paket</th>
                        <th>Tanggal Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pemesanan_list as $item): ?>
                        <tr>
                            <td><?= esc($item['id_pesanan']) ?></td>
                            <td><?= esc($item['nama_lengkap']) ?></td>
                            <td><?= esc($item['nama_paketdipesan']) ?></td>
                            <td>Rp <?= number_format(esc($item['harga_paketdipesan']), 0, ',', '.') ?></td>
                            <td><?= esc($item['tanggal_pemesanan']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-info btn-table">Detail</button>
                                <button class="btn btn-sm btn-danger btn-table">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center mt-5">
                <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" style="max-width: 150px;">
                <h4 class="text-danger mt-3 fw-bold">Belum Ada Data Pemesanan</h4>
                <p>Belum ada data pemesanan yang tercatat di database.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>