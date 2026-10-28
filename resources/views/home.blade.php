@extends('layouts.app')

@section('title', 'Beranda - KursusKu')

@section('content')
    <!-- HERO SECTION -->
    <div class="row align-items-center py-5">
        <div class="col-lg-7">
            <span class="badge text-bg-success mb-3">Kursus teknologi untuk mahasiswa</span>
            <h1 class="display-4 fw-bold mb-3">Belajar lebih terarah bersama KursusKu</h1>
            <p class="lead text-secondary mb-4">Pilih kursus, cek ketersediaan kursi, lalu isi formulir pendaftaran.</p>
            <a href="{{ route('enrollments.create') }}" class="btn btn-success btn-lg px-4">Daftar Kursus</a>
        </div>
        <div class="col-lg-5 mt-4 mt-lg-0 text-center">
            <img src="{{ asset('images/hero-kursus.png') }}" alt="Ilustrasi Kursus" class="img-fluid rounded shadow" style="max-height: 350px;">
        </div>
    </div>

    <!-- KATALOG SECTION -->
    <div class="py-5">
        <h2 class="text-center fw-bold mb-5">Kursus Tersedia</h2>
        <div class="row g-4">
            @foreach ($featured as $course)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body p-4 d-flex flex-column">
                        <span class="text-success fw-bold mb-2 small">{{ $course['code'] }}</span>
                        <h3 class="h5 fw-bold">{{ $course['name'] }}</h3>
                        <p class="text-muted small mb-3">Mulai: {{ $course['start'] ?? '-' }}</p>
                        
                        <div class="fw-bold fs-5 mb-2">{{ $course['price'] ?? 'Gratis' }}</div>
                        <p class="text-muted small mb-4">Sisa kuota: {{ $course['quota'] ?? 0 }} kursi</p>
                        
                        <div class="mt-auto">
                            @if (($course['quota'] ?? 0) > 0)
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Penuh</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection