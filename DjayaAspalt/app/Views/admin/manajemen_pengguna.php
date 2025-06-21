<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>

<style>
    .card.card-pelanggan {
        border: 2px solid #ff9933;
        border-radius: 15px;
        background-color: #fffaf0;
    }
    .card.card-pelanggan .card-header {
        background-color: #ff9933;
        color: black;
        font-weight: bold;
        border-bottom: 2px solid #ff8c1a;
    }
    .card.card-pelanggan .table {
        background-color: white;
    }
    .card.card-pelanggan .table th {
        background-color: #333;
        color: white;
        text-align: center;
        font-size: 0.9em;
    }
    .card.card-pelanggan .table td {
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
    .scroll-indicator {
        display: block;
        margin: -10px auto 0 auto;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: black;
        color: white;
        text-align: center;
        line-height: 40px;
        font-size: 1.5rem;
        cursor: pointer;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><img src="<?= base_url('assets/pelanggan_icon.png') ?>" width="35" class="me-2" alt="Icon"> Pelanggan</h4>
    <a href="<?= base_url('admin/pelanggan/tambah') ?>" class="btn btn-success">
        <img src="<?= base_url('assets/plus_icon.png') ?>" width="18" alt="Icon Tambah" class="me-2"> Tambah Pelanggan Aktif
    </a>
</div>


<div class="card card-pelanggan mb-4">
    <div class="card-header">
        Data Pelanggan bulan Desember
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id Pelanggan</th>
                        <th>Id Survey</th>
                        <th>Id Nama Sewa</th>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Survey</th>
                        <th>Lokasi Survey/Lokasi Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PLG12122024001</td>
                        <td>Survey12122024001</td>
                        <td>-</td>
                        <td>Samuel Orief Rosario</td>
                        <td>12-12-2024</td>
                        <td>Jl. Bhakti No.48 3, Cilandak, Jakarta Selatan</td>
                    </tr>
                    <tr>
                        <td>PLG12122024002</td>
                        <td>-</td>
                        <td>Sewa12122024001</td>
                        <td>Samuel Orief Rosario</td>
                        <td>-</td>
                        <td>Jl. Bhakti No.48 3, Cilandak, Jakarta Selatan</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <span class="scroll-indicator">▼</span>
    </div>
</div>


<div class="card card-pelanggan mb-4">
    <div class="card-header">
        Data Pelanggan bulan November
    </div>
    <div class="card-body">
        <div class="empty-data-container">
            <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
            <p>Tidak Ada Pemesanan/Penyewaan</p>
        </div>
        <span class="scroll-indicator">▼</span>
    </div>
</div>


<div class="card card-pelanggan mb-4">
    <div class="card-header">
        Data Pelanggan bulan Oktober
    </div>
    <div class="card-body">
        <div class="empty-data-container">
             <img src="<?= base_url('assets/table_cat_animated.gif') ?>" alt="Tidak Ada Data">
            <p>Tidak Ada Pemesanan/Penyewaan</p>
        </div>
        <span class="scroll-indicator">▼</span>
    </div>
</div>


<?= $this->endSection() ?>