<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Djaya Aspalt Admin Dashboard</title>
    <link rel="icon" href="<?= base_url('assets/favicon.ico') ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            display: flex;
            background-color: #f8f9fc;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 250px;
            background-color: #ffffff; /* Ini yang membuat sidebar putih */
            color: #333; /* Warna teks untuk sidebar putih */
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border-right: 1px solid #dee2e6; /* Garis pemisah */
        }

        .admin-sidebar a {
            color: #333; /* Warna teks untuk link di sidebar putih */
            text-decoration: none;
            padding: 10px 15px;
            margin: 5px 0;
            width: 100%;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            display: flex;
            align-items: center;
        }

        .admin-sidebar a:hover {
            background-color: #f1f1f1; /* Warna hover untuk sidebar putih */
            color: #000;
        }

        .admin-sidebar a img {
            margin-right: 10px;
        }

        .admin-content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #ffcc80; /* Konten utama oranye */
            min-height: 100vh;
        }

        .admin-navbar {
            background-color: white;
            padding: 15px 20px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 0.35rem;
            margin-bottom: 20px;
        }

        .admin-navbar .search-bar {
            flex-grow: 1;
            margin: 0 20px;
            max-width: 500px;
        }

        .admin-navbar .search-bar input {
            width: 100%;
            padding: 8px 15px;
            border: 1px solid #d1d3e2;
            border-radius: 20px;
        }

        .admin-navbar .user-profile {
            display: flex;
            align-items: center;
        }

        .admin-navbar .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .admin-navbar .user-profile span {
            margin-right: 10px;
            color: #5a5c69;
        }

        .admin-table {
            background-color: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 20px;
        }

        .admin-table table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .admin-table th,
        .admin-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .admin-table th {
            background-color: #f2f2f2;
        }

        .btn-table {
            padding: 5px 10px;
            font-size: 0.85rem;
            border-radius: 0.25rem;
            text-decoration: none;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-table.btn-success {
            background-color: #1cc88a;
            border-color: #1cc88a;
        }

        .btn-table.btn-success:hover {
            background-color: #17a673;
            border-color: #17a673;
        }

        .btn-table.btn-warning {
            background-color: #f6c23e;
            border-color: #f6c23e;
        }

        .btn-table.btn-warning:hover {
            background-color: #f4b619;
            border-color: #f4b619;
        }

        .btn-table.btn-danger {
            background-color: #e74a3b;
            border-color: #e74a3b;
        }

        .btn-table.btn-danger:hover {
            background-color: #da3c2b;
            border-color: #da3c2b;
        }

        .btn-table.btn-info {
            background-color: #36b9cc;
            border-color: #36b9cc;
        }

        .btn-table.btn-info:hover {
            background-color: #2c9faf;
            border-color: #2c9faf;
        }
    </style>
</head>

<body>
    <div class="admin-sidebar">
        <div class="text-center mb-4">
            <img src="<?= base_url('assets/logoSamping1.png') ?>" width="140" alt="Logo">
        </div>
        <a href="<?= base_url('admin') ?>">🏠 Home</a>
        <a href="<?= base_url('admin/pelanggan') ?>">👥 Manajemen Klien</a>
        <a href="<?= base_url('admin/pelaksanaan') ?>">📅 Pelaksanaan</a>

        <a href="<?= base_url('admin/pemesanan') ?>">📦 Pemesanan</a> 
        <a href="<?= base_url('admin/penyewaan') ?>">🏗️ Penyewaan</a>
        <a href="<?= base_url('admin/alat') ?>">🔧 Alat</a>
        <a href="<?= base_url('admin/pembayaran') ?>">💰 Pembayaran</a>
        <a href="<?= base_url('admin/pengembalian') ?>">🔙 Pengembalian</a>
        
        <hr class="w-100 my-3" style="border-top: 1px solid rgba(0,0,0,0.1);">

        <a href="<?= base_url('admin/manajemen-pelanggan-survey') ?>">📊 Data Pelanggan (Survey)</a>
        
        <div class="text-center mt-5">
            <img src="<?= base_url('assets/admin_worker_laptop.png') ?>" width="120" alt="Admin Worker">
        </div>
    </div>

    <div class="admin-content">
        <nav class="admin-navbar">
            <div class="search-bar">
                <input type="text" placeholder="Cari nama...">
            </div>
            <div class="user-profile">
                <span>Halo, <?= esc(session()->get('nama_lengkap') ?? 'Admin') ?></span>
                <?php $foto_profil = session()->get('foto_profil'); ?>
                <img src="<?= base_url('uploads/avatars/' . ($foto_profil ? $foto_profil : 'default.jpg')) ?>" alt="User Avatar">
                <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm ms-3">Logout</a>
            </div>
        </nav>

        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>