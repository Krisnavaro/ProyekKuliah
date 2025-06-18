<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="javascript:history.back()" class="me-3">
            <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
        </a>
        <h2 class="mb-0">Cek Pekerja</h2>
    </div>

    <div class="row">
        <div class="col-md-3 text-center">
            <div class="admin-card h-100">
                <img src="<?= base_url('assets/pekerja_sedang_bekerja.png') ?>" alt="Pekerja Sedang Bekerja" style="max-width: 150px;">
                <h5 class="fw-bold">Pekerja <span class="text-success">Sedang Bekerja</span></h5>
                <p>Pekerja: <?= $pekerja_sedang_bekerja_jumlah ?> Orang</p>
            </div>
        </div>
        <div class="col-md-9">
            <div class="admin-card p-4 h-100">
                <h4 class="fw-bold">Paket A</h4>
                <p class="mb-1"><strong>Id Pesanan:</strong> <span class="text-danger"><?= $pekerja_detail['id_pesanan'] ?></span></p>
                <p class="mb-1"><strong>Id Pelanggan:</strong> <span class="text-danger"><?= $pekerja_detail['id_pelanggan'] ?></span></p>
                <p class="mb-1"><strong>Nama:</strong> <?= $pekerja_detail['nama'] ?></p>
                <p class="mb-1"><strong>Waktu:</strong> <?= $pekerja_detail['waktu'] ?></p>
                <p class="mb-1"><strong>Tanggal:</strong> <?= $pekerja_detail['tanggal'] ?></p>
                <p class="mb-3"><strong>Lokasi:</strong> <?= $pekerja_detail['lokasi'] ?></p>

                <p class="text-danger fw-bold fst-italic">*<?= $pekerja_detail['status_pengerjaan'] ?></p>

                <div class="mt-4">
                    <button class="btn btn-dark btn-sm me-2"><img src="<?= base_url('assets/phone_call_icon.png') ?>" width="18" alt="Telpon"> Telpon Pekerja</button>
                    <button class="btn btn-success btn-sm me-2">Tambahkan</button>
                    <button class="btn btn-warning btn-sm">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>