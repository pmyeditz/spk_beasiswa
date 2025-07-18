<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memuat...</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f5f8fa;
            margin: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Segoe UI', sans-serif;
        }

        .loader-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 6px solid #e0e0e0;
            border-top-color: #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-text {
            font-size: 1.2rem;
            color: #555;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .loading-gif {
            width: 120px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="loader-container">
        <div class="spinner"></div>
        <p class="loading-text">Sedang memuat, harap tunggu...</p>
        <img src="https://media1.giphy.com/media/TqiwHbFBaZ4ti/giphy.gif" alt="Loading" class="loading-gif" onerror="this.style.display='none'">
    </div>
</body>
</html>
