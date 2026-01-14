<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Aplikasi Parkir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg, #667eea, #764ba2);
            height:100vh;
        }
        .card{
            border-radius:1rem;
            box-shadow:0 10px 30px rgba(0,0,0,.2);
        }
        .btn-custom{
            background:#667eea;
            color:white;
        }
    </style>
</head>
<body class="d-flex align-items-center">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card p-4">
                <h4 class="text-center mb-3 fw-bold">Login Parkir</h4>

                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger text-center">
                        Username / Password salah
                    </div>
                <?php endif; ?>

                <form action="proses.php" method="POST">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn btn-custom w-100" type="submit">
                        Login
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>