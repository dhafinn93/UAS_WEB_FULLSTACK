@extends('layouts.app')

@section('title', 'Review Saya')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold text-primary">
                <i class="fa-solid fa-star"></i>
                Review Saya
            </h2>
            <p class="text-muted mb-0">
                Semua review yang telah kamu berikan untuk kos.
            </p>
        </div>

        <a href="/user/dashboard" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Dashboard
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Kos</th>
                            <th style="width: 120px;">Rating</th>
                            <th>Komentar</th>
                            <th style="width: 120px;">Tanggal</th>
                            <th style="width: 140px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($reviews as $review)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td class="fw-semibold">
                                    {{ $review->kos->nama_kos ?? '-' }}
                                </td>

                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    <span class="ms-1 text-muted small">({{ $review->rating }}/5)</span>
                                </td>

                                <td>
                                    {{ Str::limit($review->komentar, 80) }}
                                </td>

                                <td class="text-muted small">
                                    {{ $review->created_at->format('d M Y') }}
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="/user/review/{{ $review->id }}/edit"
                                           class="btn btn-warning btn-sm text-white">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="/user/review/{{ $review->id }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus review ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="fa-regular fa-star fa-2x mb-2 d-block"></i>
                                    Kamu belum memberi review apapun.
                                    <br>
                                    <a href="/user/dashboard" class="btn btn-primary btn-sm mt-3">
                                        Lihat Daftar Kos
                                    </a>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection