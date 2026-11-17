<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'AMOLE SOFA ')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body>

    <header class="navbar">
        <a href="{{ route('home') }}" class="logo">
            AMOLE SOFA
        </a>

        <nav class="nav-menu">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#galeri">Galeri</a>

            <div class="nav-dropdown">
                <a href="{{ route('home') }}#layanan" class="nav-dropdown-toggle">
                    Layanan <span>⌄</span>
                </a>

                <div class="nav-dropdown-menu">
                    <a href="{{ route('home') }}#service-reparasi">Service dan Reparasi Sofa</a>
                    <a href="{{ route('home') }}#service-kain">Ganti Kain Sofa</a>
                    <a href="{{ route('home') }}#service-busa">Ganti Busa Sofa</a>
                    <a href="{{ route('home') }}#service-custom">Pembuatan Sofa Custom</a>
                </div>
            </div>

            <a href="{{ route('home') }}#tentang">Tentang Kami</a>
            <a href="{{ route('home') }}#kontak">Kontak</a>
        </nav>

        <div class="nav-actions">
            <input type="text" placeholder="Cari produk...">

            @auth
                <a href="#" class="nav-icon" title="Akun">Akun</a>

                <form action="{{ route('logout') }}" method="POST" class="account-form">
                    @csrf
                    <button type="submit" class="nav-icon logout-button">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-icon" title="Login">
                    Akun
                </a>
            @endauth
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer" id="kontak">
        <div class="footer-brand">
            <h2>AMOLE SOFA</h2>
            <p>
                Kami menghadirkan sofa dan kursi berkualitas
                dengan desain modern untuk melengkapi
                kenyamanan dan keindahan ruang Anda.
            </p>
        </div>

        <div class="footer-column">
            <h4>Navigasi</h4>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#galeri">Galeri</a>
            <a href="{{ route('home') }}#layanan">Layanan</a>
            <a href="{{ route('home') }}#tentang">Tentang Kami</a>
        </div>

        <div class="footer-column">
            <h4>Bantuan</h4>
            <a href="#">Cara Pemesanan</a>
            <a href="#">Pengiriman</a>
            <a href="#">Pembayaran</a>
            <a href="#">FAQ</a>
        </div>

        <div class="footer-column">
            <h4>Hubungi Kami</h4>
            <p>CV. Amole Inti Perkasa</p>
            <p>Informasi kontak akan ditambahkan.</p>
        </div>

        <div class="footer-column">
            <h4>Newsletter</h4>
            <p>Dapatkan informasi terbaru dari AMOLE SOFA.</p>

            <form class="newsletter-form">
                <input type="email" placeholder="Masukkan email Anda">
                <button type="button">→</button>
            </form>
        </div>

        <div class="footer-bottom">
            © {{ date('Y') }} AMOLE SOFA. All rights reserved.
        </div>
    </footer>

    <nav class="mobile-bottom-nav">
        <a href="{{ route('home') }}">
            <span>⌂</span>
            Beranda
        </a>

        <a href="{{ route('home') }}#produk">
            <span>▦</span>
            Produk
        </a>

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <span>♙</span>
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">
                <span>♙</span>
                Akun
            </a>
        @endauth
    </nav>

    @stack('scripts')

</body>
</html>
