<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kode OTP Reset Password - SPK Beasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0f172a;
            color: #ffffff;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #22c55e;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 255, 128, 0.2);
        }
        .title {
            font-size: 20px;
            color: #22c55e;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        .otp-box {
            background-color: #22c55e;
            color: #000000;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            padding: 16px;
            margin: 20px 0;
            border-radius: 10px;
            letter-spacing: 4px;
        }
        .warning {
            color: #facc15;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
        }
        a {
            color: #38bdf8;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Kode OTP Reset Password</div>

        <p>Halo, <strong>{{ $nama }}</strong> ({{ $email }})</p>

        <p>Kami menerima permintaan untuk mengatur ulang password akun Anda di <strong>SPK Beasiswa</strong>.</p>

        <div class="otp-box">{{ $otp }}</div>

        <p class="warning">⛔ Jangan bagikan kode ini kepada siapapun, termasuk pihak yang mengaku dari SPK Beasiswa.</p>

        <p>Kode ini hanya berlaku selama <strong>5 menit</strong>.</p>

        <p>Jika Anda tidak merasa meminta kode ini, abaikan saja email ini.</p>

        <div class="footer">
            &copy; {{ date('Y') }} SPK Beasiswa. Semua hak dilindungi.
        </div>
    </div>
</body>
</html>
