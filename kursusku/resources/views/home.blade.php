<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteName }}</title>
    <!-- Memasukkan CSS Bootstrap langsung via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* TEMA GELAP (DARK MODE) */
        body { background-color: #0f172a; color: #e2e8f0; font-family: sans-serif; }
        .navbar { background-color: #1e293b; border-bottom: 1px solid #334155; }
        .navbar-brand, .nav-link { color: #f8fafc !important; }
        
        /* HERO SECTION */
        .hero-section { padding: 80px 0; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); }
        .hero-img { border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); max-height: 400px; object-fit: cover; width: 100%; }
        
        /* KATALOG SECTION */
        .katalog-section { padding: 60px 0; }
        
        /* CARD STYLE */
        .custom-card { background-color: #1e293b; border: 1px solid #334155; color: #e2e8f0; transition: transform 0.3s; }
        .custom-card:hover { transform: translateY(-5px); border-color: #10b981; }
        .course-code { color: #10b981; font-weight: bold; font-size: 0.9rem; letter-spacing: 1px; }
        .course-date { color: #94a3b8; font-size: 0.9rem; }
        .course-price { color: #f8fafc; font-weight: bold; font-size: 1.2rem; }
        .course-quota { color: #94a3b8; font-size: 0.9rem; }
        
        /* BADGE */
        .badge-available { background-color: #10b981; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.8rem; }
        .badge-full { background-color: #ef4444; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.8rem; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">{{ $siteName }}</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Kolom Kiri: Teks -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="badge text-bg-success mb-3">Kursus teknologi untuk mahasiswa</span>
                    <h1 class="display-5 fw-bold text-white mb-3">Belajar lebih terarah bersama KursusKu</h1>
                    <p class="lead text-secondary mb-4">Pilih kursus, cek ketersediaan kursi, lalu isi formulir pendaftaran.</p>
                    <a href="#" class="btn btn-success btn-lg px-4">Daftar Kursus</a>
                </div>
                
                <!-- Kolom Kanan: Gambar (Hero Image) -->
                <div class="col-lg-6 text-center">
                    <!-- Pastikan file gambar ada di public/images/hero-kursus.png -->
                    <img src="{{ asset('images/hero-kursus.png') }}" alt="Ilustrasi Kursus" class="hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- KATALOG SECTION -->
    <section class="katalog-section">
        <div class="container">
            <h2 class="text-center text-white mb-5">Kursus Tersedia</h2>
            <div class="row g-4">
                @foreach ($featured as $course)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 custom-card">
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="course-code">{{ $course['code'] }}</span>
                            <h3 class="mt-2 text-white">{{ $course['name'] }}</h3>
                            <p class="course-date">Mulai: {{ $course['start'] ?? '-' }}</p>
                            
                            <div class="course-price mt-2">{{ $course['price'] ?? 'Gratis' }}</div>
                            <p class="course-quota">Sisa kuota: {{ $course['quota'] ?? 0 }} kursi</p>
                            
                            <div class="mt-auto">
                                @if (($course['quota'] ?? 0) > 0)
                                    <span class="badge-available">Tersedia</span>
                                @else
                                    <span class="badge-full">Penuh</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</body>
</html>