<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi Akun Guru</title>
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
            font-size: 24px;
            color: #22c55e;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
        }
        .info-list {
            list-style-type: none;
            padding-left: 0;
            margin: 20px 0;
            color: #ffffff;
        }
        .info-list li {
            background-color: #1e293b;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-left: 5px solid #22c55e;
            border-radius: 6px;
        }
        .info-list strong {
            color: #22c55e;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #94a3b8;
        }
        a {
            color: #38bdf8;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Informasi Akun Guru</div>
        <div class="content">
            <p>Halo <strong>{{ $nama }}</strong>,</p>
            <p>Berikut adalah informasi akun Anda untuk sistem <strong>SPK Beasiswa</strong>:</p>

            <ul class="info-list">
                <li><strong>Username:</strong> {{ $username }}</li>
                <li><strong>Password:</strong> {{ $password }}</li>
                <li><strong>Email:</strong> {{ $email }}</li>
                <li><strong>Role:</strong> {{ ucfirst(str_replace('_', ' ', $role)) }}</li>
            </ul>

            <p>Silakan login dan segera <strong>ubah password</strong> Anda setelah berhasil masuk demi keamanan akun Anda.</p>

            <p>Salam hormat,</p>
            <p><strong>Admin SPK Beasiswa</strong></p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Sistem SPK Beasiswa. Semua hak dilindungi.
        </div>
    </div>
</body>
</html>
