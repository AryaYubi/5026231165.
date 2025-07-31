<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - BPR Artha Galunggung</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-card {
            max-width: 450px;
            width: 100%;
            border: none;
            border-radius: 0.75rem;
        }
    </style>
</head>
<body>

<div class="card login-card shadow-lg">
    <div class="card-body p-5">
        <div class="text-center mb-4">
            <img src="https://bprarthagalunggung.co.id/wp-content/uploads/2022/11/Logo_Wide-e1667361197208.png" alt="Logo BPR Artha Galunggung" style="max-width: 180px;">
            <h3 class="mt-4 fw-bold" style="color: #0d47a1;">Login Admin</h3>
            <p class="text-muted">PT BPR Artha Galunggung</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 text-center" role="alert">
                <small>Username atau password salah.</small>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input id="username" class="form-control" type="text" name="username" value="{{ old('username') }}" required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary fw-bold">
                    LOGIN
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
