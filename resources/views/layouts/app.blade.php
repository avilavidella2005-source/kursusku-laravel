<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'KursusKu')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Animasi Latar Belakang */
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }
        #bg-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            pointer-events: none;
        }

        /* Header & Navbar Biru Navy */
        .header-utama {
            background-color: #1e3a8a;
            color: white;
            text-align: center;
            padding: 20px 0 15px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header-utama h1 {
            font-weight: 800;
            margin: 0;
            font-size: 2rem;
            letter-spacing: 0.5px;
        }
        .header-utama p {
            margin: 5px 0 0;
            font-size: 0.9rem;
            color: #bfdbfe;
        }
        .nav-utama {
            background-color: #1e40af;
            padding: 12px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .nav-utama ul {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 25px;
            margin: 0;
            padding: 0;
            flex-wrap: wrap;
        }
        .nav-utama a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: 0.3s;
        }
        .nav-utama a:hover {
            color: #bfdbfe;
            text-shadow: 0 0 10px rgba(255,255,255,0.5);
        }
        .nav-utama .menu-daftar {
            font-weight: 700;
            color: #ffffff;
            border-bottom: 2px solid #ffffff;
            padding-bottom: 2px;
        }

        /* Konten Utama */
        main {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- KANVAS ANIMASI -->
    <canvas id="bg-canvas"></canvas>

    <!-- HEADER & NAVBAR -->
    <div class="header-utama">
        <h1>KursusKu</h1>
        <p>Belajar Teknologi, Bangun Masa Depan</p>
    </div>

    <div class="nav-utama">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('home') }}#keunggulan">Keunggulan</a></li>
                <li><a href="{{ route('home') }}#kursus">Katalog</a></li>
                <li><a href="{{ route('home') }}#alur">Cara Daftar</a></li>
                <li><a href="{{ route('home') }}#media">Media</a></li>
                <li><a href="{{ route('home') }}#kontak">Kontak</a></li>
                <li><a href="{{ route('courses.index') }}" class="menu-daftar">Kelola Kursus</a></li>
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

    <!-- SCRIPT ANIMASI JARINGAN -->
    <script>
        window.addEventListener('load', function() {
            const canvas = document.getElementById('bg-canvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            
            let width = canvas.width = window.innerWidth;
            let height = canvas.height = window.innerHeight;
            
            const color = 'rgba(30, 58, 138, '; // Biru Navy
            let particles = [];
            
            for (let i = 0; i < 80; i++) {
                particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    vx: (Math.random() - 0.5) * 0.6,
                    vy: (Math.random() - 0.5) * 0.6,
                    radius: Math.random() * 2 + 1
                });
            }

            window.addEventListener('resize', () => {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            });

            function animate() {
                ctx.clearRect(0, 0, width, height);
                
                particles.forEach(p => {
                    p.x += p.vx;
                    p.y += p.vy;
                    if (p.x < 0 || p.x > width) p.vx *= -1;
                    if (p.y < 0 || p.y > height) p.vy *= -1;
                    
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                    ctx.fillStyle = color + '0.6)';
                    ctx.fill();
                });

                for (let i = 0; i < particles.length; i++) {
                    for (let j = i + 1; j < particles.length; j++) {
                        let dx = particles[i].x - particles[j].x;
                        let dy = particles[i].y - particles[j].y;
                        let distance = Math.sqrt(dx * dx + dy * dy);
                        
                        if (distance < 150) {
                            ctx.beginPath();
                            ctx.strokeStyle = color + (0.15 - distance/1000) + ')'; 
                            ctx.lineWidth = 0.8;
                            ctx.moveTo(particles[i].x, particles[i].y);
                            ctx.lineTo(particles[j].x, particles[j].y);
                            ctx.stroke();
                        }
                    }
                }
                requestAnimationFrame(animate);
            }
            animate();
        });
    </script>
</body>
</html>