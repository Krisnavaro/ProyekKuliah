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
      position: fixed; /* Membuat sidebar tetap */
      height: 100%;
      overflow-y: auto; /* Agar sidebar bisa di-scroll jika kontennya panjang */
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
      margin-left: 200px; /* Offset untuk sidebar fixed */
      flex-grow: 1;
    }
    .topbar {
      background-color: #f8f9fa;
      padding: 12px 20px;
      border-bottom: 1px solid #dee2e6;
      display: flex;
      justify-content: space-between; /* Menjaga elemen terpencar */
      align-items: center;
    }
    .topbar .search-box {
      width: 550px; /* Diperpanjang dari 400px */
      margin: 0 auto; /* Menengahkan search box */
    }
    .topbar input { width: 100%; font-size: 14px; }
    .topbar .icon-group {
        display: flex;
        gap: 15px; /* Jarak antar ikon diperbesar */
        align-items: center;
    }
    .topbar .icon-group img {
        cursor: pointer;
        width: 30px; /* Ukuran ikon keranjang diperbesar */
        height: auto;
    }
    .topbar .icon-group img[alt="Profile"],
    .topbar .icon-group img[alt="Login"] {
        width: 50px; /* Ukuran ikon profil diperbesar */
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

    /* Gaya khusus untuk modal pilihan login/register */
    .login-choice-modal .modal-body {
        text-align: center;
        padding: 40px;
    }
    .login-choice-modal .login-option {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .login-choice-modal .login-option:hover {
        background-color: #f0f0f0;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .login-choice-modal .login-option img {
        width: 80px;
        margin-bottom: 10px;
    }

    /* Gaya untuk modal success/warning */
    .status-modal .modal-content {
        max-width: 400px;
        margin: auto;
    }
    .status-modal .modal-body {
        text-align: center;
        padding: 40px 20px;
    }
    .status-modal .status-icon {
        width: 100px;
        height: 100px;
        margin-bottom: 20px;
    }
    .status-modal h4 {
        font-weight: bold;
        margin-bottom: 15px;
    }
    .status-modal p {
        color: #555;
        margin-bottom: 20px;
    }
    .status-modal .btn {
        min-width: 120px;
        margin: 5px;
    }

    /* Gaya untuk modal Login utama */
    .login-form-modal .modal-content {
        max-width: 450px;
        margin: auto;
    }
    .login-form-modal .modal-body {
        padding: 30px;
    }
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

    /* Gaya untuk dropdown profil user di topbar */
    .user-profile-dropdown {
        position: absolute;
        top: 60px; /* Sesuaikan dengan tinggi topbar */
        right: 20px;
        background-color: white;
        border: 1px solid #eee;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        width: 250px;
        z-index: 1000;
        padding: 15px;
    }
    .user-profile-dropdown .header {
        display: flex;
        align-items: center;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        margin-bottom: 10px;
    }
    .user-profile-dropdown .header img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }
    .user-profile-dropdown .menu-item {
        padding: 8px 0;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .user-profile-dropdown .menu-item:hover {
        background-color: #f9f9f9;
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
            <?php if (session()->get('logged_in')): ?>
                <img src="<?= base_url('assets/Profil-01.png') ?>" width="45" alt="Profile" id="userProfileIcon">
            <?php else: ?>
                <img src="<?= base_url('assets/Profil-01.png') ?>" width="45" alt="Login" id="loginIcon">
            <?php endif; ?>
        </div>
      </div>

      <?php if (session()->get('logged_in')): ?>
      <div id="userProfileDropdown" class="user-profile-dropdown" style="display: none;">
          <div class="header">
              <img src="<?= base_url('assets/Profil-01.png') ?>" alt="User Avatar">
              <div>
                  <strong><?= session()->get('nama_lengkap') ?? session()->get('username') ?></strong>
                  <div class="text-muted" style="font-size: 0.8em;"><?= session()->get('email') ?? '' ?></div>
              </div>
          </div>
          <a href="<?= base_url('customer-profile') ?>" class="text-dark text-decoration-none menu-item">Informasi Akun<br></a>
          <a href="<?= base_url('histori-pemesanan') ?>" class="text-dark text-decoration-none menu-item">Histori Pemesanan<br></a>
          <a href="<?= base_url('histori-penyewaan') ?>" class="text-dark text-decoration-none menu-item">Histori Penyewaan<br></a>
          <a href="<?= base_url('logout') ?>" class="text-danger text-decoration-none menu-item">Keluar Akun</a>
      </div>
      <?php endif; ?>

      <div class="main-content">
        <?= $this->renderSection('content') ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // JS untuk menampilkan modal login jika tidak login
    document.addEventListener('DOMContentLoaded', function() {
        var loginIcon = document.getElementById('loginIcon');
        var userProfileIcon = document.getElementById('userProfileIcon');
        var userProfileDropdown = document.getElementById('userProfileDropdown');

        if (loginIcon) {
            loginIcon.addEventListener('click', function() {
                var loginChoiceModal = new bootstrap.Modal(document.getElementById('loginChoiceModal'));
                loginChoiceModal.show();
            });
        }

        if (userProfileIcon) {
            userProfileIcon.addEventListener('click', function(event) {
                event.stopPropagation(); // Mencegah klik menyebar ke document
                if (userProfileDropdown.style.display === 'none') {
                    userProfileDropdown.style.display = 'block';
                } else {
                    userProfileDropdown.style.display = 'none';
                }
            });

            // Sembunyikan dropdown jika klik di luar
            document.addEventListener('click', function(event) {
                if (!userProfileIcon.contains(event.target) && !userProfileDropdown.contains(event.target)) {
                    userProfileDropdown.style.display = 'none';
                }
            });
        }

        // Handle klik opsi di loginChoiceModal
        document.getElementById('loginChoiceModal').addEventListener('click', function(e) {
            if (e.target.closest('.login-option-link')) {
                var linkElement = e.target.closest('.login-option-link');
                var type = linkElement.getAttribute('data-login-type');

                document.getElementById('loginTypeHiddenInput').value = type;
                document.getElementById('loginFormModalLabel').innerText = 'Login ke DJAYA ASPALT sebagai ' + (type === 'customer' ? 'Pelanggan' : 'Admin');

                var loginChoiceModal = bootstrap.Modal.getInstance(document.getElementById('loginChoiceModal'));
                if (loginChoiceModal) loginChoiceModal.hide();

                var loginFormModal = new bootstrap.Modal(document.getElementById('loginFormModal'));
                loginFormModal.show();
            }
        });

        // Script untuk menampilkan modal login form jika ada flashdata error login
        <?php if (session()->getFlashdata('error')): ?>
            document.addEventListener('DOMContentLoaded', function() {
                var loginFormModal = new bootstrap.Modal(document.getElementById('loginFormModal'));
                loginFormModal.show();
                document.getElementById('loginErrorAlert').innerText = '<?= session()->getFlashdata('error') ?>';
                document.getElementById('loginErrorAlert').style.display = 'block';
                 document.getElementById('loginTypeHiddenInput').value = '<?= session()->getFlashdata('login_type_attempt') ?>';
                 document.getElementById('loginFormModalLabel').innerText = 'Login ke DJAYA ASPALT sebagai ' + ('<?= session()->getFlashdata('login_type_attempt') ?>' === 'customer' ? 'Pelanggan' : 'Admin');
            });
        <?php endif; ?>

        // Modal Notifikasi Registrasi Berhasil
        <?php if (session()->getFlashdata('success_register')): ?>
            var successRegisterModal = new bootstrap.Modal(document.getElementById('successRegisterModal'));
            successRegisterModal.show();
        <?php endif; ?>

        // Fungsi untuk menampilkan modal peringatan (contoh di pemesanan, jasa perbaikan)
        window.showWarningModal = function(message) {
            var warningModal = new bootstrap.Modal(document.getElementById('warningModal'));
            document.getElementById('warningMessage').innerText = message;
            warningModal.show();
        }

        // Fungsi untuk menampilkan modal pilihan pembayaran
        window.showPaymentMethodModal = function() {
            var paymentMethodModal = new bootstrap.Modal(document.getElementById('paymentMethodModal'));
            paymentMethodModal.show();
        }

        // Fungsi untuk menampilkan modal QRIS dan menyembunyikan modal metode pembayaran
        window.showQrisPayment = function() {
            var paymentMethodModal = bootstrap.Modal.getInstance(document.getElementById('paymentMethodModal'));
            if (paymentMethodModal) paymentMethodModal.hide();

            var qrisPaymentModal = new bootstrap.Modal(document.getElementById('qrisPaymentModal'));
            qrisPaymentModal.show();

            setTimeout(function() {
                var qrisPaymentModalInstance = bootstrap.Modal.getInstance(document.getElementById('qrisPaymentModal'));
                if (qrisPaymentModalInstance) qrisPaymentModalInstance.hide();
                window.showLoadingPayment();
            }, 3000);
        }

        // Fungsi untuk menampilkan modal loading pembayaran
        window.showLoadingPayment = function() {
            var loadingPaymentModal = new bootstrap.Modal(document.getElementById('loadingPaymentModal'));
            loadingPaymentModal.show();

            setTimeout(function() {
                var loadingPaymentModalInstance = bootstrap.Modal.getInstance(document.getElementById('loadingPaymentModal'));
                if (loadingPaymentModalInstance) loadingPaymentModalInstance.hide();
                window.showSuccessPaymentModal();
            }, 4000);
        }

        // Fungsi untuk menampilkan modal pembayaran berhasil
        window.showSuccessPaymentModal = function() {
            var successPaymentModal = new bootstrap.Modal(document.getElementById('successPaymentModal'));
            successPaymentModal.show();
        }

        // Fungsi untuk menampilkan modal konfirmasi hapus
        window.showDeleteConfirmModal = function() {
            var deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            deleteConfirmModal.show();
        }

        // Fungsi untuk menampilkan modal Sewaan Selesai
        window.showRentalFinishedModal = function() {
            var rentalFinishedModal = new bootstrap.Modal(document.getElementById('rentalFinishedModal'));
            rentalFinishedModal.show();
        }

        // --- Handle redirect ke register dan kembali ke login (dari register modal) ---
        // Redirect ke register dari modal login
        document.querySelector('#loginFormModal #redirectToRegisterFromLogin').addEventListener('click', function(e) {
            e.preventDefault();
            var loginFormModalInstance = bootstrap.Modal.getInstance(document.getElementById('loginFormModal'));
            if (loginFormModalInstance) loginFormModalInstance.hide();
            var registerFormModal = new bootstrap.Modal(document.getElementById('registerFormModal'));
            registerFormModal.show();
        });

        // Redirect ke login dari modal register
        document.getElementById('redirectToLoginFromRegister').addEventListener('click', function(e) {
            e.preventDefault();
            var registerFormModalInstance = bootstrap.Modal.getInstance(document.getElementById('registerFormModal'));
            if (registerFormModalInstance) registerFormModalInstance.hide();
            var loginFormModal = new bootstrap.Modal(document.getElementById('loginFormModal'));
            loginFormModal.show();
        });

        // Login setelah register sukses
        document.getElementById('loginAfterRegister').addEventListener('click', function(e) {
            e.preventDefault();
            var successRegisterModalInstance = bootstrap.Modal.getInstance(document.getElementById('successRegisterModal'));
            if (successRegisterModalInstance) successRegisterModalInstance.hide();
            var loginFormModal = new bootstrap.Modal(document.getElementById('loginFormModal'));
            loginFormModal.show();
            // Optional: pre-fill username if available from old input or flashdata
        });
    });
  </script>

  <div class="modal fade login-choice-modal" id="loginChoiceModal" tabindex="-1" aria-labelledby="loginChoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginChoiceModalLabel">Anda ingin login sebagai apa?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <a href="#" data-login-type="customer" class="text-decoration-none text-dark login-option-link">
                <div class="login-option">
                  <img src="<?= base_url('assets/pelanggan_icon.png') ?>" alt="Pelanggan">
                  <p class="fw-bold">Pelanggan</p>
                </div>
              </a>
            </div>
            <div class="col-6">
              <a href="#" data-login-type="admin" class="text-decoration-none text-dark login-option-link">
                <div class="login-option">
                  <img src="<?= base_url('assets/admin_icon.png') ?>" alt="Admin">
                  <p class="fw-bold">Admin</p>
                </div>
              </a>
            </div>
          </div>
        </div>
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
                <input type="hidden" name="login_type" id="loginTypeHiddenInput">
                <div class="mb-3">
                    <input type="email" class="form-control" name="username" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">LOGIN</button>
            </form>
            <div class="mt-3 d-flex justify-content-between">
                <a href="#" id="redirectToRegisterFromLogin" class="text-decoration-none">< REGISTER</a>
                <a href="#" class="text-decoration-none">Don't remember password?</a>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade register-form-modal" id="registerFormModal" tabindex="-1" aria-labelledby="registerFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerFormModalLabel">Buat Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <form action="<?= base_url('register') ?>" method="post">
              <?php if (isset($validation)): ?>
                <div class="alert alert-danger text-start">
                    <?= $validation->listErrors() ?>
                </div>
              <?php endif; ?>

              <div class="mb-3 text-start">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" required>
              </div>
              <div class="mb-3 text-start">
                <label for="no_handphone" class="form-label">Nomor Handphone</label>
                <input type="text" class="form-control" name="no_handphone" value="<?= old('no_handphone') ?>" required>
              </div>
              <div class="mb-3 text-start">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= old('email') ?>" required>
              </div>
              <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password" id="registerPassword" required>
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                      <i class="fa-solid fa-eye"></i>
                  </button>
                </div>
              </div>
              <div class="mb-3 text-start">
                <label for="pass_confirm" class="form-label">Ulangi Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="pass_confirm" id="registerPassConfirm" required>
                  <button class="btn btn-outline-secondary" type="button" id="togglePassConfirm">
                      <i class="fa-solid fa-eye"></i>
                  </button>
                </div>
              </div>
              <div class="form-check text-start mb-3">
                <input class="form-check-input" type="checkbox" value="" id="syaratKetentuan" required>
                <label class="form-check-label" for="syaratKetentuan">
                  Dengan mendaftar maka Saya menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                </label>
              </div>
              <button type="submit" class="btn btn-primary w-100">Register</button>
          </form>
          <div class="mt-3">
            <p>Sudah punya akun? <a href="#" id="redirectToLoginFromRegister">Login Sekarang</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade status-modal" id="successRegisterModal" tabindex="-1" aria-labelledby="successRegisterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <img src="<?= base_url('assets/success_icon.png') ?>" alt="Success" class="status-icon">
          <h4 class="text-success">BERHASIL MEMBUAT AKUN</h4>
          <p>Akun Anda telah berhasil dibuat. Silakan login untuk melanjutkan.</p>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="loginAfterRegister">Login Sekarang</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade status-modal" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <img src="<?= base_url('assets/warning.png') ?>" alt="Warning" class="status-icon">
          <h4 class="text-danger"></h4>
          <p id="warningMessage"></p>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='<?= base_url('login') ?>'">Login Sekarang</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade status-modal" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paymentMethodModalLabel">Pilih Metode Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <div class="d-flex justify-content-around align-items-center my-3">
                <img src="<?= base_url('assets/qris_logo.png') ?>" alt="QRIS" width="120" style="cursor:pointer;" onclick="showQrisPayment()">
                <img src="<?= base_url('assets/bca_logo.png') ?>" alt="BCA" width="120" style="cursor:pointer;" onclick="alert('Metode BCA belum diimplementasikan.')">
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade status-modal" id="qrisPaymentModal" tabindex="-1" aria-labelledby="qrisPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="qrisPaymentModalLabel">Mohon Discan Untuk Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <img src="<?= base_url('assets/qris_qr.png') ?>" alt="QRIS Code" class="img-fluid mb-3">
            <p class="fw-bold">DJAYA ASPALT</p>
            <p>NMID: ID1023255263742</p>
            <p>A01</p>
            <small>Cek aplikasi penyelenggara di: www.npqi-qris.id</small>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade status-modal" id="loadingPaymentModal" tabindex="-1" aria-labelledby="loadingPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <h4 class="mb-4">Loading....</h4>
          <img src="<?= base_url('assets/loading_cat.gif') ?>" alt="Loading" class="status-icon" style="width:150px; height:auto;">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade status-modal" id="successPaymentModal" tabindex="-1" aria-labelledby="successPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <img src="<?= base_url('assets/success_icon.png') ?>" alt="Success" class="status-icon">
          <h4 class="text-success">PEMBAYARANMU BERHASIL</h4>
          <p>Berhasil melakukan pembayaran via Qris</p>
          <p>Pembayaranmu telah berhasil kami terima, mohon untuk menunggu kami datang, Terima Kasih :)</p>
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal" onclick="window.location.href='<?= base_url('dashboard') ?>'">Ke Home</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade status-modal" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <img src="<?= base_url('assets/error_icon.png') ?>" alt="Confirm Delete" class="status-icon">
          <h4 class="text-danger">Apakah Anda Yakin?</h4>
          <p>Pesananmu akan dihapus, semoga kamu bisa memilih paket yang pas ya :)</p>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Hapus</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade status-modal" id="rentalFinishedModal" tabindex="-1" aria-labelledby="rentalFinishedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <img src="<?= base_url('assets/success_icon.png') ?>" alt="Success" class="status-icon">
          <h4 class="text-success">SEWAANMU SUDAH SELESAI</h4>
          <p>Terima kasih sudah menyewa</p>
          <p>Semoga Anda nyaman dengan pelayanan kami :)</p>
          <div class="rating mb-3">
              <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
          </div>
          <input type="text" class="form-control mb-3" placeholder="Masukkan saran dan komplain">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Ke Home</button>
          <button type="button" class="btn btn-secondary">Keluar</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>