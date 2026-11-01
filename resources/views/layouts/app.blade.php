<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'KursusKu')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* HEADER (Tulisan KursusKu di Tengah) */
        .header-utama {
            background-color: #1e3a8a; /* Biru Navy Gelap */
            color: white;
            text-align: center;
            padding: 25px 0 20px 0;
        }
        .header-utama h1 {
            font-weight: 800;
            margin: 0;
            font-size: 2.2rem;
            letter-spacing: 0.5px;
            color: #ffffff;
        }
        .header-utama p {
            margin: 5px 0 0;
            font-size: 0.9rem;
            color: #bfdbfe;
        }

        /* MENU NAVIGASI (Menyatu di Bawah Header) */
        .nav-utama {
            background-color: #1e40af; /* Biru Navy Sedikit Lebih Terang */
            padding: 15px 0;
        }
        .nav-utama ul {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin: 0;
            padding: 0;
            flex-wrap: wrap;
        }
        .nav-utama a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: 0.3s;
        }
        .nav-utama a:hover {
            color: #bfdbfe;
        }
        /* Menu Daftar Kursus (Sorotan) */
        .nav-utama .menu-daftar {
            font-weight: 700;
            color: #ffffff;
            border-bottom: 2px solid #ffffff;
            padding-bottom: 2px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- HEADER TENGAH -->
    <div class="header-utama">
        <h1>KursusKu</h1>
        <p>Belajar Teknologi, Bangun Masa Depan</p>
    </div>

    <!-- MENU TENGAH -->
    <div class="nav-utama">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('home') }}#keunggulan">Keunggulan</a></li>
                <li><a href="{{ route('home') }}#kursus">Katalog</a></li>
                <li><a href="{{ route('home') }}#alur">Cara Daftar</a></li>
                <li><a href="{{ route('home') }}#media">Media</a></li>
                <li><a href="{{ route('home') }}#kontak">Kontak</a></li>
                <li><a href="{{ route('enrollments.create') }}" class="menu-daftar">Daftar Kursus</a></li>
            </ul>
        </div>
    </div>

    <!-- KONTEN HALAMAN -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0 small">&copy; 2026 KursusKu. Praktikum Pemrograman Web III.</p>
        </div>
    </footer>

</body>
</html>