@extends('layouts.app')

@section('title', 'Beranda - KursusKu')

@section('content')
<style>
    /* CSS Khusus Halaman Beranda (Tema Biru) */
    .btn-baru {
        background-color: #1e3a8a; /* Biru Navy */
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 6px;
        font-weight: 700;
        transition: 0.3s;
    }
    .btn-baru:hover {
        background-color: #172554;
        color: white;
    }
    /* CSS untuk Card Keunggulan */
    .card-custom {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }
    .card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    .icon-circle {
        width: 70px;
        height: 70px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #eff6ff; /* Biru sangat muda */
        color: #1e3a8a;
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    .step-number {
        width: 60px;
        height: 60px;
        background-color: #1e3a8a;
        color: white;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
        box-shadow: 0 4px 10px rgba(30, 58, 138, 0.3);
    }
</style>

<!-- HERO SECTION -->
<div id="beranda" class="container py-5">
    <div class="row align-items-center mb-5 mt-3">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h2 class="fw-bold mb-3 text-dark" style="font-size: 2.2rem;">Selamat Datang di KursusKu</h2>
            <p class="text-secondary mb-4 fs-5" style="line-height: 1.6;">Platform belajar teknologi untuk mahasiswa yang ingin meningkatkan kemampuan pemrograman web.</p>
            <div class="d-flex flex-wrap gap-2">
                <a href="#kursus" class="btn-baru">Lihat Kursus</a>
                <a href="#" class="btn-baru">Lihat Estimasi Biaya</a>
                <a href="{{ route('enrollments.create') }}" class="btn-baru">Daftar Kursus</a>
            </div>
        </div>
        <div class="col-lg-6 text-center">
            <img src="{{ asset('images/hero-kursus.png') }}" alt="Belajar Coding" class="img-fluid rounded-4 shadow-lg">
        </div>
    </div>
</div>

<!-- KEUNGGULAN SECTION -->
<section id="keunggulan" class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Mengapa Memilih KursusKu?</h2>
            <p class="text-secondary">Kualitas pembelajaran yang dirancang khusus untuk mahasiswa.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 p-4 card-custom text-center bg-white shadow-sm">
                    <div class="icon-circle">📚</div>
                    <h4 class="fw-bold text-dark">Materi Terarah</h4>
                    <p class="text-secondary mb-0">Materi disusun bertahap dari dasar hingga praktik nyata.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 p-4 card-custom text-center bg-white shadow-sm">
                    <div class="icon-circle">💻</div>
                    <h4 class="fw-bold text-dark">Belajar dengan Proyek</h4>
                    <p class="text-secondary mb-0">Setiap tahap menghasilkan aplikasi nyata yang bisa digunakan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 p-4 card-custom text-center bg-white shadow-sm">
                    <div class="icon-circle">🤝</div>
                    <h4 class="fw-bold text-dark">Pendampingan Praktik</h4>
                    <p class="text-secondary mb-0">Belajar melalui demonstrasi, latihan, dan evaluasi berkala.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KATALOG KURSUS -->
<section id="kursus" class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark">Katalog Kursus</h2>
            <p class="text-secondary">Pilih kursus yang sesuai dengan minat Anda.</p>
        </div>
        <div class="table-responsive border rounded-3 shadow-sm">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead style="background-color: #1e3a8a; color: white;">
                    <tr>
                        <th class="py-3 px-3">Kode</th>
                        <th class="py-3 px-3">Nama</th>
                        <th class="py-3 px-3">Harga</th>
                        <th class="py-3 px-3">Mulai</th>
                        <th class="py-3 px-3 text-center">Sisa</th>
                        <th class="py-3 px-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($featured as $course)
                    <tr>
                        <td class="px-3 fw-bold">{{ $course['code'] }}</td>
                        <td class="px-3 fw-bold">{{ $course['name'] }}</td>
                        <td class="px-3">Rp {{ number_format($course['fee'], 0, ',', '.') }}</td>
                        <td class="px-3">{{ date('d-m-Y', strtotime($course['start_date'])) }}</td>
                        <td class="px-3 fw-bold text-center">{{ max(0, $course['quota'] - $course['registered']) }}</td>
                        <td class="px-3 text-center">
                            @if($course['registered'] >= $course['quota'])
                                <span class="badge bg-danger">Penuh</span>
                            @else
                                <span class="badge bg-primary">Tersedia</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- CARA DAFTAR -->
<section id="alur" class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Cara Mendaftar</h2>
            <p class="text-secondary">Hanya butuh 4 langkah mudah.</p>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="step-number">1</div>
                <h5 class="fw-bold">Pilih Kursus</h5>
                <p class="text-secondary small">Tentukan kursus yang diminati.</p>
            </div>
            <div class="col-md-3">
                <div class="step-number">2</div>
                <h5 class="fw-bold">Isi Form</h5>
                <p class="text-secondary small">Lengkapi data pendaftaran.</p>
            </div>
            <div class="col-md-3">
                <div class="step-number">3</div>
                <h5 class="fw-bold">Periksa Data</h5>
                <p class="text-secondary small">Pastikan data sudah benar.</p>
            </div>
            <div class="col-md-3">
                <div class="step-number">4</div>
                <h5 class="fw-bold">Kirim</h5>
                <p class="text-secondary small">Tunggu konfirmasi email.</p>
            </div>
        </div>
    </div>
</section>

<!-- MEDIA / VIDEO -->
<section id="media" class="py-5 bg-white">
    <div class="container text-center py-4">
        <h2 class="fw-bold text-dark mb-4">Video Pembelajaran</h2>
        <div class="ratio ratio-16x9 mx-auto shadow rounded-4 overflow-hidden border" style="max-width: 800px;">
            <iframe src="https://www.youtube.com/embed/nQinn48Bk2g" title="YouTube video" allowfullscreen></iframe>
        </div>
    </div>
</section>

<!-- KONTAK -->
<section id="kontak" class="py-5 bg-light">
    <div class="container text-center py-4">
        <h2 class="fw-bold text-dark">Kontak</h2>
        <p class="text-secondary mb-4">Informasi lebih lanjut mengenai program KursusKu dapat diperoleh melalui halaman ini.</p>
        <a href="mailto:info@kursusku.com" class="btn-baru px-5 shadow">Hubungi Kami</a>
    </div>
</section>

@endsection