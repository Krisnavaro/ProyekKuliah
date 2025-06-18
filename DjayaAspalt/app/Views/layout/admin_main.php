<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Djaya Aspalt Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; }
    .admin-sidebar {
      width: 200px;
      min-height: 100vh;
      background-color: #ffffff; /* Ini yang membuat sidebar putih */
      border-right: 1px solid #dee2e6;
      padding-top: 1rem;
      position: fixed;
      height: 100%;
      overflow-y: auto;
    }
    .admin-sidebar a {
      display: block;
      padding: 10px 15px;
      color: #000;
      text-decoration: none;
    }
    .admin-sidebar a:hover {
      background-color: #f1f1f1;
      padding-left: 20px;
      transition: 0.2s;
    }
    .admin-main-content-wrapper {
      margin-left: 200px;
      flex-grow: 1;
    }
    .admin-topbar {
      background-color: #f8f9fa;
      padding: 12px 20px;
      border-bottom: 1px solid #dee2e6;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .admin-topbar .search-box {
      width: 550px;
      margin: 0 auto;
    }
    .admin-topbar input { width: 100%; font-size: 14px; }
    .admin-topbar .icon-group {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    .admin-topbar .icon-group img {
        cursor: pointer;
    }
    .admin-topbar .icon-group img.back-button {
        width: 43px;
        height: auto;
    }
    .admin-topbar .icon-group img.profile-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
    }
    .admin-main-content { padding: 30px; background-color: #ffcc80; min-height: calc(100vh - 60px); } /* Ini yang membuat konten utama oranye */

    .admin-profile-dropdown {
        position: absolute;
        top: 60px;
        right: 20px;
        background-color: white;
        border: 1px solid #eee;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        width: 250px;
        z-index: 1000;
        padding: 15px;
    }
    .admin-profile-dropdown .header {
        display: flex;
        align-items: center;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        margin-bottom: 10px;
    }
    .admin-profile-dropdown .header img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
    }
    .admin-profile-dropdown .menu-item {
        padding: 8px 0;
        cursor: pointer;
        transition: background-color 0.2s;
        display: block;
        color: #333;
        text-decoration: none;
    }
    .admin-profile-dropdown .menu-item:hover {
        background-color: #f9f9f9;
    }
    .admin-table { background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .admin-table table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    .admin-table th, .admin-table td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 0.9em; }
    .admin-table th { background-color: #f2f2f2; font-weight: bold; }
    .admin-table .btn-table { padding: 5px 10px; font-size: 0.8em; margin: 0 2px; }
    .admin-table .cat-illustration { max-width: 150px; margin: 20px auto; display: block; }
    .admin-card { background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; transition: transform 0.3s; }
    .admin-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.15); }
    .admin-card img { max-width: 100%; height: 120px; object-fit: contain; margin-bottom: 15px; }
    .admin-card ul { text-align: left; padding-left: 20px; list-style-type: disc; }
  </style>
</head>
<body>
  <div class="d-flex">
    <div class="admin-sidebar">
      <div class="text-center mb-4">
        <img src="<?= base_url('assets/logoSamping1.png') ?>" width="140" alt="Logo">
      </div>
      <a href="<?= base_url('admin') ?>">🏠 Home</a>
      <a href="<?= base_url('admin/pelanggan') ?>">👥 Manajemen Klien</a>
      <a href="<?= base_url('admin/pelaksanaan') ?>">📅 Pelaksanaan</a>
      {{-- BARIS INI HANYA SATU YANG AKTIF --}}
      <a href="<?= base_url('admin/kelola-pemesanan') ?>">📦 Pemesanan</a>
      <a href="<?= base_url('admin/penyewaan') ?>">🏗️ Penyewaan</a>
      <a href="<?= base_url('admin/alat') ?>">🔧 Alat</a>
      <a href="<?= base_url('admin/pembayaran') ?>">💰 Pembayaran</a>
      <a href="<?= base_url('admin/pengembalian') ?>">🔙 Pengembalian</a>
      <div class="text-center mt-5">
        <img src="<?= base_url('assets/admin_worker_laptop.png') ?>" width="120" alt="Admin Worker">
      </div>
    </div>

    <div class="admin-main-content-wrapper">
      <div class="admin-topbar">
        <div class="search-box">
          <input class="form-control" type="search" name="q" placeholder="Cari nama...">
        </div>
        <div class="icon-group">
            <a href="javascript:history.back()">
                <img src="<?= base_url('assets/Back-01.png') ?>" class="back-button" alt="Back">
            </a>
            <img src="<?= session()->get('foto_profil') ? base_url('uploads/avatars/' . session()->get('foto_profil')) : base_url('assets/Profil-01.png') ?>" class="profile-icon" alt="Profile" id="adminProfileIcon">
        </div>
      </div>

      <div id="adminProfileDropdown" class="admin-profile-dropdown" style="display: none;">
          <div class="header">
              <img src="<?= session()->get('foto_profil') ? base_url('uploads/avatars/' . session()->get('foto_profil')) : base_url('assets/admin_profile_pic.png') ?>" alt="Admin Avatar">
              <div>
                  <strong><?= session()->get('nama_lengkap') ?? 'Nama Admin' ?></strong>
                  <div class="text-muted" style="font-size: 0.8em;"><?= session()->get('email') ?? 'admin@example.com' ?></div>
              </div>
          </div>
          <a href="<?= base_url('admin/profile') ?>" class="menu-item">Informasi Akun</a>
          <a href="<?= base_url('logout') ?>" class="menu-item text-danger">Keluar Akun</a>
      </div>

      <div class="admin-main-content">
        <?= $this->renderSection('content') ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var adminProfileIcon = document.getElementById('adminProfileIcon');
        var adminProfileDropdown = document.getElementById('adminProfileDropdown');

        if (adminProfileIcon) {
            adminProfileIcon.addEventListener('click', function(event) {
                event.stopPropagation();
                if (adminProfileDropdown.style.display === 'none') {
                    adminProfileDropdown.style.display = 'block';
                } else {
                    adminProfileDropdown.style.display = 'none';
                }
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