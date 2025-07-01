<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset Password - ZtrixDev</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --ztrix-green: #00ffae;
      --ztrix-dark: #0c0f1a;
      --ztrix-panel: #1b1f2f;
      --ztrix-glossy: linear-gradient(135deg, #00ffae, #009970);
      --ztrix-glossy-hover: linear-gradient(135deg, #00e89f, #007f5f);
    }

    body {
      background: var(--ztrix-dark);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      background: var(--ztrix-panel);
      padding: 2.5rem;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0, 255, 174, 0.3);
      width: 100%;
      max-width: 420px;
      transition: 0.4s ease;
    }

    .login-card:hover {
        transform: translateX(6px);
    }

    .brand {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .form-control {
      background: #111;
      border: 1px solid #555;
      color: white;
    }

    .form-control:focus {
      background: #000;
      color: white;
      border-color: var(--ztrix-green);
      box-shadow: 0 0 0 0.2rem rgba(0, 255, 174, 0.25);
    }

    .btn-login {
      background: var(--ztrix-glossy);
      border: none;
      color: black;
      font-weight: bold;
      transition: 0.3s ease;
    }

    .btn-login:hover {
      background: var(--ztrix-glossy-hover);
      color: black;
    }

    .text-danger {
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <div class="brand"><i class="fa-solid fa-lock me-1"></i> Reset Password</div>

    {{-- Tampilkan error --}}
    @if($errors->any())
      <div class="text-danger mb-3">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.reset') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Password Baru</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-login w-100">
        <i class="fa-solid fa-key me-1"></i> Ubah Password
      </button>
    </form>
  </div>

</body>
</html>
