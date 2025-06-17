<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Akun DJAYA ASPALT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      background: url("<?= base_url('assets/bg.jpg') ?>") no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,.3);
    }
    .modal-body {
        padding: 30px;
        text-align: center;
    }
  </style>
</head>
<body>

<div class="modal fade show" id="registerFormModalStatic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display: block;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Buat Akun</h5>
        </div>
      <div class="modal-body">
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
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('registerFormModalStatic'));
        myModal.show();

        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('registerPassword');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        document.getElementById('togglePassConfirm').addEventListener('click', function() {
            const passConfirmField = document.getElementById('registerPassConfirm');
            const type = passConfirmField.getAttribute('type') === 'password' ? 'text' : 'password';
            passConfirmField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    });
</script>
</body>
</html>