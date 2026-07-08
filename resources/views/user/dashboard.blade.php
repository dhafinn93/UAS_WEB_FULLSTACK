@extends('layouts.app')

@section('title', 'Dashboard Pengguna')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary">
                <i class="fa-solid fa-user"></i> Dashboard Pengguna
            </h2>
            <p class="text-muted">
                Selamat datang, Anomali <strong>{{ Auth::user()->name }}</strong>
            </p>
        </div>
        <div>
            <a href="/user/review" class="btn btn-success">
                <i class="fa-solid fa-star"></i> Review Saya
            </a>
        </div>
    </div>

    {{-- Search --}}
    <div class="mb-5 mt-4">
        <form method="GET" class="row justify-content-center">
            
            <div class="col-md-5">
                <input 
                    type="text" 
                    class="form-control form-control-lg" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari nama kos...">
            </div>

            <div class="col-md-2 mt-3 mt-md-0">
                <button type="submit" class="btn btn-warning btn-lg w-100 fw-bold">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                </button>
            </div>

        </form>
    </div>

    {{-- Daftar Kos --}}
    <h3 class="mb-4">
        <i class="fa-solid fa-house text-primary"></i> Kos Tersedia
    </h3>

    <div class="row">
        @forelse($kos as $item)
            <div class="col-md-4 mb-4">
                <div class="card card-kos shadow border-0 h-100">
                    
                    @if($item->foto_kos)
                        <img src="{{ asset('storage/' . $item->foto_kos) }}" class="card-img-top" style="height:230px; object-fit:cover;">
                    @else
                        <img src="https://placehold.co/600x400?text=Kos" class="card-img-top" style="height:230px; object-fit:cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold">{{ $item->nama_kos }}</h5>
                        
                        <p class="text-muted">
                            <i class="fa-solid fa-location-dot text-danger"></i> {{ $item->alamat }}
                        </p>
                        
                        <p>{{ $item->fasilitas }}</p>
                        
                        <h5 class="text-primary fw-bold">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </h5>

                        <div class="mt-auto d-grid gap-2">
                            <a href="/detail_kos/{{ $item->id }}" class="btn btn-primary">
                                <i class="fa-solid fa-eye"></i> Lihat Detail
                            </a>
                            <a href="/user/review/create/{{ $item->id }}" class="btn btn-success">
                                <i class="fa-solid fa-star"></i> Beri Review
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Belum ada data kos.
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection