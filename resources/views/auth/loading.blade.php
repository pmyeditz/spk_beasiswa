<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Memuat...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg-color: #0d1117;
            --text-color: #c9d1d9;
            --accent: #58a6ff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            background: var(--bg-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            flex-direction: column;
        }

        .loader {
            width: 80px;
            height: 80px;
            border: 10px solid #1f2937;
            border-top: 10px solid var(--accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        h2 {
            margin-top: 30px;
            font-weight: 400;
            font-size: 20px;
            text-align: center;
        }

        .dots span {
            animation: blink 1.5s infinite;
        }

        .dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes blink {
            0%, 100% {
                opacity: 0.2;
            }
            50% {
                opacity: 1;
            }
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="loader"></div>
    <h2>{{ $message ?? 'Mohon tunggu, sedang memproses' }}<span class="dots"><span>.</span><span>.</span><span>.</span></span></h2>

    <div class="footer">© {{ date('Y') }} Sistem Beasiswa by ztrixdev</div>

    <script>
        setTimeout(() => {
            window.location.href = "{{ $redirectTo ?? url('/dashboard') }}";
        }, 5000);
    </script>
</body>
</html>
