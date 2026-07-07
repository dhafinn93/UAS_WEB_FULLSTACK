@extends('layouts.app')

@section('title', 'Data Kos - Admin')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold text-primary">
                <i class="fa-solid fa-house"></i>
                Data Kos
            </h2>

            <p class="text-muted mb-0">
                Kelola seluruh data kos yang terdaftar di sistem.
            </p>
        </div>

        <a href="/admin/kos/create" class="btn btn-success">
            <i class="fa-solid fa-circle-plus"></i>
            Tambah Kos
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
                            <th style="width: 60px;">No</th>
                            <th style="width: 120px;">Foto</th>
                            <th>Nama Kos</th>
                            <th>Alamat</th>
                            <th>Fasilitas</th>
                            <th>Harga</th>
                            <th style="width: 160px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($kos as $item)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    @if($item->foto_kos)
                                        <img src="{{ asset('storage/'.$item->foto_kos) }}"
                                             alt="{{ $item->nama_kos }}"
                                             class="rounded"
                                             style="width: 90px; height: 65px; object-fit: cover;">
                                    @else
                                        <span class="text-muted small">
                                            Tidak ada foto
                                        </span>
                                    @endif
                                </td>

                                <td class="fw-semibold">
                                    {{ $item->nama_kos }}
                                </td>

                                <td>
                                    {{ Str::limit($item->alamat, 50) }}
                                </td>

                                <td>
                                    {{ Str::limit($item->fasilitas, 50) }}
                                </td>

                                <td class="harga">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="/admin/kos/{{ $item->id }}/edit"
                                           class="btn btn-warning btn-sm text-white">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="/admin/kos/{{ $item->id }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data kos ini?');">
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
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada data kos.
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