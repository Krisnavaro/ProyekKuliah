<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Data Pembayaran</h2>
    </div>

    <div class="admin-table p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold">Daftar Semua Pembayaran</h4>
            <div>
                 <a href="<?= base_url('admin/pembayaran/bukti') ?>" class="btn btn-sm btn-info btn-table"><img src="<?= base_url('assets/bukti_pembayaran_icon.png') ?>" width="18" alt="Bukti Pembayaran"> Lihat Bukti</a>
                <button class="btn btn-sm btn-success btn-table"><img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Tambahkan"> Tambahkan</button>
            </div>
        </div>
        
        <?php if (!empty($pembayaran_list)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Bayar</th>
                        <th>ID Pesanan</th>
                        <th>ID Sewa</th>
                        <th>Tanggal Bayar</th>
                        <th>Metode</th>
                        <th>No. Rekening</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembayaran_list as $item): ?>
                        <tr>
                            <td><?= esc($item['id_bayar']) ?></td>
                            <td><?= esc($item['id_pesanan']) ?: '-' ?></td>
                            <td><?= esc($item['id_sewa']) ?: '-' ?></td>
                            <td><?= esc($item['tanggal_pembayaran']) ?></td>
                            <td><?= esc($item['metode_pembayaran']) ?></td>
                            <td><?= esc($item['no_rekening']) ?></td>
                            <td>Rp <?= number_format(esc($item['total_harga']), 0, ',', '.') ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-table">Edit</button>
                                <button class="btn btn-sm btn-danger btn-table">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center mt-5">
                <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" style="max-width: 150px;">
                <h4 class="text-danger mt-3 fw-bold">Belum Ada Data Pembayaran</h4>
                <p>Belum ada transaksi pembayaran yang tercatat di database.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>