<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ZtrixDev Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    :root {
      --ztrix-green: #00ffae;
      --ztrix-dark: #0c0f1a;
      --ztrix-panel: #1b1f2f;
      --ztrix-glossy: linear-gradient(135deg, #00ffae, #009970);
      --ztrix-glossy-hover: linear-gradient(135deg, #00e89f, #008b66);
    }

    body {
      background-color: var(--ztrix-dark);
      color: white;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-card {
      background: var(--ztrix-panel);
      padding: 2rem 2.5rem;
      border-radius: 15px;
      box-shadow: 0 0 30px rgba(0, 255, 174, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .login-card:hover {
      box-shadow: 0 0 30px rgba(0, 255, 174, 0.3);
    }

    .form-control {
      background-color: #121421;
      border: 1px solid #00ffae;
      color: white;
    }

    .form-control:focus {
      border-color: #00ffae;
      box-shadow: 0 0 0 0.2rem rgba(0, 255, 174, 0.25);
      background-color: #1c1f2d;
      color: white;
    }

    .btn-login {
      background: var(--ztrix-glossy);
      color: black;
      border: none;
      transition: 0.3s;
    }

    .btn-login:hover {
      background: var(--ztrix-glossy-hover);
    }

    .brand {
      font-size: 1.8rem;
      font-weight: bold;
      color: var(--ztrix-green);
      text-align: center;
      margin-bottom: 1rem;
    }

    .form-label {
      font-weight: 500;
    }

    .form-check-label {
      color: #ccc;
    }

    .form-link {
      color: var(--ztrix-green);
      text-decoration: none;
      font-size: 0.9rem;
    }

    .form-link:hover {
      text-decoration: underline;
    }
  </style>
  <head>
<body>
    <div class="login-card">
        <div class="brand"><i class="fa-solid fa-user-lock me-1"></i> SPK BEASISWA</div>
        @if(session('error'))
            <p style="color:red">{{ session('error') }}</p>
        @endif
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
              </div>
              <a href="{{ route('password.request') }}" class="form-link">Lupa password?</a>
            </div>

            <button type="submit" class="btn btn-login w-100">
              <i class="fa-solid fa-sign-in-alt me-1"></i> Login
            </button>
          </form>

        </div>
    </div>
    </form>
</body>
</html>
