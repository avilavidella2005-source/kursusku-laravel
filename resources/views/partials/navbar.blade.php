<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">KursusKu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li>
                
                <!-- UBAH BAGIAN INI: Arahkan ke admin.login -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.login') }}">Pendaftaran</a>
                </li>
                
                <!-- Opsional: Tampilkan tombol Login/Logout jika diperlukan -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">Login Admin</a>
                    </li>
                @else
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="border: none; background: none;">Logout</button>
                        </form>
                    </li>
                @endguest
                
            </ul>
        </div>
    </div>
</nav>