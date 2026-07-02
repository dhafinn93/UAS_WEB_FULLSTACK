@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div class="mb-4">
    <h2 class="fw-bold text-primary">
        Dashboard Admin
    </h2>

    <p class="text-muted mb-0">
        Selamat datang kembali,
        <strong>{{ Auth::user()->name }}</strong>.
        Semoga aktivitas Anda hari ini tidak mumet ya .
    </p>
</div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

        </form>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">

            <div class="card shadow border-0">
                <div class="card-body">

                    <i class="fa-solid fa-house fa-2x text-primary mb-3"></i>

                    <h6>Total Kos</h6>

                    <h2 class="fw-bold text-primary">
                        {{ \App\Models\Kos::count() }}
                    </h2>

                </div>
            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card shadow border-0">
                <div class="card-body">

                    <i class="fa-solid fa-users fa-2x text-success mb-3"></i>

                    <h6>Total User</h6>

                    <h2 class="fw-bold text-success">
                        {{ \App\Models\User::count() }}
                    </h2>

                </div>
            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="card shadow border-0">
                <div class="card-body">

                    <i class="fa-solid fa-user-shield fa-2x text-warning mb-3"></i>

                    <h6>Status</h6>

                    <h3 class="text-warning">
                        Admin Aktif
                    </h3>

                </div>
            </div>

        </div>

    </div>

    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-primary text-white">

            Menu Administrator

        </div>

        <div class="card-body">

            <p>
                Gunakan menu di bawah ini untuk mengelola seluruh data kos.
            </p>

            <a href="/admin/kos" class="btn btn-success">
                <i class="fa-solid fa-circle-plus"></i>
                Tambah Data Kos
            </a>

        </div>

    </div>

</div>

@endsection