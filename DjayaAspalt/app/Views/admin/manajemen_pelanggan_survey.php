<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Manajemen Data Pelanggan (Survey/Sewa)</h2>
    </div>

    <div class="admin-table p-4 mb-4">
        <h4 class="mb-0 fw-bold mb-4">Daftar Semua Data Pelanggan</h4>

        {{-- Bagian untuk Data Pelanggan bulan Desember --}}
        <div class="data-section mb-4">
            <div class="data-header" data-bs-toggle="collapse" data-bs-target="#collapseDesember" aria-expanded="true" aria-controls="collapseDesember">
                <h4 class="mb-0 fw-bold">Data Pelanggan bulan Desember</h4>
                <div class="action-buttons">
                    <a href="<?= base_url('admin/manajemen-pelanggan-survey/cari?bulan=desember') ?>" class="btn btn-sm btn-info btn-table">Cari</a>
                    <a href="<?= base_url('admin/manajemen-pelanggan-survey/tambah') ?>" class="btn btn-sm btn-success btn-table">Tambahkan</a>
                    <button class="btn btn-sm btn-warning btn-table">Edit</button>
                    <button class="btn btn-sm btn-danger btn-table">Hapus</button>
                </div>
            </div>
            <div class="collapse show" id="collapseDesember">
                <?php if (!empty($pelanggan_survey_list)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Id Pelanggan</th>
                                <th>Id Survey</th>
                                <th>Id Nama Sewa</th>
                                <th>Nama Lengkap</th>
                                <th>No Telpon</th>
                                <th>Tanggal Survey</th>
                                <th>Lokasi Survey/Pengiriman</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pelanggan_survey_list as $pelanggan): ?>
                                {{-- Anda bisa tambahkan logika PHP di sini untuk memfilter berdasarkan bulan jika diperlukan di controller --}}
                                {{-- Saat ini, saya menampilkan semua data yang tersedia di $pelanggan_survey_list --}}
                                <tr>
                                    <td><?= esc($pelanggan['id_pelanggan']) ?></td>
                                    <td><?= esc($pelanggan['id_survey']) ?></td>
                                    <td><?= esc($pelanggan['id_namasewa']) ?></td>
                                    <td><?= esc($pelanggan['nama_lengkap']) ?></td>
                                    <td><?= esc($pelanggan['no_telpon']) ?></td>
                                    <td><?= esc($pelanggan['tanggal_survey']) ?></td>
                                    <td><?= esc($pelanggan['lokasi_survey']) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/manajemen-pelanggan-survey/detail/' . esc($pelanggan['id_pelanggan'])) ?>" class="btn btn-sm btn-info btn-table">View</a>
                                        <a href="<?= base_url('admin/manajemen-pelanggan-survey/edit/' . esc($pelanggan['id_pelanggan'])) ?>" class="btn btn-sm btn-warning btn-table">Edit</a>
                                        <a href="<?= base_url('admin/manajemen-pelanggan-survey/hapus/' . esc($pelanggan['id_pelanggan'])) ?>" class="btn btn-sm btn-danger btn-table" onclick="return confirm('Apakah Anda yakin ingin menghapus data pelanggan ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="text-center mt-3">
                        <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" style="max-width: 150px;">
                        <h4 class="text-danger mt-3 fw-bold">Belum Ada Data Pelanggan (Survey/Sewa) untuk Bulan Desember</h4>
                        <p>Silakan tambahkan data pelanggan survey/sewa baru.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-3">
                <img src="<?= base_url('assets/arrow_down_icon.png') ?>" alt="Toggle" style="width: 20px; cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapseDesember" aria-expanded="true" aria-controls="collapseDesember">
            </div>
        </div>

        {{-- Bagian untuk Data Pelanggan bulan November --}}
        <div class="data-section mb-4">
            <div class="data-header" data-bs-toggle="collapse" data-bs-target="#collapseNovember" aria-expanded="false" aria-controls="collapseNovember">
                <h4 class="mb-0 fw-bold">Data Pelanggan bulan November</h4>
                <div class="action-buttons">
                    <a href="<?= base_url('admin/manajemen-pelanggan-survey/cari?bulan=november') ?>" class="btn btn-sm btn-info btn-table">Cari</a>
                    <a href="<?= base_url('admin/manajemen-pelanggan-survey/tambah') ?>" class="btn btn-sm btn-success btn-table">Tambahkan</a>
                    <button class="btn btn-sm btn-warning btn-table">Edit</button>
                    <button class="btn btn-sm btn-danger btn-table">Hapus</button>
                </div>
            </div>
            <div class="collapse" id="collapseNovember">
                <div class="text-center mt-3">
                    <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" style="max-width: 150px;">
                    <h4 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan/Penyewaan</h4>
                    <p>Belum ada data pelanggan survey/sewa yang tercatat untuk bulan November.</p>
                </div>
            </div>
            <div class="text-center mt-3">
                <img src="<?= base_url('assets/arrow_down_icon.png') ?>" alt="Toggle" style="width: 20px; cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapseNovember" aria-expanded="false" aria-controls="collapseNovember">
            </div>
        </div>

        {{-- Bagian untuk Data Pelanggan bulan Oktober --}}
        <div class="data-section mb-4">
            <div class="data-header" data-bs-toggle="collapse" data-bs-target="#collapseOktober" aria-expanded="false" aria-controls="collapseOktober">
                <h4 class="mb-0 fw-bold">Data Pelanggan bulan Oktober</h4>
                <div class="action-buttons">
                    <a href="<?= base_url('admin/manajemen-pelanggan-survey/cari?bulan=oktober') ?>" class="btn btn-sm btn-info btn-table">Cari</a>
                    <a href="<?= base_url('admin/manajemen-pelanggan-survey/tambah') ?>" class="btn btn-sm btn-success btn-table">Tambahkan</a>
                    <button class="btn btn-sm btn-warning btn-table">Edit</button>
                    <button class="btn btn-sm btn-danger btn-table">Hapus</button>
                </div>
            </div>
            <div class="collapse" id="collapseOktober">
                <div class="text-center mt-3">
                    <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data" style="max-width: 150px;">
                    <h4 class="text-danger mt-3 fw-bold">Tidak Ada Pemesanan/Penyewaan</h4>
                    <p>Belum ada data pelanggan survey/sewa yang tercatat untuk bulan Oktober.</p>
                </div>
            </div>
            <div class="text-center mt-3">
                <img src="<?= base_url('assets/arrow_down_icon.png') ?>" alt="Toggle" style="width: 20px; cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapseOktober" aria-expanded="false" aria-controls="collapseOktober">
            </div>
        </div>

    </div>
</div>

<style>
    /* Styling tambahan khusus untuk view ini jika diperlukan,
       tapi sebagian besar sudah di layout/admin_main.php */
    .admin-table h4 {
        margin-bottom: 0;
        font-weight: bold;
    }
    .admin-table .btn-table {
        margin-left: 5px; /* Jarak antar tombol di header */
    }
    .data-section {
        background-color: #fefefe; /* Latar belakang kartu per bulan */
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }
    .data-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        cursor: pointer; /* Menunjukkan bahwa header bisa diklik untuk toggle */
        padding-bottom: 10px;
        border-bottom: 1px solid #eee; /* Garis bawah header */
    }
    .data-header .action-buttons {
        display: flex;
        gap: 5px;
    }
    .data-section table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    .data-section th, .data-section td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        font-size: 0.9em;
    }
    .data-section th {
        background-color: #f9f9f9;
        font-weight: bold;
    }
</style>

<?= $this->endSection() ?>