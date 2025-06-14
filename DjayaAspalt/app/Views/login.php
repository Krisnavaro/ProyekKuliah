<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login DJAYA ASPALT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url("<?= base_url('assets/bg.jpg') ?>") no-repeat center center fixed;
      background-size: cover;
    }

    .login-box {
      max-width: 400px;
      margin: 100px auto;
      padding: 30px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      text-align: center;
    }

    .login-box img {
      width: 280px;
      margin-bottom: 20px;
    }

    h2 {
      font-weight: bold;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="login-box">
  <!-- ✅ LOGO -->
  <img src="<?= base_url('assets/logo.png') ?>" alt="Logo">

  <!-- ✅ Pesan error kalau login gagal -->
  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <!-- ✅ Form login -->
  <form action="<?= base_url('login') ?>" method="post">
    <div class="mb-3 text-start">
      <label for="username" class="form-label">Username:</label>
      <input type="text" class="form-control" name="username" required>
    </div>
    <div class="mb-3 text-start">
      <label for="password" class="form-label">Password:</label>
      <input type="password" class="form-control" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>
</div>

</body>
</html>
