<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin | AMOLE SOFA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --cream: #f7f3ed;
            --white: #ffffff;
            --brown: #49392c;
            --brown-dark: #30251e;
            --brown-light: #80664e;
            --text: #382d25;
            --muted: #938477;
            --border: #eee5da;
            --gold: #c5a477;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 255px;
            background: var(--brown-dark);
            color: white;
            padding: 32px 22px;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .brand-subtitle {
            color: #c7b49e;
            font-size: 10px;
            letter-spacing: 2px;
            margin-top: 7px;
            margin-bottom: 45px;
        }

        .menu-title {
            color: #a99680;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 16px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #e9dfd3;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 9px;
            margin-bottom: 8px;
            font-size: 13px;
            transition: .25s;
        }

        .menu a:hover,
        .menu a.active {
            background: #71583f;
            color: white;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 17px;
            color: var(--gold);
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,.12);
        }

        .sidebar-bottom form button {
            width: 100%;
            padding: 13px;
            border: 1px solid #9b8063;
            background: transparent;
            color: #f5eadd;
            border-radius: 9px;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            transition: .25s;
        }

        .sidebar-bottom form button:hover {
            background: #71583f;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 38px 45px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
        }

        .topbar h1 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            color: var(--brown-dark);
            font-weight: 600;
        }

        .topbar p {
            color: var(--muted);
            font-size: 13px;
            margin-top: 7px;
        }

        .admin-profile {
            background: white;
            border: 1px solid var(--border);
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            color: var(--brown);
        }

        /* WELCOME */
        .welcome {
            background: linear-gradient(115deg, #3b2d23, #80664e);
            color: white;
            padding: 38px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .welcome-label {
            color: #d7c1a5;
            font-size: 11px;
            letter-spacing: 2px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .welcome h2 {
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .welcome p {
            color: #e8ddd0;
            font-size: 13px;
            line-height: 1.8;
            max-width: 550px;
        }

        /* STATISTIK */
        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 17px;
        }

        .section-heading h3 {
            font-family: 'Playfair Display', serif;
            font-size: 21px;
            color: var(--brown-dark);
        }

        .section-heading span {
            color: var(--muted);
            font-size: 12px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: white;
            padding: 27px;
            border: 1px solid var(--border);
            border-radius: 13px;
            transition: .25s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(65, 45, 29, .07);
        }

        .stat-card span {
            display: block;
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 15px;
        }

        .stat-card h3 {
            font-size: 28px;
            color: var(--brown-dark);
            font-weight: 700;
        }

        /* AKSES CEPAT */
        .content-card {
            background: white;
            padding: 27px;
            border: 1px solid var(--border);
            border-radius: 13px;
        }

        .content-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 21px;
            color: var(--brown-dark);
            margin-bottom: 7px;
        }

        .content-card > p {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 23px;
        }

        .quick-menu {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 13px;
        }

        .quick-menu a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 9px;
            min-height: 100px;
            background: #faf7f2;
            border: 1px solid #eee5da;
            color: var(--brown);
            padding: 18px 12px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: .25s;
        }

        .quick-menu a:hover {
            background: #eee3d5;
            border-color: #d5c0a5;
            transform: translateY(-3px);
        }

        .quick-icon {
            font-size: 23px;
            color: #98764d;
        }

        /* FOOTER */
        .footer {
            margin-top: 35px;
            text-align: center;
            color: #a39484;
            font-size: 11px;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .quick-menu {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 1000px) {
            .main-content {
                padding: 30px 25px;
            }
        }

        @media (max-width: 850px) {
            .sidebar {
                width: 215px;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .admin-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 23px 20px;
            }

            .brand-subtitle {
                margin-bottom: 25px;
            }

            .sidebar-bottom {
                margin-top: 15px;
                padding-top: 15px;
            }

            .main-content {
                padding: 25px 17px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .topbar h1 {
                font-size: 25px;
            }

            .welcome {
                padding: 27px 23px;
            }

            .welcome h2 {
                font-size: 23px;
            }

            .quick-menu {
                grid-template-columns: 1fr 1fr;
            }

            .content-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="admin-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">AMOLE SOFA</div>
        <div class="brand-subtitle">ADMIN MANAGEMENT PANEL</div>

        <div class="menu-title">MENU UTAMA</div>

        <nav class="menu">

            <a href="{{ route('admin.dashboard') }}" class="active">
                Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}">
                Kelola Produk
            </a>

            <a href="{{ route('admin.orders.index') }}">
                Kelola Pesanan
            </a>

            <a href="{{ route('admin.service-requests.index') }}">
                Kelola Layanan
            </a>

            <a href="{{ route('admin.website-images.index') }}">
                Kelola Foto Layanan
            </a>

            <a href="{{ route('admin.galleries.index') }}">
                Kelola Galeri
            </a>

            <a href="{{ route('admin.banners.index') }}">
                Kelola Banner Promo
            </a>

            <a href="{{ route('home') }}" target="_blank">
                Lihat Website
            </a>

        </nav>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Keluar dari Admin</button>
            </form>
        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <header class="topbar">

            <div>
                <h1>Dashboard Admin</h1>
                <p>Selamat datang di panel pengelolaan AMOLE SOFA.</p>
            </div>

            <div class="admin-profile">
                {{ auth()->user()->name }}
            </div>

        </header>


        <!-- WELCOME -->
        <section class="welcome">

            <div class="welcome-label">AMOLE SOFA MANAGEMENT</div>

            <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>

            <p>
                Kelola produk, pantau pesanan, dan pantau perkembangan
                penjualan serta permintaan layanan AMOLE SOFA melalui
                halaman administrasi ini.
            </p>

        </section>


        <!-- STATISTIK -->
        <div class="section-heading">
            <h3>Ringkasan Toko</h3>
            <span>Informasi keseluruhan toko</span>
        </div>

        <section class="stats">

            <div class="stat-card">
                <span>Total Produk</span>
                <h3>{{ number_format($totalProduk, 0, ',', '.') }}</h3>
            </div>

            <div class="stat-card">
                <span>Total Pesanan</span>
                <h3>{{ number_format($totalPesanan, 0, ',', '.') }}</h3>
            </div>

            <div class="stat-card">
                <span>Total Penjualan</span>
                <h3 style="font-size: 23px;">
                    Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                </h3>
            </div>

        </section>


        <!-- AKSES CEPAT -->
        <section class="content-card">

            <h3>Akses Cepat</h3>

            <p>Pilih menu berikut untuk mengelola toko dengan lebih mudah.</p>

            <div class="quick-menu">

                <a href="{{ route('admin.products.create') }}">
                    Tambah Produk
                </a>

                <a href="{{ route('admin.products.index') }}">
                    Kelola Produk
                </a>

                <a href="{{ route('admin.orders.index') }}">
                    Lihat Pesanan
                </a>

                <a href="{{ route('admin.service-requests.index') }}">
                    Kelola Layanan
                </a>

                <a href="{{ route('admin.website-images.index') }}">
                    Kelola Foto Layanan
                </a>

                <a href="{{ route('admin.galleries.index') }}">
                    Kelola Galeri
                </a>

                <a href="{{ route('admin.banners.index') }}">
                    Kelola Banner Promo
                </a>

                <a href="{{ route('home') }}" target="_blank">
                    Buka Website
                </a>

            </div>

        </section>


        <div class="footer">
            © {{ date('Y') }} AMOLE SOFA. All Rights Reserved.
        </div>

    </main>

</div>

</body>
</html>
