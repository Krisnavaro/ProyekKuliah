<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Djaya Aspalt Admin Dashboard</title>
    <!-- Menggunakan Bootstrap untuk styling dasar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- LANGKAH 1: Tambahkan link ke Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Style kustom untuk dashboard baru -->
    <style>
        /* LANGKAH 2: Terapkan font baru ke seluruh halaman */
        body {
            font-family: 'Poppins', sans-serif; /* <-- FONT DIUBAH DI SINI */
            background-color: #F0F2F5;
        }

        .admin-wrapper {
            display: flex;
        }

        .admin-sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #ffffff;
            padding-top: 1.5rem;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #e0e0e0;
        }

        .sidebar-header {
            padding: 0 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
        }
        .sidebar-header img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .sidebar-header h5 {
            margin: 0;
            font-weight: 600; /* Dibuat lebih tebal */
        }

        .sidebar-menu {
            flex-grow: 1;
        }
        .sidebar-menu a {
            display: block;
            padding: 12px 1.5rem;
            color: #555; /* Warna teks menu sedikit lebih gelap */
            text-decoration: none;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: #eef2ff; /* Warna hover/aktif yang lebih soft */
            color: #4361ee; /* Warna teks saat aktif/hover */
            border-left: 3px solid #4361ee;
        }

        .sidebar-footer {
            padding: 1.5rem;
            text-align: center;
        }
        .sidebar-footer img {
            width: 150px;
        }

        .admin-main-content-wrapper {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        .admin-topbar {
            background-color: #ffffff;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .search-container {
            position: relative;
            width: 50%;
        }
        .search-container input {
            width: 100%;
            padding: 8px 15px 8px 40px;
            border-radius: 20px;
            border: 1px solid #ccc;
            background-color: #f5f5f5;
        }
        .search-container .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .topbar-icons {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .topbar-icons img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }
        .topbar-icons .icon-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #555;
        }

        .admin-main-content {
            padding: 2rem;
            background-color: #FFDAB9;
            min-height: calc(100vh - 70px);
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <div class="admin-sidebar">
            <div class="sidebar-header">
                <img src="<?= base_url('assets/logo_djaya_aspalt.png') ?>" alt="Logo">
                <h5>DJAYA ASPALT</h5>
            </div>
            <div class="sidebar-menu">
                <a href="<?= base_url('admin') ?>">Home</a>
                <a href="<?= base_url('admin/pelanggan') ?>">Pelanggan</a>
                <a href="<?= base_url('admin/pelaksanaan') ?>">Pelaksanaan</a>
                <a href="<?= base_url('admin/pemesanan') ?>">Pemesanan</a>
                <a href="<?= base_url('admin/penyewaan') ?>">Penyewaan</a>
                <a href="<?= base_url('admin/alat') ?>">Alat</a>
                <a href="<?= base_url('admin/pembayaran') ?>">Pembayaran</a>
                <a href="<?= base_url('admin/pengembalian') ?>">Pengembalian</a>
            </div>
            <div class="sidebar-footer">
                <img src="<?= base_url('assets/admin_worker_illustration.png') ?>" alt="Admin Worker">
            </div>
        </div>

        <div class="admin-main-content-wrapper">
            <div class="admin-topbar">
                <div class="search-container">
                    <span class="search-icon">🔍</span>
                    <input class="form-control" type="search" placeholder="Cari...">
                </div>
                <div class="topbar-icons">
                    <button class="icon-btn">🔄</button>
                    <img src="<?= session()->get('foto_profil') ? base_url('uploads/avatars/' . session()->get('foto_profil')) : base_url('assets/default_avatar.png') ?>" alt="Foto Profil Admin" id="adminProfileIcon">
                </div>
            </div>

            <div id="adminProfileDropdown" style="display: none; position: absolute; top: 65px; right: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 100; padding: 10px; min-width: 200px;">
                 <a href="<?= base_url('admin/profile') ?>" style="display:block; padding: 10px; text-decoration:none; color: #333;">Informasi Akun</a>
                 <a href="<?= base_url('logout') ?>" style="display:block; padding: 10px; text-decoration:none; color: red;">Keluar Akun</a>
            </div>

            <div class="admin-main-content">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var adminProfileIcon = document.getElementById('adminProfileIcon');
            var adminProfileDropdown = document.getElementById('adminProfileDropdown');

            if (adminProfileIcon) {
                adminProfileIcon.addEventListener('click', function(event) {
                    event.stopPropagation();
                    adminProfileDropdown.style.display = adminProfileDropdown.style.display === 'none' ? 'block' : 'none';
                });

                document.addEventListener('click', function(event) {
                    if (!adminProfileIcon.contains(event.target) && !adminProfileDropdown.contains(event.target)) {
                        adminProfileDropdown.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>
