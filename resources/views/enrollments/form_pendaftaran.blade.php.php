@extends('layouts.app')

@section('title', 'Pendaftaran Kursus')

@section('content')
<style>
    /* Header Judul Biru Navy */
    .header-pendaftaran {
        background-color: #1e3a8a; /* Biru Navy */
        color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 25px;
        box-shadow: 0 4px 10px rgba(30, 58, 138, 0.3);
    }

    /* Tombol Kirim Biru Navy */
    .btn-kirim {
        background-color: #1e3a8a; /* Biru Navy */
        color: white;
        font-weight: bold;
        font-size: 1.1rem;
        padding: 12px;
        border-radius: 8px;
        border: none;
        width: 100%;
        transition: all 0.3s ease;
    }
    .btn-kirim:hover {
        background-color: #172554;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(30, 58, 138, 0.4);
    }

    /* Kotak Default Sebelum Memilih Kursus (Ajax) */
    #availability.alert-secondary {
        background-color: #f8fafc !important;
        color: #475569 !important;
        border: 2px dashed #cbd5e1 !important;
        border-radius: 8px;
        font-weight: 500;
    }

    /* Kotak Setelah Memilih Kursus (Ajax Sukses) */
    #availability.alert-success {
        background-color: #dbeafe !important; /* Biru Muda */
        color: #1e3a8a !important; /* Biru Navy */
        border: 2px solid #3b82f6 !important; /* Border Biru */
        border-radius: 8px;
        font-weight: 700;
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.4);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- JUDUL DALAM KOTAK BIRU -->
                    <div class="header-pendaftaran">
                        <h1 class="h3 fw-bold mb-1">Pendaftaran Kursus</h1>
                        <p class="mb-0 text-white-50">Gunakan data pribadi. Field bertanda <span class="text-warning">*</span> wajib diisi.</p>
                    </div>

                    <!-- Pesan Sukses Validasi -->
                    @if (session('success'))
                        <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="border-radius: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ route('enrollments.preview') }}" method="POST">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="contoh@email.com" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Nomor HP -->
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Nomor HP <span class="text-danger">*</span></label>
                            <input type="text" id="phone" name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" placeholder="Contoh: 081234567890" value="{{ old('phone') }}" required>
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Program Studi -->
                        <div class="mb-3">
                            <label for="program_studi" class="form-label fw-semibold">Program Studi <span class="text-danger">*</span></label>
                            <input type="text" id="program_studi" name="program_studi" class="form-control form-control-lg @error('program_studi') is-invalid @enderror" value="{{ old('program_studi') }}" placeholder="Masukkan program studi Anda" required>
                            @error('program_studi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Pilih Kursus -->
                        <div class="mb-3">
                            <label for="course_id" class="form-label fw-semibold">Pilih Kursus <span class="text-danger">*</span></label>
                            <select id="course_id" name="course_id" class="form-select form-select-lg @error('course_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kursus --</option>
                                @foreach ($courses as $id => $course)
                                    <option value="{{ $id }}" @selected(old('course_id') == $id)>{{ $course['name'] }}</option>
                                @endforeach
                            </select>
                            @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Kotak Sisa Kursi (Ajax) -->
                        <div id="availability" class="alert alert-secondary py-3 mb-4">
                            Pilih kursus untuk melihat sisa kursi.
                        </div>

                        <!-- Metode Belajar -->
                        <div class="mb-3">
                            <label for="method" class="form-label fw-semibold">Metode Belajar <span class="text-danger">*</span></label>
                            <select id="method" name="method" class="form-select form-select-lg @error('method') is-invalid @enderror" required>
                                <option value="">-- Pilih metode --</option>
                                <option value="Online" @selected(old('method') == 'Online')>Online</option>
                                <option value="Offline" @selected(old('method') == 'Offline')>Offline (Tatap Muka)</option>
                                <option value="Hybrid" @selected(old('method') == 'Hybrid')>Hybrid</option>
                            </select>
                            @error('method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Jenis Peserta -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block">Jenis Peserta <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="participant_type" id="peserta1" value="Mahasiswa" @checked(old('participant_type') == 'Mahasiswa') required>
                                <label class="form-check-label" for="peserta1">Mahasiswa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="participant_type" id="peserta2" value="Umum" @checked(old('participant_type') == 'Umum')>
                                <label class="form-check-label" for="peserta2">Umum</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="participant_type" id="peserta3" value="Guru" @checked(old('participant_type') == 'Guru')>
                                <label class="form-check-label" for="peserta3">Guru</label>
                            </div>
                        </div>

                        <!-- Minat Tambahan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block">Minat Tambahan <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="interest" id="minat1" value="UI/UX" @checked(old('interest') == 'UI/UX') required>
                                <label class="form-check-label" for="minat1">UI/UX</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="interest" id="minat2" value="Database" @checked(old('interest') == 'Database')>
                                <label class="form-check-label" for="minat2">Database</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="interest" id="minat3" value="Backend" @checked(old('interest') == 'Backend')>
                                <label class="form-check-label" for="minat3">Backend</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="interest" id="minat4" value="Frontend" @checked(old('interest') == 'Frontend')>
                                <label class="form-check-label" for="minat4">Frontend</label>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-4">
                            <label for="notes" class="form-label fw-semibold">Catatan</label>
                            <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Tuliskan kebutuhan belajar Anda (opsional)">{{ old('notes') }}</textarea>
                        </div>

                        <!-- TOMBOL KIRIM BIRU NAVY -->
                        <button type="submit" class="btn-kirim">Kirim Pendaftaran</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection