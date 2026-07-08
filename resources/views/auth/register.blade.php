<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kos Impianmu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            margin:0;
            height:100vh;
            background:linear-gradient(135deg,#0d6efd,#32a8ff);
            display:flex;
            justify-content:center;
            align-items:center;
            font-family:'Segoe UI',sans-serif;
        }

        .card-register{
            width:450px;
            border:none;
            border-radius:18px;
            box-shadow:0 10px 30px rgba(0,0,0,.2);
        }

        .btn-register{
            background:#ffc107;
            border:none;
            font-weight:bold;
        }

        .btn-register:hover{
            background:#ffb300;
        }

        a{
            text-decoration:none;
        }

        .toggle-password {
            cursor: pointer;
            color: #6c757d;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #0d6efd;
        }
    </style>

</head>

<body>

<div class="card card-register">

    <div class="card-body p-5">

        <a href="/login" class="btn btn-danger btn-sm position-absolute top-0 start-0 m-3 shadow-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>

        <h2 class="text-center text-primary fw-bold">
            Kos Impianmu
        </h2>

        <p class="text-center text-muted mb-4">
            Buat Akun Baru
        </p>

        {{-- Notifikasi Error --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Masukkan Nama"
                    value="{{ old('name') }}"
                    required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan Email"
                    value="{{ old('email') }}"
                    required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <div class="input-group">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Masukkan Password"
                        required>
                    <span class="input-group-text toggle-password" onclick="togglePassword('password', 'icon-password')">
                        <i class="bi bi-eye" id="icon-password"></i>
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <label>Konfirmasi Password</label>
                <div class="input-group">
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi Password"
                        required>
                    <span class="input-group-text toggle-password" onclick="togglePassword('password_confirmation', 'icon-confirm')">
                        <i class="bi bi-eye" id="icon-confirm"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-register w-100">
                Daftar
            </button>

        </form>

        <hr>

        <div class="text-center">
            Sudah punya akun?
            <a href="/login">Login</a>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>

</body>
</html>