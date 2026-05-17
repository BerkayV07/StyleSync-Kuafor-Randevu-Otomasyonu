<?php
// index.php - Premium Giriş Ekranı
include 'db_connect.php';
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];
    if($email == "berkay@stylesync.com" && $sifre == "123456") {
        $_SESSION['user'] = "Berkay Vardar";
        header("Location: randevu_al.php");
        exit();
    } else {
        $error = "Hatalı e-posta veya şifre girdiniz!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleSync — Luxury Hair Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
    background: linear-gradient(rgba(10, 10, 10, 0.85), rgba(10, 10, 10, 0.85)), 
                url('https://images.unsplash.com/photo-1560066984-138dadb4c035?q=80&w=1920') no-repeat center center fixed !important;
    background-size: cover !important;
    color: #ffffff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
        
.form-control {
    color: #ffffff !important;
}


.form-label {
    color: #b3b3b3 !important;
}

.text-muted {
    color: #a0a0a0 !important;
}

.form-control::placeholder {
    color: #666666 !important;
    opacity: 1;
}
        .login-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }
        .brand-title {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: 4px;
            text-transform: uppercase;
            background: linear-gradient(45deg, #00dbde, #fc00ff);
            -webkit-background-clip: text;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff !important;
            border-radius: 8px;
            padding: 12px;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #00dbde;
            box-shadow: 0 0 15px rgba(0, 219, 222, 0.2);
        }
        .btn-premium {
            background: linear-gradient(45deg, #00dbde, #00c6ff);
            border: none;
            color: #000;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 14px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 219, 222, 0.4);
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-card" style="width: 420px;">
            <div class="text-center mb-4">
                <div class="brand-title mb-1">StyleSync</div>
                <small class="text-muted text-uppercase" style="letter-spacing: 2px;">Exclusive Hair Studio</small>
            </div>
            
            <?php if($error != ""): ?>
                <div class="alert alert-danger bg-danger text-white border-0 text-center py-2"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label text-muted small text-uppercase">E-posta Adresi</label>
                    <input type="email" name="email" class="form-control" required placeholder="berkay@stylesync.com">
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted small text-uppercase">Şifre</label>
                    <input type="password" name="sifre" class="form-control" required placeholder="******">
                </div>
                <button type="submit" class="btn btn-premium w-100">Oturum Aç</button>
            </form>
        </div>
    </div>
</body>
</html>