@extends('layouts.app')

@section('title','Dashboard Pengguna')

@section('content')

<div class="container py-5">

    {{-- Header --}}
    <div class="row align-items-center mb-4">

        <div class="col-md-8">

            <h2 class="fw-bold text-primary">
                <i class="fa-solid fa-user"></i>
                Dashboard Pengguna
            </h2>

            <p class="text-muted mb-0">
                Selamat datang,
                <strong>{{ Auth::user()->name }}</strong>.
                Temukan kos terbaik sesuai kebutuhan Anda.
            </p>

        </div>

        <div class="col-md-4">

            <form action="/user/dashboard" method="GET">

                <div class="input-group">

                    <input
                        type="text"
                        class="form-control"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama kos...">

                    <button class="btn btn-primary">

                        <i class="fa-solid fa-magnifying-glass"></i>

                    </button>

                </div>

            </form>

        </div>

    </div>

    {{-- Statistik --}}

    <div class="row mb-4">

        <div class="col-md-6">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-house fa-3x text-primary mb-3"></i>

                    <h5>Total Kos</h5>

                    <h2 class="fw-bold text-primary">

                        {{ $kos->count() }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <i class="fa-solid fa-star fa-3x text-warning mb-3"></i>

                    <h5>Review Saya</h5>

                    <h2 class="fw-bold text-warning">

                        {{ \App\Models\Review::where('user_id',Auth::id())->count() }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    {{-- Daftar Kos --}}

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <i class="fa-solid fa-house"></i>

            Daftar Kos

        </div>

        <div class="card-body">

            <div class="row">

                @forelse($kos as $item)

                <div class="col-md-4 mb-4">

                    <div class="card h-100 shadow-sm border-0">

                        <img src="{{ asset('storage/'.$item->gambar) }}"
                             class="card-img-top"
                             style="height:220px;object-fit:cover;">

                        <div class="card-body">

                            <h5 class="fw-bold">

                                {{ $item->nama }}

                            </h5>

                            <p class="text-muted">

                                <i class="fa-solid fa-location-dot"></i>

                                {{ $item->alamat }}

                            </p>

                            <h5 class="text-primary">

                                Rp {{ number_format($item->harga) }}

                            </h5>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <div class="d-grid gap-2">

                                <a href="/kos/{{ $item->id }}"
                                   class="btn btn-primary">

                                    <i class="fa-solid fa-eye"></i>

                                    Detail

                                </a>

                                <button
                                    class="btn btn-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="#review{{ $item->id }}">

                                    <i class="fa-solid fa-star"></i>

                                    Beri Review

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Modal Review --}}

                <div class="modal fade"
                     id="review{{ $item->id }}"
                     tabindex="-1">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <form action="/user/review"
                                  method="POST">

                                @csrf

                                <div class="modal-header">

                                    <h5>

                                        Review

                                        {{ $item->nama }}

                                    </h5>

                                    <button
                                        class="btn-close"
                                        data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <input
                                        type="hidden"
                                        name="kos_id"
                                        value="{{ $item->id }}">

                                    <div class="mb-3">

                                        <label>

                                            Rating

                                        </label>

                                        <select
                                            name="rating"
                                            class="form-select">

                                            <option value="5">★★★★★</option>
                                            <option value="4">★★★★☆</option>
                                            <option value="3">★★★☆☆</option>
                                            <option value="2">★★☆☆☆</option>
                                            <option value="1">★☆☆☆☆</option>

                                        </select>

                                    </div>

                                    <div class="mb-3">

                                        <label>

                                            Komentar

                                        </label>

                                        <textarea
                                            class="form-control"
                                            name="komentar"
                                            rows="4"
                                            required></textarea>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <button
                                        class="btn btn-success">

                                        Simpan Review

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

                @empty

                <div class="col-12">

                    <div class="alert alert-warning">

                        Belum ada data kos.

                    </div>

                </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection