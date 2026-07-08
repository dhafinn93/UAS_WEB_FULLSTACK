@extends('layouts.app')

@section('title', $kos->nama_kos . ' - Detail Kos')

@section('content')

<div class="container py-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none">Beranda</a>
            </li>
            <li class="breadcrumb-item active">{{ $kos->nama_kos }}</li>
        </ol>
    </nav>

    <div class="row g-4">

        {{-- Kolom Kiri: Foto + Info --}}
        <div class="col-lg-7">

            {{-- Foto Kos --}}
            <div class="rounded-4 overflow-hidden shadow mb-4" style="max-height: 420px;">
                @if($kos->foto_kos)
                    <img src="{{ asset('storage/' . $kos->foto_kos) }}"
                         alt="{{ $kos->nama_kos }}"
                         class="w-100"
                         style="object-fit: cover; height: 420px;">
                @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center"
                         style="height: 420px;">
                        <div class="text-center text-white">
                            <i class="fa-solid fa-house fa-4x mb-2"></i>
                            <p class="mb-0">Foto tidak tersedia</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Info Kos --}}
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">

                    <h3 class="fw-bold text-primary mb-1">{{ $kos->nama_kos }}</h3>

                    <p class="text-muted mb-3">
                        <i class="fa-solid fa-location-dot text-danger me-1"></i>
                        {{ $kos->alamat }}
                    </p>

                    <hr>

                    <h5 class="fw-semibold mb-2">
                        <i class="fa-solid fa-list-check text-primary me-1"></i>
                        Fasilitas
                    </h5>
                    <p class="text-muted">{{ $kos->fasilitas }}</p>

                    <hr>

                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small">Harga per bulan</span>
                            <h4 class="harga mb-0">
                                Rp {{ number_format($kos->harga, 0, ',', '.') }}
                            </h4>
                        </div>

                        @auth
                            @if(Auth::user()->role == 'user')
                                <a href="/user/review/create/{{ $kos->id }}"
                                   class="btn btn-success px-4">
                                    <i class="fa-solid fa-star me-1"></i>
                                    Beri Review
                                </a>
                            @endif
                        @else
                            <a href="/login" class="btn btn-outline-primary px-4">
                                <i class="fa-solid fa-right-to-bracket me-1"></i>
                                Login untuk Review
                            </a>
                        @endauth
                    </div>

                </div>
            </div>

        </div>

        {{-- Kolom Kanan: Statistik Rating + Daftar Review --}}
        <div class="col-lg-5">

            {{-- Statistik Rating --}}
            <div class="card shadow border-0 rounded-4 mb-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        <i class="fa-solid fa-chart-bar text-primary me-1"></i>
                        Statistik Rating
                    </h5>

                    @php
                        $totalReviews = $kos->reviews->count();
                        $avgRating = $totalReviews > 0 ? round($kos->reviews->avg('rating'), 1) : 0;
                    @endphp

                    <div class="d-flex align-items-center gap-4 mb-4">
                        <div class="text-center">
                            <div class="display-4 fw-bold text-warning">{{ $avgRating }}</div>
                            <div>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($avgRating))
                                        <i class="fa-solid fa-star text-warning"></i>
                                    @else
                                        <i class="fa-regular fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="text-muted small">{{ $totalReviews }} ulasan</div>
                        </div>

                        <div class="flex-grow-1">
                            @for($star = 5; $star >= 1; $star--)
                                @php
                                    $count = $kos->reviews->where('rating', $star)->count();
                                    $percent = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                @endphp
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="small text-muted" style="width: 12px;">{{ $star }}</span>
                                    <i class="fa-solid fa-star text-warning small"></i>
                                    <div class="progress flex-grow-1" style="height: 8px;">
                                        <div class="progress-bar bg-warning"
                                             style="width: {{ $percent }}%"></div>
                                    </div>
                                    <span class="small text-muted" style="width: 20px;">{{ $count }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>

                </div>
            </div>

            {{-- Daftar Review --}}
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        <i class="fa-solid fa-comments text-primary me-1"></i>
                        Ulasan Pengguna
                    </h5>

                    @forelse($kos->reviews as $review)

                        <div class="border-bottom pb-3 mb-3">

                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-semibold">
                                    <i class="fa-solid fa-user-circle text-secondary me-1"></i>
                                    {{ $review->user->name ?? 'Anonim' }}
                                </span>
                                <span class="text-muted small">
                                    {{ $review->created_at->format('d M Y') }}
                                </span>
                            </div>

                            <div class="mb-1">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fa-solid fa-star text-warning small"></i>
                                    @else
                                        <i class="fa-regular fa-star text-warning small"></i>
                                    @endif
                                @endfor
                            </div>

                            <p class="text-muted mb-0 small">{{ $review->komentar }}</p>

                        </div>

                    @empty

                        <div class="text-center text-muted py-4">
                            <i class="fa-regular fa-comment-dots fa-2x mb-2 d-block"></i>
                            Belum ada ulasan untuk kos ini.
                            <br>
                            <small>Jadilah yang pertama memberi review!</small>
                        </div>

                    @endforelse

                </div>
            </div>

        </div>

    </div>

</div>

@endsection