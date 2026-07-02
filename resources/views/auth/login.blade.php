<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kos Impianmu</title>

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

        .card-login{
            width:420px;
            border:none;
            border-radius:18px;
            box-shadow:0 10px 30px rgba(0,0,0,.2);
        }

        .btn-login{
            background:#ffc107;
            border:none;
            font-weight:bold;
        }

        .btn-login:hover{
            background:#ffb300;
        }

        a{
            text-decoration:none;
        }
    </style>
</head>
<body>

<div class="card card-login">
    <div class="card-body p-5">

        <a href="/" class="btn btn-danger btn-sm position-absolute top-0 start-0 m-3 shadow-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>

        <h2 class="text-center text-primary fw-bold">
            Kos Impianmu
        </h2>

        <p class="text-center text-muted mb-4">
            Selamat Datang Kembali
        </p>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan Email"
                    required>
            </div>

            <div class="mb-4">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan Password"
                    required>
            </div>

            <button type="submit" class="btn btn-login w-100">
                Login
            </button>

        </form>

        <hr>

        <div class="text-center">
            Belum punya akun?
            <a href="/register">Daftar</a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>