@extends('layouts.app')

@section('title', 'Beri Review - ' . $kos->nama_kos)

@section('content')

<div class="container py-4">

    <div class="mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fa-solid fa-star"></i>
            Beri Review
        </h2>
        <p class="text-muted mb-0">
            Tulis pengalamanmu tentang <strong>{{ $kos->nama_kos }}</strong>.
        </p>
    </div>

    {{-- Info Kos --}}
    <div class="card border-0 bg-primary bg-opacity-10 mb-4">
        <div class="card-body d-flex align-items-center gap-3">
            @if($kos->foto_kos)
                <img src="{{ asset('storage/' . $kos->foto_kos) }}"
                     alt="{{ $kos->nama_kos }}"
                     class="rounded"
                     style="width: 80px; height: 60px; object-fit: cover;">
            @else
                <div class="rounded bg-secondary d-flex align-items-center justify-content-center"
                     style="width: 80px; height: 60px;">
                    <i class="fa-solid fa-house text-white"></i>
                </div>
            @endif
            <div>
                <h6 class="fw-bold mb-0">{{ $kos->nama_kos }}</h6>
                <small class="text-muted">
                    <i class="fa-solid fa-location-dot text-danger"></i>
                    {{ $kos->alamat }}
                </small>
            </div>
        </div>
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

            <form action="/user/review" method="POST">
                @csrf

                {{-- Hidden field kos_id --}}
                <input type="hidden" name="kos_id" value="{{ $kos->id }}">

                {{-- Rating --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Rating</label>
                    <div class="d-flex gap-2 align-items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input visually-hidden"
                                       type="radio"
                                       name="rating"
                                       id="rating{{ $i }}"
                                       value="{{ $i }}"
                                       {{ old('rating') == $i ? 'checked' : '' }}
                                       required>
                                <label class="form-check-label fs-4 star-label"
                                       for="rating{{ $i }}"
                                       style="cursor: pointer; color: #ccc;">
                                    <i class="fa-solid fa-star"></i>
                                </label>
                            </div>
                        @endfor
                        <span class="text-muted small ms-2" id="rating-text">Pilih rating</span>
                    </div>
                    @error('rating')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Komentar --}}
                <div class="mb-4">
                    <label for="komentar" class="form-label fw-semibold">
                        Komentar
                    </label>
                    <textarea name="komentar"
                              id="komentar"
                              rows="5"
                              class="form-control @error('komentar') is-invalid @enderror"
                              placeholder="Ceritakan Pengalaman Horor mu..."
                              maxlength="1000"
                              required>{{ old('komentar') }}</textarea>
                    <div class="form-text text-end">
                        <span id="char-count">0</span>/1000 karakter
                    </div>
                    @error('komentar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Kirim Review
                    </button>

                    <a href="/user/review" class="btn btn-danger">
                        <i class="fa-solid fa-arrow-left"></i>
                        Batal
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('js')
<script>
    // Star rating interaktif
    const labels = document.querySelectorAll('.star-label');
    const radios = document.querySelectorAll('input[name="rating"]');
    const ratingText = document.getElementById('rating-text');
    const descriptions = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];

    function updateStars(value) {
        labels.forEach((label, index) => {
            label.style.color = index < value ? '#f5a623' : '#ccc';
        });
        ratingText.textContent = value ? descriptions[value] + ` (${value}/5)` : 'Pilih rating';
    }

    labels.forEach((label, index) => {
        label.addEventListener('mouseover', () => updateStars(index + 1));
        label.addEventListener('mouseout', () => {
            const checked = document.querySelector('input[name="rating"]:checked');
            updateStars(checked ? parseInt(checked.value) : 0);
        });
        label.addEventListener('click', () => updateStars(index + 1));
    });

    // Set initial state jika old('rating') ada
    const checkedRating = document.querySelector('input[name="rating"]:checked');
    if (checkedRating) updateStars(parseInt(checkedRating.value));

    // Karakter counter
    const komentar = document.getElementById('komentar');
    const charCount = document.getElementById('char-count');
    charCount.textContent = komentar.value.length;
    komentar.addEventListener('input', () => {
        charCount.textContent = komentar.value.length;
    });
</script>
@endpush