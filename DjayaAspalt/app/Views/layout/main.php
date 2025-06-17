<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Djaya Aspalt Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; }
    .sidebar {
      width: 200px;
      min-height: 100vh;
      background-color: #ffffff;
      border-right: 1px solid #dee2e6;
      padding-top: 1rem;
      position: fixed; 
      height: 100%;
      overflow-y: auto; 
    }
    .sidebar a {
      display: block;
      padding: 10px 15px;
      color: #000;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: #f1f1f1;
      padding-left: 20px;
      transition: 0.2s;
    }
    .main-content-wrapper {
      margin-left: 200px; 
      flex-grow: 1;
    }
    .topbar {
      background-color: #f8f9fa;
      padding: 12px 20px;
      border-bottom: 1px solid #dee2e6;
      display: flex;
      justify-content: space-between; 
      align-items: center;
    }
    .topbar .search-box {
      width: 550px; 
      margin: 0 auto; 
    }
    .topbar input { width: 100%; font-size: 14px; }
    .topbar .icon-group {
        display: flex;
        gap: 15px; 
        align-items: center;
    }
    .topbar .icon-group img {
        cursor: pointer;
        width: 30px; 
        height: auto;
    }
    .topbar .icon-group img[alt="Profile"],
    .topbar .icon-group img[alt="Login"] {
        width: 50px; 
    }
    .main-content { padding: 30px; }

    /* Gaya untuk modal */
    .modal-backdrop.show { opacity: .5; }
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,.3);
    }
    .modal-header { border-bottom: none; }
    .modal-footer { border-top: none; }
    
    .login-form-modal .btn-google {
        background-color: #4285F4;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .login-form-modal .btn-google img {
        width: 20px;
        height: 20px;
    }
  </style>
</head>
<body>

  <div class="d-flex">
    <div class="sidebar">
      <div class="text-center mb-4">
        <img src="<?= base_url('assets/logoSamping1.png') ?>" width="140" alt="Logo">
      </div>
      <a href="<?= base_url('dashboard') ?>">🏠 Home</a>
      <a href="<?= base_url('gallery') ?>">🖼️ Gallery</a>
      <a href="<?= base_url('hubungi-kami') ?>">📞 Hubungi Kami</a>
      <a href="<?= base_url('artikel') ?>">📄 Artikel</a>
      <a href="<?= base_url('bantuan') ?>">❓ Bantuan</a>

      <?php if (session()->get('logged_in')): ?>
        <a href="<?= base_url('profile-perusahaan') ?>">👤 Profile Perusahaan</a>
        <a href="<?= base_url('pemesanan') ?>">📦 Pemesanan</a>
        <a href="<?= base_url('penyewaan-barang') ?>">🏗️ Penyewaan</a>
        <a href="<?= base_url('keranjang') ?>">🛒 Keranjang</a>
        <a href="<?= base_url('logout') ?>" class="text-danger">🚪 Logout</a>
      <?php endif; ?>
    </div>

    <div class="main-content-wrapper">
      <div class="topbar">
        <div class="search-box">
          <input class="form-control" type="search" name="q" placeholder="Cari nama...">
        </div>
        <div class="icon-group">
            <a href="javascript:history.back()">
                <img src="<?= base_url('assets/Back-01.png') ?>" width="43" alt="Back">
            </a>
            <a href="<?= base_url('keranjang') ?>">
                <img src="<?= base_url('assets/Keranjang.png') ?>" width="22" alt="Cart">
            </a>
            <img src="<?= base_url('assets/Profil-01.png') ?>" width="45" alt="Profile" id="loginOrProfileIcon">
        </div>
      </div>
      
      <div class="main-content">
        <?= $this->renderSection('content') ?>
      </div>
    </div>
  </div>

  <div class="modal fade login-form-modal" id="loginFormModal" tabindex="-1" aria-labelledby="loginFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginFormModalLabel">Login ke DJAYA ASPALT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <img src="<?= base_url('assets/logo.png') ?>" alt="Logo" width="180px" class="mb-3">
            <h5 class="fw-bold mb-3">Login</h5>
            <div id="loginErrorAlert" class="alert alert-danger" style="display:none;"></div>
            <button class="btn btn-google mb-3"><img src="https://upload.wikimedia.org/wikipedia/commons/4/4a/Logo_2013_Google.png" alt="Google"> Sign in with Google</button>
            <p>Or</p>
            <form action="<?= base_url('login') ?>" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username atau Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">LOGIN</button>
            </form>
            <div class="mt-3 d-flex justify-content-between">
                <a href="#" id="redirectToRegister" class="text-decoration-none">&lt; REGISTER</a>
                <a href="#" class="text-decoration-none">Don't remember password?</a>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="registerFormModal" tabindex="-1" aria-labelledby="registerFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerFormModalLabel">Buat Akun Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('register') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="pass_confirm" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="pass_confirm" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                 <p class="mt-3 text-center">Sudah punya akun? <a href="#" id="redirectToLogin">Login di sini</a></p>
            </div>
        </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginOrProfileIcon = document.getElementById('loginOrProfileIcon');
        
        const loginModal = new bootstrap.Modal(document.getElementById('loginFormModal'));
        const registerModal = new bootstrap.Modal(document.getElementById('registerFormModal'));

        loginOrProfileIcon.addEventListener('click', function() {
            <?php if (session()->get('logged_in')): ?>
                // Jika sudah login, arahkan ke halaman profil
                window.location.href = '<?= base_url('customer-profile') ?>';
            <?php else: ?>
                // PERUBAHAN DI SINI: Langsung tampilkan modal login, bukan pilihan
                loginModal.show();
            <?php endif; ?>
        });

        // Pindah dari modal login ke register
        document.getElementById('redirectToRegister').addEventListener('click', function(e) {
            e.preventDefault();
            loginModal.hide();
            registerModal.show();
        });

        // Pindah dari modal register ke login
        document.getElementById('redirectToLogin').addEventListener('click', function(e) {
            e.preventDefault();
            registerModal.hide();
            loginModal.show();
        });

        // Menampilkan pesan error login dari server
        <?php if (session()->getFlashdata('error')): ?>
            document.getElementById('loginErrorAlert').innerText = '<?= session()->getFlashdata('error') ?>';
            document.getElementById('loginErrorAlert').style.display = 'block';
            loginModal.show();
        <?php endif; ?>
    });
  </script>
</body>
</html>