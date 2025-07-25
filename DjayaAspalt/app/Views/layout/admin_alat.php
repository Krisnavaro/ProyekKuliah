<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page_title ?? 'Manajemen Alat - Djaya Aspalt') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .main-wrapper { display: flex; min-height: 100vh; }
        .sub-sidebar {
            width: 250px;
            background-color: #ffffff;
            padding: 1.5rem;
            border-right: 1px solid #dee2e6;
            flex-shrink: 0;
        }
        .sub-sidebar .sidebar-title {
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }
        .sub-sidebar .sidebar-title img {
            width: 32px;
            height: 32px;
            margin-right: 10px;
        }
        .sub-sidebar .nav-link {
            color: #555;
            font-weight: 500;
            padding: 0.75rem 0.25rem;
            border-left: 3px solid transparent;
        }
        .sub-sidebar .nav-link:hover, .sub-sidebar .nav-link.active {
            color: #0d6efd;
            border-left-color: #0d6efd;
        }
        .content-wrapper { flex-grow: 1; display: flex; flex-direction: column; }
        .topbar {
            background-color: #ffffff;
            padding: 1rem 2rem;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        .main-content { padding: 2rem; background-color: #FFDAB9; flex-grow: 1; }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="sub-sidebar">
            <a href="<?= base_url('admin') ?>" class="text-decoration-none text-dark">
                <div class="sidebar-title">
                    <img src="<?= base_url('assets/Back-01.png') ?>" alt="Back">
                    Manajemen Alat
                </div>
            </a>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= (strpos(uri_string(), 'admin/alat-berat') !== false) ? 'active' : '' ?>" href="<?= base_url('admin/alat-berat') ?>">Daftar Alat Berat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos(uri_string(), 'admin/material') !== false) ? 'active' : '' ?>" href="<?= base_url('admin/material') ?>">Daftar Material</a>
                </li>
            </ul>
        </div>

        <div class="content-wrapper">
            <div class="topbar">
                <div class="search-container w-50"><input class="form-control" type="search" placeholder="Cari..."></div>
                <div class="topbar-profile">
                    <img src="<?= (session()->get('foto_profil')) ? base_url('uploads/avatars/' . session()->get('foto_profil')) : base_url('assets/admin_profile_pic.png') ?>" alt="foto profil" class="rounded-circle" width="40" height="40">
                    <span class="ms-2 fw-bold"><?= esc(session()->get('nama_lengkap') ?? 'Admin') ?></span>
                </div>
            </div>
            <div class="main-content">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>