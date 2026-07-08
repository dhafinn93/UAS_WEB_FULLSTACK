@extends('layouts.app')

@section('title', 'Edit Review')

@section('content')

<div class="container py-4">

    <div class="mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fa-solid fa-pen-to-square"></i>
            Edit Review
        </h2>
        <p class="text-muted mb-0">
            Perbarui review kamu untuk kos ini.
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

            <form action="/user/review/{{ $review->id }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Pilih Kos --}}
                <div class="mb-3">
                    <label for="kos_id" class="form-label fw-semibold">
                        Nama Kos
                    </label>
                    <select name="kos_id"
                            id="kos_id"
                            class="form-select @error('kos_id') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Kos --</option>
                        @foreach($kos as $item)
                            <option value="{{ $item->id }}"
                                {{ (old('kos_id', $review->kos_id) == $item->id) ? 'selected' : '' }}>
                                {{ $item->nama_kos }}
                            </option>
                        @endforeach
                    </select>
                    @error('kos_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                                       {{ old('rating', $review->rating) == $i ? 'checked' : '' }}
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
                              placeholder="Ceritakan pengalamanmu mengenai kos ini..."
                              maxlength="1000"
                              required>{{ old('komentar', $review->komentar) }}</textarea>
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
                        Simpan Perubahan
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

    // Set state awal dari nilai review yang sudah ada
    const checkedRating = document.querySelector('input[name="rating"]:checked');
    if (checkedRating) updateStars(parseInt(checkedRating.value));

    labels.forEach((label, index) => {
        label.addEventListener('mouseover', () => updateStars(index + 1));
        label.addEventListener('mouseout', () => {
            const checked = document.querySelector('input[name="rating"]:checked');
            updateStars(checked ? parseInt(checked.value) : 0);
        });
        label.addEventListener('click', () => updateStars(index + 1));
    });

    // Karakter counter
    const komentar = document.getElementById('komentar');
    const charCount = document.getElementById('char-count');
    charCount.textContent = komentar.value.length;
    komentar.addEventListener('input', () => {
        charCount.textContent = komentar.value.length;
    });
</script>
@endpush