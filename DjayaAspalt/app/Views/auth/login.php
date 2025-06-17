<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - DJAYA ASPALT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url("<?= base_url('images/splash-bg.png') ?>") no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-container {
            background-color: rgba(255,255,255,0.95);
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 0 30px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 100%;
        }
        .login-container img {
            width: 120px;
            margin-bottom: 20px;
            border-radius: 50%;
        }
        h2 {
            margin-bottom: 10px;
            color: #000;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #E53935;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #C62828;
        }
        .footer {
            margin-top: 15px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="<?= base_url('images/logo.png') ?>" alt="DJAYA ASPALT" style="width: 200px; margin-top: 10px;">
        <form action="<?= base_url('/login') ?>" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>
        <div class="footer">© <?= date('Y') ?> DJAYA ASPALT GANG</div>
    </div>
</body>

</html>
