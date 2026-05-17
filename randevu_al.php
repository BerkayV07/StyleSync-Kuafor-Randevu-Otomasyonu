<?php
include 'db_connect.php';
session_start();
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hizmet_id = $_POST['hizmet'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    $user_id = 1;
    $durum = "Onay Bekliyor";

    $kontrol_sorgusu = "SELECT * FROM randevular WHERE tarih='$tarih' AND saat='$saat'";
    $sonuc = $conn->query($kontrol_sorgusu);

    if ($sonuc->num_rows > 0) {
        $mesaj = "<div class='alert alert-danger bg-danger text-white border-0 text-center'>Bu saat dilimi maalesef doludur.</div>";
    } else {
        $sql = "INSERT INTO randevular (user_id, hizmet_id, tarih, saat, durum) VALUES ('$user_id', '$hizmet_id', '$tarih', '$saat', '$durum')";
        if ($conn->query($sql) === TRUE) {
            $mesaj = "<div class='alert alert-success bg-success text-white border-0 text-center'>Randevunuz sisteme işlendi. Onay bekleniyor.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleSync — Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
.text-muted {
    color: #e0e0e0 !important;
}


.studio-card h4 {
    color: #ffffff !important;
    text-shadow: 0 2px 4px rgba(0,0,0,0.8);
}
        body {
    background: linear-gradient(rgba(10, 10, 10, 0.9), rgba(10, 10, 10, 0.9)), 
                url('https://images.unsplash.com/photo-1560066984-138dadb4c035?q=80&w=1920') no-repeat center center fixed !important;
    background-size: cover !important;
    color: #ffffff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.form-select, .form-control, option {
    color: #ffffff !important;
}
input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
}
       
.form-select, .form-control, option {
    color: #ffffff !important;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
}
        .studio-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.03) 0%, rgba(255,255,255,0.01) 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.8);
        }
        .form-label {
            color: #888;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .form-select, .form-control {
            background: #141414;
            border: 1px solid #222;
            color: #fff !important;
            padding: 12px;
            border-radius: 10px;
        }
        .form-select:focus, .form-control:focus {
            background: #1a1a1a;
            border-color: #fc00ff;
            box-shadow: 0 0 15px rgba(252, 0, 255, 0.2);
        }
        .btn-action {
            background: linear-gradient(45deg, #fc00ff, #00dbde);
            border: none;
            color: #fff;
            font-weight: 700;
            padding: 14px;
            border-radius: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s ease;
        }
        .btn-action:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 30px rgba(252, 0, 255, 0.3);
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="studio-card w-100" style="max-width: 550px;">
            <h4 class="text-center mb-2 font-weight-bold" style="letter-spacing: 1px;">RANDEVU REZERVASYONU</h4>
            <p class="text-center text-muted small mb-4">Lütfen almak istediğiniz hizmeti ve zamanı seçin.</p>
            
            <?php echo $mesaj; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Premium Hizmet Seti</label>
                    <select name="hizmet" class="form-select" required>
                        <option value="1">VIP Saç Kesimi & Stil Danışmanlığı — 5000 TL</option>
                        <option value="2">Modern Sakal Tasarımı & Bakım — 1000 TL</option>
                        <option value="3">StyleSync Özel Kombine Paket — 7500 TL</option>
                        <option value="4">Şekilli Fön — 750 TL</option>
                        <option value="5">Saç Yıkama — 200 TL</option>
                        <option value="6">Işıltılı Bakım Hizmeti(Keratin Bakım) — 4000 TL</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tarih</label>
                        <input type="date" name="tarih" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Saat Seansı</label>
                        <select name="saat" class="form-select" required>
                            <option value="10:00">10:00 — Müsait</option>
                            <option value="11:00">11:00 — Müsait</option>
                            <option value="12:00">12:00 — Müsait</option>
                            <option value="13:00">13:00 — Müsait</option>
                            <option value="14:00">14:00 — Müsait</option>
                            <option value="15:00">15:00 — Müsait</option>
                            <option value="16:00">16:00 — Müsait</option>
                            <option value="17:00">17:00 — Müsait</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-action w-100 mt-3">Rezervasyonu Tamamla</button>
            </form>
        </div>
    </div>
</body>
</html>