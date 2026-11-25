@extends('layouts.app')

@section('title', 'Login Admin - KursusKu')

@section('content')
<div class="container py-5 position-relative" style="z-index: 10;">
    <div class="row justify-content-center align-items-center" style="min-height: 75vh;">
        <div class="col-md-6 col-lg-5">
            
            <!-- Kartu Login -->
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div class="card-body p-5">
                    
                    <!-- Judul -->
                    <div class="text-center mb-4">
                        <p class="text-uppercase text-primary fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">Akses Administrator & Dosen</p>
                        <h3 class="fw-bold mb-1">Selamat datang 👋</h3>
                        <p class="text-muted">Masuk ke profil Anda untuk mengelola aktivitas pembelajaran.</p>
                    </div>

                    <!-- Notifikasi Error -->
                    @if ($errors->any())
                        <div class="alert alert-danger p-2 small mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Username / Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Username</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan username" value="{{ old('email') }}" required autofocus>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="font-size: 0.85rem;">Lihat</button>
                            </div>
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none small fw-semibold text-primary">Lupa password?</a>
                            @endif
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-success w-100 fw-bold py-2 mb-4" style="background-color: #0f766e; border: none; border-radius: 8px;">
                            Masuk ke Profil Saya &rarr;
                        </button>
                    </form>

                    <!-- Link Tambahan -->
                    <div class="text-center text-muted small">
                        <p class="mb-2">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-primary">Daftar sekarang</a></p>
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted">&larr; Kembali ke Beranda</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Toggle Password -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if(togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.textContent = type === 'password' ? 'Lihat' : 'Sembunyikan';
            });
        }
    });
</script>
@endsection