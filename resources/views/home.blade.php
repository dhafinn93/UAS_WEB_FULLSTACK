@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="hero">
    <div class="container text-center">
        <h1>Cari Kos Impianmu</h1>
        <p class="mt-3">Temukan kos nyaman dengan harga terbaik.</p>

        <form action="/" method="GET" class="row justify-content-center mt-4">
            <div class="col-md-5">
                <input type="text" class="form-control form-control-lg" name="search" value="{{ request('search') }}" placeholder="Cari nama kos...">
            </div>
            <div class="col-md-2 mt-3 mt-md-0">
                <button type="submit" class="btn btn-warning btn-lg w-100">
                    <i class="fa fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
</section>

<div class="container mt-5">
    <h3 class="mb-4">
        <i class="fa-solid fa-house text-primary"></i> Kos Tersedia
    </h3>

    <div class="row">
        @if(isset($kos))
            @forelse($kos as $item)
                <div class="col-md-4 mb-4">
                    <div class="card card-kos h-100">
                        
                        @if($item->foto_kos)
                            <img src="{{ asset('storage/' . $item->foto_kos) }}" class="card-img-top" style="height: 230px; object-fit: cover;" alt="Foto {{ $item->nama_kos }}">
                        @else
                            <img src="https://via.placeholder.com/400x230" class="card-img-top" alt="Placeholder Foto">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                            <p class="card-text text-muted">
                                <i class="fa fa-location-dot text-danger"></i> {{ $item->alamat }}
                            </p>
                            
                            <p class="harga mt-auto">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>
                            <a href="/detail_kos/{{ $item->id }}" class="btn btn-primary w-100">Lihat Detail</a>
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
        @else
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Controller belum mengirim data <b>$kos</b>.
                </div>
            </div>
        @endif
    </div>
</div>
@endsection