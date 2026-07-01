<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Sistem Informasi Kos')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>

    body{
        font-family:'Segoe UI',sans-serif;
        background:#f5f5f5;
    }

    .navbar{
        background:#0d6efd;
    }

    .navbar-brand,
    .nav-link{
        color:white!important;
    }

    .hero{
        background:linear-gradient(to right,#0d6efd,#2b8fff);
        color:white;
        padding:90px 0;
    }

    .hero h1{
        font-weight:bold;
    }

    .card-kos{
        transition:.3s;
        border:none;
        border-radius:15px;
    }

    .card-kos:hover{
        transform:translateY(-8px);
        box-shadow:0 10px 25px rgba(0,0,0,.2);
    }

    footer{
        background:#222;
        color:white;
        padding:20px;
        margin-top:70px;
    }

    .harga{
        color:#0d6efd;
        font-weight:bold;
        font-size:18px;
    }

    </style>

    @stack('css')

</head>
<body>

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand" href="/">
<i class="fa-solid fa-house"></i>
 SI-KOS
</a>

<button class="navbar-toggler"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="/">Home</a>
</li>

@guest

<li class="nav-item">
<a class="nav-link" href="/login">
Login
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="/register">
Register
</a>
</li>

@endguest

@auth

@if(Auth::user()->role=='admin')

<li class="nav-item">
<a class="nav-link"
href="/admin/dashboard">
Dashboard
</a>
</li>

@else

<li class="nav-item">
<a class="nav-link"
href="/user/dashboard">
Dashboard
</a>
</li>

@endif

<li class="nav-item">

<form action="{{route('logout')}}"
method="POST">

@csrf

<button class="btn btn-danger btn-sm">
Logout
</button>

</form>

</li>

@endauth

</ul>

</div>

</div>

</nav>

@yield('content')

<footer>

<div class="container text-center">

<h5>Sistem Informasi Kos</h5>

<p>
Temukan kos terbaik dengan mudah dan cepat.
</p>

<p>
© {{ date('Y') }} SI-KOS
</p>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

@stack('js')

</body>
</html>