@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5 position-relative" style="z-index: 10;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <!-- Kartu Sambutan -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h3 class="fw-bold mb-1">Halo, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-muted mb-0">Selamat datang di Dashboard KursusKu. Anda berhasil login.</p>
                    </div>
                    <div>
                        <a href="{{ route('profile.edit') }}" class="btn btn-dark px-4 py-2" style="border-radius: 10px;">
                            Lihat Profil Saya
                        </a>
                    </div>
                </div>
            </div>

            <!-- Baris Menu Cepat -->
            <div class="row g-4">
                <!-- Menu Kelola Kursus -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100 text-center p-4" style="border-radius: 15px;">
                        <div class="bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center mb-3 mx-auto" style="width: 60px; height: 60px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.81 8.985.936 8 1.783z"/>
                            </svg>
                        </div>
                        <h4 class="fw-bold mb-2">Manajemen Kursus</h4>
                        <p class="text-muted small mb-4">Kelola data kursus, tambah kelas baru, dan atur jadwal.</p>
                        <a href="{{ route('courses.index') }}" class="btn btn-primary w-100 mt-auto">Masuk ke Daftar Kursus</a>
                    </div>
                </div>

                <!-- Menu Pengaturan Akun -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100 text-center p-4" style="border-radius: 15px;">
                        <div class="bg-success text-white rounded-circle d-inline-flex justify-content-center align-items-center mb-3 mx-auto" style="width: 60px; height: 60px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.149.043a.64.64 0 0 0-.382.921l.074.136c.306.561-.308 1.175-.869.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.149a.64.64 0 0 0-.921-.382l-.136.074c-.561.306-1.175-.308-.87-.869l.075-.136a.64.64 0 0 0-.382-.92l-.149-.045c-.612-.18-.612-1.048 0-1.229l.149-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.149ZM12.5 9.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                            </svg>
                        </div>
                        <h4 class="fw-bold mb-2">Pengaturan Akun</h4>
                        <p class="text-muted small mb-4">Ubah informasi profil, alamat email, dan password Anda.</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-success w-100 mt-auto">Edit Profil</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection