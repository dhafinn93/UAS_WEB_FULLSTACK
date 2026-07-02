@extends('layouts.app')

@section('title','Dashboard User')

@section('content')

<div class="container py-5">

    <div class="mb-4">

        <h2 class="fw-bold text-primary">
            <i class="fa-solid fa-user"></i>
            Dashboard Pengguna
        </h2>

        <p class="text-muted">
            Selamat datang,
            <strong>{{ Auth::user()->name }}</strong>
        </p>

    </div>

    {{-- Search --}}

    <div class="card shadow border-0 mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-10">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari nama kos...">

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary w-100">

                            <i class="fa fa-search"></i>
                            Cari

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Daftar Kos --}}

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            Daftar Kos

        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nama Kos</th>
                        <th>Harga</th>
                        <th>Alamat</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($kos as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->nama }}</td>

                        <td>

                            Rp {{ number_format($item->harga) }}

                        </td>

                        <td>{{ $item->alamat }}</td>

                        <td>

                            <a
                                href="/kos/{{ $item->id }}"
                                class="btn btn-info btn-sm">

                                <i class="fa fa-eye"></i>

                                Detail

                            </a>

                            <a
                                href="/user/review/create?kos={{ $item->id }}"
                                class="btn btn-success btn-sm">

                                <i class="fa fa-star"></i>

                                Review

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            Belum ada data kos.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection