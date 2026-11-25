@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5 position-relative" style="z-index: 10;">
    
    <!-- KOTAK JUDUL PROFIL SAYA (Kanan Atas) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 15px; background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);">
                <div class="card-body p-4 d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h3 class="fw-bold mb-1">Profil Saya</h3>
                        <p class="mb-0 text-white-50">Perbarui identitas, kontak, email login, dan password Anda.</p>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-light text-primary fw-bold shadow-sm" style="border-radius: 8px;">
                        &larr; Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid Layout (2 Kolom) -->
    <div class="row g-4">
        
        <!-- KOLOM KIRI (Form Identitas & Kontak) -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0" style="border-radius: 15px; border-top: 4px solid #0f766e !important;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark">Identitas & Kontak</h5>
                    
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control" required>
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Email Login *</label>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="form-control" required>
                                <small class="text-muted" style="font-size: 0.75rem;">Setelah disimpan, email baru digunakan pada login berikutnya.</small>
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Nomor HP</label>
                                <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" class="form-control" placeholder="Contoh: 081234567890">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Jabatan</label>
                                <input type="text" name="position" value="{{ old('position', Auth::user()->position ?? '') }}" class="form-control" placeholder="Contoh: Administrator Sistem">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Instansi / Unit</label>
                            <input type="text" name="instance" value="{{ old('instance', Auth::user()->instance ?? '') }}" class="form-control" placeholder="Contoh: KursusKu">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">Alamat</label>
                            <textarea name="address" rows="3" class="form-control">{{ old('address', Auth::user()->address ?? '') }}</textarea>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn text-white fw-bold px-4 py-2" style="background-color: #0f766e; border-radius: 8px;">
                                Simpan Perubahan
                            </button>
                            @if (session('status') === 'profile-updated')
                                <span class="text-success fw-semibold"><i class="bi bi-check-circle"></i> Tersimpan.</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN (Info Akses & Password) -->
        <div class="col-lg-4">
            
            <!-- Card Informasi Akses (Diberi Warna Latar) -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px; background-color: #eff6ff;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-primary">Informasi Akses</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Username</span>
                        <span class="fw-semibold">{{ Str::before(Auth::user()->email, '@') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 align-items-center">
                        <span class="text-secondary">Role</span>
                        <span class="badge bg-dark">ADMIN</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 align-items-center">
                        <span class="text-secondary">Status</span>
                        <span class="badge bg-success">Aktif</span>
                    </div>
                    <div class="d-flex justify-content-between mb-0">
                        <span class="text-secondary">Login terakhir</span>
                        <span class="fw-semibold">{{ now()->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Card Ganti Password (Diberi Warna Latar) -->
            <div class="card shadow-sm border-0" style="border-radius: 15px; background-color: #f0fdf4;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1 text-success">Ganti Password</h5>
                    <p class="text-muted mb-4" style="font-size: 0.8rem;">Password baru minimal 8 karakter serta mengandung huruf besar-kecil, angka, dan simbol.</p>
                    
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        
                        <div class="mb-3">
                            <input type="password" name="current_password" class="form-control" placeholder="Password saat ini">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password baru">
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
                        </div>
                        
                        <button type="submit" class="btn btn-outline-success w-100 fw-bold py-2" style="border-radius: 8px;">
                            Ganti Password
                        </button>
                        @if (session('status') === 'password-updated')
                            <p class="text-success text-center mt-2 mb-0" style="font-size: 0.85rem;">Password diperbarui.</p>
                        @endif
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection