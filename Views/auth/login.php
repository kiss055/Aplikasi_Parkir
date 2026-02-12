<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Parkir | Smart Parking</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root { --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }

        body {
            margin: 0; font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc;
            background-image: radial-gradient(at 0% 0%, rgba(102, 126, 234, 0.15) 0, transparent 50%), 
                              radial-gradient(at 100% 100%, rgba(118, 75, 162, 0.15) 0, transparent 50%);
            display: flex; justify-content: center; align-items: center; height: 100vh; overflow: hidden;
        }

        .login-container { width: 100%; max-width: 400px; padding: 20px; animation: fadeInUp 0.8s ease-out; }

        .card {
            background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);
            padding: 40px; border-radius: 28px; box-shadow: 0 25px 50px -12px rgba(102, 126, 234, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.7); text-align: center;
        }

        .brand-logo {
            width: 70px; height: 70px; background: var(--primary-gradient);
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 25px; color: white; font-size: 32px;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        h2 { color: #1e293b; font-weight: 800; margin-bottom: 8px; letter-spacing: -1px; }
        p.subtitle { color: #64748b; font-size: 14px; margin-bottom: 35px; }

        .form-group { position: relative; margin-bottom: 20px; }
        .form-group i { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #94a3b8; transition: 0.3s; }

        input {
            width: 100%; height: 56px; padding: 10px 20px 10px 52px;
            background: #f1f5f9; border-radius: 16px; border: 2px solid transparent;
            font-size: 15px; font-weight: 600; color: #1e293b; box-sizing: border-box; transition: all 0.3s;
        }

        input:focus { outline: none; background: white; border-color: #667eea; box-shadow: 0 0 0 5px rgba(102, 126, 234, 0.1); }
        input:focus + i { color: #667eea; }

        button {
            width: 100%; height: 56px; background: var(--primary-gradient); color: white;
            font-weight: 700; font-size: 16px; border: none; border-radius: 16px;
            cursor: pointer; margin-top: 15px; transition: all 0.3s;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        button:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4); }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<?php if(isset($_SESSION['alert'])): ?>
<script>
Swal.fire({
    icon: '<?= $_SESSION['alert']['icon'] ?>',
    title: '<?= $_SESSION['alert']['title'] ?>',
    text: '<?= $_SESSION['alert']['text'] ?>',
    timer: 2500,
    showConfirmButton: false,
    customClass: { popup: 'rounded-5' }
});
</script>
<?php unset($_SESSION['alert']); endif; ?>

<div class="login-container">
    <div class="card">
        <div class="brand-logo">
            <i class="fas fa-parking"></i>
        </div>
        
        <h2>Smart Parking</h2>
        <p class="subtitle">Akses akun manajemen parkir Anda</p>

        <form method="post" action="../../Controller/proses_login.php">
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required autocomplete="off">
            </div>

            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" name="login">
                Masuk ke Sistem <i class="fas fa-sign-in-alt ms-2"></i>
            </button>
        </form>

        <div style="margin-top: 30px; font-size: 12px; color: #cbd5e1; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
            &copy; <?= date('Y') ?> E-Parking Pro
        </div>
    </div>
</div>

</body>
</html>
