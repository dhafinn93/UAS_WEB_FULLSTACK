@extends('layouts.app')

@section('title', 'Tambah Kos - Admin')

@section('content')

<div class="container py-4">

    <div class="mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fa-solid fa-circle-plus"></i>
            Tambah Data Kos
        </h2>

        <p class="text-muted mb-0">
            Lengkapi form di bawah ini untuk menambahkan kos baru.
        </p>
    </div>

    <div class="card shadow border-0">

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/admin/kos" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama_kos" class="form-label fw-semibold">
                        Nama Kos
                    </label>
                    <input type="text"
                           name="nama_kos"
                           id="nama_kos"
                           class="form-control"
                           placeholder="Contoh: Kos Putri Melati"
                           value="{{ old('nama_kos') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">
                        Alamat
                    </label>
                    <textarea name="alamat"
                              id="alamat"
                              rows="3"
                              class="form-control"
                              placeholder="Masukkan alamat lengkap kos"
                              required>{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="fasilitas" class="form-label fw-semibold">
                        Fasilitas
                    </label>
                    <textarea name="fasilitas"
                              id="fasilitas"
                              rows="3"
                              class="form-control"
                              placeholder="Contoh: WiFi, Kamar Mandi Dalam, AC, Parkir Luas"
                              required>{{ old('fasilitas') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label fw-semibold">
                        Harga (per bulan)
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number"
                               name="harga"
                               id="harga"
                               class="form-control"
                               placeholder="Contoh: 750000"
                               value="{{ old('harga') }}"
                               min="0"
                               required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="foto_kos" class="form-label fw-semibold">
                        Foto Kos
                    </label>
                    <input type="file"
                           name="foto_kos"
                           id="foto_kos"
                           class="form-control"
                           accept="image/*">
                    <div class="form-text">
                        Format gambar: JPG, JPEG, PNG. Opsional.
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan
                    </button>

                    <a href="/admin/kos" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection