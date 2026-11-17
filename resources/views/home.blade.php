<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AMOLE SOFA</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* PRODUK */
        .product-detail-link {
            display: flex;
            width: 100%;
            height: 100%;
            color: inherit;
            text-decoration: none;
            align-items: center;
            justify-content: center;
        }

        .product-image {
            width: 100%;
            height: 260px;
            position: relative;
            overflow: hidden;
            background: #fff;
        }

        .product-image .product-detail-link {
            width: 100%;
            height: 100%;
        }

       
.product-image img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: center center;
    padding: 0;
    margin: 0;
    background: #fff;
    transform: scale(1.15);
    transform-origin: center center;
    transition: transform .3s ease;
}

.product-image img:hover {
    transform: scale(1.19);
}

.product-name-link {
    color: inherit;
    text-decoration: none;
    transition: color .2s ease;
}

.product-name-link:hover {
    color: #98764d;
}

.category-select {
    width: 100%;
    padding: 14px;
    border: 1px solid #e5dacf;
    border-radius: 7px;
    background: #fff;
    color: #302820;
    font-size: 14px;
    cursor: pointer;
}

.category-select:focus {
    outline: none;
    border-color: #98764d;
}

.empty-product {
    color: #82776c;
    padding: 25px 0;
    text-align: center;
}

.empty-product[hidden] {
    display: none;
}


        /* LOGOUT */
        .account-form {
            display: inline-flex;
            margin: 0;
        }

        .logout-button {
            background: none;
            border: none;
            font: inherit;
            cursor: pointer;
        }

        /* WISHLIST */
        .wishlist-nav-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #302820;
            text-decoration: none;
            font-size: 14px;
            white-space: nowrap;
            transition: color .2s ease;
        }

        .wishlist-nav-link span {
            color: #98764d;
            font-size: 21px;
            line-height: 1;
        }

        .wishlist-nav-link:hover {
            color: #98764d;
        }

        /* NAVBAR PESANAN DAN LAYANAN */
        .nav-menu > a {
            white-space: nowrap;
        }

        .nav-menu .customer-nav-link {
            color: #98764d;
            font-weight: 600;
            transition: color .2s ease;
        }

        .nav-menu .customer-nav-link:hover {
            color: #654a2d;
        }

        /* LABEL PRODUK */
        .new-label {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 5;
            background: #98764d;
            color: #fff;
            padding: 6px 11px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .sale-label {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 5;
        }

        .new-label + .sale-label {
            top: 43px;
        }

        /* DROPDOWN LAYANAN */
        .nav-dropdown {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .nav-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 245px;
            background: #fff;
            border: 1px solid #e9dfd3;
            border-radius: 8px;
            box-shadow: 0 8px 25px rgba(0,0,0,.10);
            padding: 8px 0;
            z-index: 999;
        }

        .nav-dropdown-menu a {
            display: block;
            padding: 12px 17px;
            color: #302820;
            text-decoration: none;
            font-size: 13px;
            transition: .2s ease;
        }

        .nav-dropdown-menu a:hover {
            background: #f5eee6;
            color: #98764d;
            padding-left: 22px;
        }

        .nav-dropdown:hover .nav-dropdown-menu,
        .nav-dropdown:focus-within .nav-dropdown-menu {
            display: block;
        }

        /* HERO BANNER SLIDER */
        .hero-banner {
            position: relative;
            width: 100%;
            height: 520px;
            overflow: hidden;
            background: #30251e;
            padding: 0;
        }

        .banner-track {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform .65s ease-in-out;
            touch-action: pan-y;
            cursor: grab;
        }

        .banner-track.dragging {
            cursor: grabbing;
            transition: none;
        }

        .banner-slide {
            position: relative;
            flex: 0 0 100%;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .banner-slide::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                90deg,
                rgba(25,19,14,.78) 0%,
                rgba(25,19,14,.42) 48%,
                rgba(25,19,14,.08) 100%
            );
            pointer-events: none;
        }

        .banner-slide img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            user-select: none;
            -webkit-user-drag: none;
        }

        .banner-content {
            position: absolute;
            z-index: 2;
            top: 50%;
            left: 8%;
            transform: translateY(-50%);
            max-width: 600px;
            color: #fff;
            pointer-events: none;
        }

        .banner-content .hero-label {
            color: #e4c79f;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 4px;
            margin-bottom: 18px;
        }

        .banner-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 5vw, 55px);
            line-height: 1.2;
            margin-bottom: 18px;
        }

        .banner-content p {
            color: #f1e9df;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .banner-button {
            display: inline-block;
            pointer-events: auto;
            background: #c5a477;
            color: #30251e;
            text-decoration: none;
            padding: 14px 27px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            transition: .25s;
        }

        .banner-button:hover {
            background: #fff;
            color: #30251e;
        }

        .banner-arrow {
            position: absolute;
            z-index: 5;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            border: 1px solid rgba(255,255,255,.6);
            border-radius: 50%;
            background: rgba(48,37,30,.35);
            color: #fff;
            font-size: 25px;
            cursor: pointer;
            transition: .25s;
        }

        .banner-arrow:hover {
            background: #c5a477;
            color: #30251e;
        }

        .banner-prev {
            left: 22px;
        }

        .banner-next {
            right: 22px;
        }

        .banner-dots {
            position: absolute;
            z-index: 5;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .banner-dot {
            width: 10px;
            height: 10px;
            border: none;
            border-radius: 50px;
            background: rgba(255,255,255,.55);
            cursor: pointer;
            transition: .3s;
        }

        .banner-dot.active {
            width: 30px;
            background: #c5a477;
        }

        @media (max-width: 600px) {
            .hero-banner {
                height: 430px;
            }

            .banner-content {
                left: 25px;
                right: 25px;
            }

            .banner-content h1 {
                font-size: 32px;
            }

            .banner-content p {
                font-size: 13px;
            }

            .banner-prev {
                left: 10px;
            }

            .banner-next {
                right: 10px;
            }

            .banner-arrow {
                width: 34px;
                height: 34px;
                font-size: 19px;
            }

            .banner-dots {
                bottom: 18px;
            }
        }

        /* LAYANAN */
        .services-section {
            padding: 80px 6%;
            background: #faf7f2;
            scroll-margin-top: 30px;
        }

        .services-heading {
            text-align: center;
            max-width: 680px;
            margin: 0 auto 45px;
        }

        .services-heading span {
            color: #98764d;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 3px;
        }

        .services-heading h2 {
            color: #302820;
            font-size: 32px;
            margin: 12px 0;
        }

        .services-heading p {
            color: #82776c;
            font-size: 14px;
            line-height: 1.8;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
            max-width: 1250px;
            margin: auto;
        }

        .service-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #eee5db;
            transition: .3s ease;
        }

        .service-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 12px 30px rgba(48,40,32,.10);
        }

        .service-image {
            height: 190px;
            overflow: hidden;
            background: #e9dfd3;
        }

        .service-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }

        .service-card:hover .service-image img {
            transform: scale(1.06);
        }

        .service-info {
            padding: 22px;
        }

        .service-info h3 {
            color: #302820;
            font-size: 17px;
            margin: 0 0 12px;
        }

        .service-info p {
            color: #82776c;
            font-size: 13px;
            line-height: 1.8;
            min-height: 95px;
        }

        .service-link {
            display: inline-block;
            margin-top: 10px;
            color: #98764d;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .service-link:hover {
            color: #654a2d;
        }

        /* GALERI */
        .gallery-section {
            padding: 80px 6%;
            background: #fff;
            scroll-margin-top: 30px;
        }

        .gallery-container {
            max-width: 1250px;
            margin: auto;
        }

        .gallery-heading {
            text-align: center;
            max-width: 680px;
            margin: 0 auto 45px;
        }

        .gallery-heading span {
            color: #98764d;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 3px;
        }

        .gallery-heading h2 {
            color: #302820;
            font-size: 32px;
            margin: 12px 0;
        }

        .gallery-heading p {
            color: #82776c;
            font-size: 14px;
            line-height: 1.8;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .gallery-card {
            position: relative;
            height: 280px;
            overflow: hidden;
            border-radius: 10px;
            background: #e9dfd3;
        }

        .gallery-card img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.06);
        }

        .gallery-card-overlay {
            position: absolute;
            inset: auto 0 0;
            padding: 35px 20px 18px;
            color: #fff;
            background: linear-gradient(
                transparent,
                rgba(30, 23, 17, .78)
            );
        }

        .gallery-card-overlay h3 {
            margin: 0 0 6px;
            font-size: 17px;
            color: #fff;
        }

        .gallery-card-overlay p {
            margin: 0;
            color: #f1e9df;
            font-size: 12px;
            line-height: 1.6;
        }

        .gallery-empty {
            grid-column: 1 / -1;
            padding: 35px 20px;
            text-align: center;
            color: #82776c;
            background: #faf7f2;
            border-radius: 10px;
        }

        /* TENTANG KAMI */
        .about-section {
            padding: 75px 8%;
            background: #f8f5f0;
            text-align: center;
            scroll-margin-top: 30px;
        }

        .about-container {
            max-width: 850px;
            margin: auto;
        }

        .about-label {
            display: inline-block;
            color: #98764d;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 3px;
            margin-bottom: 12px;
        }

        .about-section h2 {
            color: #302820;
            font-size: 32px;
            margin: 0 0 12px;
        }

        .about-section h3 {
            color: #98764d;
            font-size: 19px;
            margin: 0 0 20px;
        }

        .about-section p {
            color: #82776c;
            font-size: 14px;
            line-height: 1.9;
            margin: 0 auto;
        }

        .about-details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-top: 35px;
            text-align: left;
        }

        .about-detail-card {
            padding: 22px;
            background: #fff;
            border: 1px solid #eee5db;
            border-radius: 9px;
        }

        .about-detail-card h4 {
            color: #98764d;
            font-size: 14px;
            margin: 0 0 10px;
        }

        .about-detail-card p {
            color: #62584e;
            font-size: 13px;
            line-height: 1.8;
            margin: 0;
        }

        .about-detail-card a {
            color: #98764d;
            text-decoration: none;
            font-weight: 600;
        }

        .about-detail-card a:hover {
            text-decoration: underline;
        }

        /* FOOTER MAPS */
        .footer-map {
            width: 100%;
            grid-column: 1 / -1;
            margin-top: 25px;
        }

        .footer-map h4 {
            color: inherit;
            margin: 0 0 15px;
        }

        .footer-map p {
            margin: 0 0 15px;
            font-size: 13px;
            line-height: 1.7;
        }

        .footer-map iframe {
            display: block;
            width: 100%;
            height: 300px;
            border: 0;
            border-radius: 12px;
        }

        .footer-bottom {
            grid-column: 1 / -1;
        }

        /* NAVIGASI HP */
        .mobile-bottom-nav form {
            margin: 0;
        }

        .mobile-bottom-nav button {
            background: none;
            border: none;
            font: inherit;
            color: inherit;
            cursor: pointer;
        }

        @media (max-width: 1000px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .services-section {
                padding: 55px 20px;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .services-heading h2 {
                font-size: 25px;
            }

            .service-image {
                height: 210px;
            }

            .product-image {
                height: 230px;
            }

            .gallery-section {
                padding: 55px 20px;
            }

            .gallery-heading h2 {
                font-size: 25px;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .gallery-card {
                height: 240px;
            }

            .about-section {
                padding: 55px 20px;
            }

            .about-section h2 {
                font-size: 25px;
            }

            .about-details {
                grid-template-columns: 1fr;
            }

            .footer-map iframe {
                height: 230px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">

        <a href="{{ route('home') }}" class="logo">
            AMOLE SOFA
        </a>

        <nav class="nav-menu">

            <a href="{{ route('home') }}">Home</a>

            <a href="#galeri">Galeri</a>

            <div class="nav-dropdown">

                <a href="#layanan" class="nav-dropdown-toggle">
                    Layanan <span>⌄</span>
                </a>

                <div class="nav-dropdown-menu">

                    <a href="{{ route('layanan.reparasi') }}">
                        Service dan Reparasi Sofa
                    </a>

                    <a href="{{ route('layanan.kain') }}">
                        Ganti Kain Sofa
                    </a>

                    <a href="{{ route('layanan.busa') }}">
                        Ganti Busa Sofa
                    </a>

                    <a href="{{ route('layanan.custom') }}">
                        Pembuatan Sofa Custom
                    </a>

                </div>

            </div>

            <a href="#tentang">Tentang Kami</a>

            <a href="#kontak">Kontak</a>

            @auth

                <a href="{{ route('orders.mine') }}" class="customer-nav-link">
                    Pesanan Saya
                </a>

                <a href="{{ route('layanan.mine') }}" class="customer-nav-link">
                    Layanan Saya
                </a>

            @endauth

        </nav>

        <div class="nav-actions">

            <input
                type="text"
                id="searchInput"
                placeholder="Cari produk..."
            >

            @auth

                <a href="{{ route('wishlist.index') }}" class="wishlist-nav-link">
                    <span>♡</span>
                    Wishlist
                </a>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="account-form"
                >
                    @csrf

                    <button type="submit" class="nav-icon account-link logout-button">
                        Logout
                    </button>
                </form>

            @else

                <a href="{{ route('login') }}" class="nav-icon account-link">
                    Akun
                </a>

            @endauth

        </div>

    </header>


    <!-- HERO BANNER SLIDER -->
    <section class="hero-banner" id="promoBanner">

        @if(isset($banners) && $banners->count() > 0)

            <div class="banner-track" id="bannerTrack">

                @foreach($banners as $banner)

                    <div class="banner-slide">

                        <img
                            src="{{ asset('storage/' . $banner->image) }}"
                            alt="{{ $banner->title }}"
                            draggable="false"
                        >

                        <div class="banner-content">

                            <p class="hero-label">AMOLE SOFA PROMOTION</p>

                            <h1>{{ $banner->title }}</h1>

                            @if($banner->subtitle)
                                <p>{{ $banner->subtitle }}</p>
                            @endif

                            @if($banner->button_text)
                                <a
                                    href="{{ $banner->button_link ?: '#produk' }}"
                                    class="banner-button"
                                >
                                    {{ $banner->button_text }}
                                </a>
                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

            @if($banners->count() > 1)

                <button
                    type="button"
                    class="banner-arrow banner-prev"
                    id="bannerPrev"
                    aria-label="Banner sebelumnya"
                >
                    ‹
                </button>

                <button
                    type="button"
                    class="banner-arrow banner-next"
                    id="bannerNext"
                    aria-label="Banner berikutnya"
                >
                    ›
                </button>

                <div class="banner-dots" id="bannerDots">

                    @foreach($banners as $index => $banner)

                        <button
                            type="button"
                            class="banner-dot {{ $index === 0 ? 'active' : '' }}"
                            data-index="{{ $index }}"
                            aria-label="Banner {{ $index + 1 }}"
                        ></button>

                    @endforeach

                </div>

            @endif

        @else

            <!-- TAMPILAN CADANGAN JIKA BELUM ADA BANNER AKTIF -->
            <div class="hero-content">

                <p class="hero-label">KOLEKSI SOFA</p>

                <h1>
                    Sofa untuk Setiap<br>
                    Ruang dan Gaya Hidup
                </h1>

                <p>
                    Temukan berbagai pilihan sofa berkualitas
                    dengan desain modern yang cocok untuk
                    rumah impian Anda.
                </p>

            </div>

        @endif

    </section>


    <!-- BREADCRUMB -->
    <div class="breadcrumb">

        <a href="{{ route('home') }}">Home</a>

        <span>›</span>

        <span>Produk</span>

    </div>


    <!-- KATALOG -->
    <main class="catalog-container">

        <aside class="sidebar">

            <h3 class="filter-title">Filter</h3>

            <div class="filter-group" id="kategori">

                <div class="filter-heading">
                    <h4>Kategori Produk</h4>
                </div>

                <select id="categorySelect" class="category-select">

                    <option value="all">
                        Semua Kategori
                    </option>

                    @foreach ($categories as $category)

                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="filter-group">

                <div class="filter-heading">
                    <h4>Lainnya</h4>
                    <span>⌄</span>
                </div>

                <label class="filter-option">
                    <input type="checkbox" id="discountFilter">
                    <span>Diskon</span>
                </label>

                <label class="filter-option">
                    <input type="checkbox" id="newFilter">
                    <span>Produk Baru</span>
                </label>

            </div>

            <div class="sidebar-promo">

                <div>
                    <p>Diskon Hingga</p>
                    <h2>50%</h2>
                    <small>Untuk koleksi sofa pilihan</small>

                    <a href="#produk">
                        Belanja Sekarang →
                    </a>
                </div>

            </div>

        </aside>


        <!-- DAFTAR PRODUK -->
        <section class="catalog-content" id="produk">

            <div class="catalog-toolbar">

                <p>
                    Menampilkan
                    <strong id="productCount">{{ $products->count() }}</strong>
                    produk
                </p>

                <div class="toolbar-actions">

                    <label for="sortProducts">
                        Urutkan:
                    </label>

                    <select id="sortProducts">
                        <option value="latest">Terbaru</option>
                        <option value="price-low">Harga Terendah</option>
                        <option value="price-high">Harga Tertinggi</option>
                        <option value="name">Nama Produk</option>
                    </select>

                </div>

            </div>


            <div class="product-grid" id="productGrid">

                @forelse ($products as $product)

                    @php
                        $hasDiscount = $product->discount_price &&
                            $product->discount_price < $product->price;

                        $displayPrice = $hasDiscount
                            ? $product->discount_price
                            : $product->price;

                        $isNew = (bool) $product->is_new;
                    @endphp

                    <article
                        class="product-card"
                        data-name="{{ strtolower($product->name) }}"
                        data-category="{{ $product->category_id }}"
                        data-price="{{ $displayPrice }}"
                        data-discount="{{ $hasDiscount ? '1' : '0' }}"
                        data-new="{{ $isNew ? '1' : '0' }}"
                        data-created="{{ $product->created_at ? $product->created_at->timestamp : 0 }}"
                        data-id="{{ $product->id }}"
                    >

                        <div class="product-image">

                            @if ($isNew)
                                <span class="new-label">BARU</span>
                            @endif

                            @if ($hasDiscount)
                                <span class="sale-label">SALE</span>
                            @endif

                            <a
                                href="{{ url('/produk/' . $product->id) }}"
                                class="product-detail-link"
                                aria-label="Lihat detail {{ $product->name }}"
                            >

                                @if ($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="image-placeholder">
                                        <span>AMOLE SOFA</span>
                                    </div>

                                @endif

                            </a>

                        </div>


                        <div class="product-info">

                            <p class="product-category">
                                {{ $product->category->name ?? 'Furniture' }}
                            </p>

                            <h3>
                                <a
                                    href="{{ url('/produk/' . $product->id) }}"
                                    class="product-name-link"
                                >
                                    {{ $product->name }}
                                </a>
                            </h3>

                            @if ($hasDiscount)

                                <p class="old-price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                            @endif

                            <p class="product-price">
                                Rp {{ number_format($displayPrice, 0, ',', '.') }}
                            </p>

                        </div>

                    </article>

                @empty

                    <p class="empty-product">
                        Belum ada produk tersedia.
                    </p>

                @endforelse

            </div>

            <p id="emptyFilter" class="empty-product" hidden>
                Produk yang kamu cari tidak ditemukan.
            </p>

        </section>

    </main>


    <!-- LAYANAN AMOLE SOFA -->
    <section class="services-section" id="layanan">

        <div class="services-heading">

            <span>OUR SERVICES</span>

            <h2>Layanan AMOLE SOFA</h2>

            <p>
                Selain menyediakan sofa berkualitas,
                AMOLE SOFA juga melayani perawatan,
                perbaikan, dan pembuatan sofa sesuai kebutuhan Anda.
            </p>

        </div>

        <div class="services-grid">

            <!-- SERVICE DAN REPARASI -->
            <article class="service-card" id="service-reparasi">

                <div class="service-image">

                    @php
                        $fotoReparasi = $websiteImages->get('service_reparasi')?->image
                            ?? 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=700';

                        $fotoReparasiUrl = str_starts_with($fotoReparasi, 'http')
                            ? $fotoReparasi
                            : asset('storage/' . $fotoReparasi);
                    @endphp

                    <img
                        src="{{ $fotoReparasiUrl }}"
                        alt="Service dan Reparasi Sofa"
                        loading="lazy"
                    >

                </div>

                <div class="service-info">

                    <h3>Service dan Reparasi Sofa</h3>

                    <p>
                        Memperbaiki sofa yang rusak, jahitan lepas,
                        rangka bermasalah, dan bagian sofa lainnya
                        agar kembali nyaman digunakan.
                    </p>

                    <a href="{{ route('layanan.reparasi') }}" class="service-link">
                        Konsultasi Layanan →
                    </a>

                </div>

            </article>


            <!-- GANTI KAIN SOFA -->
            <article class="service-card" id="service-kain">

                <div class="service-image">

                    @php
                        $fotoKain = $websiteImages->get('service_kain')?->image
                            ?? 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=700';

                        $fotoKainUrl = str_starts_with($fotoKain, 'http')
                            ? $fotoKain
                            : asset('storage/' . $fotoKain);
                    @endphp

                    <img
                        src="{{ $fotoKainUrl }}"
                        alt="Ganti Kain Sofa"
                        loading="lazy"
                    >

                </div>

                <div class="service-info">

                    <h3>Ganti Kain Sofa</h3>

                    <p>
                        Memperbarui tampilan sofa dengan pilihan
                        kain pelapis, motif, tekstur, dan warna
                        sesuai selera Anda.
                    </p>

                    <a href="{{ route('layanan.kain') }}" class="service-link">
                        Konsultasi Layanan →
                    </a>

                </div>

            </article>


            <!-- GANTI BUSA SOFA -->
            <article class="service-card" id="service-busa">

                <div class="service-image">

                    @php
                        $fotoBusa = $websiteImages->get('service_busa')?->image
                            ?? 'https://images.unsplash.com/photo-1550254478-ead40cc54513?w=700';

                        $fotoBusaUrl = str_starts_with($fotoBusa, 'http')
                            ? $fotoBusa
                            : asset('storage/' . $fotoBusa);
                    @endphp

                    <img
                        src="{{ $fotoBusaUrl }}"
                        alt="Ganti Busa Sofa"
                        loading="lazy"
                    >

                </div>

                <div class="service-info">

                    <h3>Ganti Busa Sofa</h3>

                    <p>
                        Mengganti busa sofa yang kempes,
                        keras, atau sudah tidak nyaman
                        agar kembali empuk dan nyaman.
                    </p>

                    <a href="{{ route('layanan.busa') }}" class="service-link">
                        Konsultasi Layanan →
                    </a>

                </div>

            </article>


            <!-- PEMBUATAN SOFA CUSTOM -->
            <article class="service-card" id="service-custom">

                <div class="service-image">

                    @php
                        $fotoCustom = $websiteImages->get('service_custom')?->image
                            ?? 'https://images.unsplash.com/photo-1550254478-ead40cc54513?w=700';

                        $fotoCustomUrl = str_starts_with($fotoCustom, 'http')
                            ? $fotoCustom
                            : asset('storage/' . $fotoCustom);
                    @endphp

                    <img
                        src="{{ $fotoCustomUrl }}"
                        alt="Pembuatan Sofa Custom"
                        loading="lazy"
                    >

                </div>

                <div class="service-info">

                    <h3>Pembuatan Sofa Custom</h3>

                    <p>
                        Membuat sofa dengan ukuran, model,
                        bahan, dan warna sesuai keinginan
                        serta kebutuhan ruangan Anda.
                    </p>

                    <a href="{{ route('layanan.custom') }}" class="service-link">
                        Konsultasi Layanan →
                    </a>

                </div>

            </article>

        </div>

    </section>


    <!-- GALERI AMOLE SOFA -->
    @php
        $galleries = \App\Models\Gallery::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->get();
    @endphp

    <section class="gallery-section" id="galeri">

        <div class="gallery-container">

            <div class="gallery-heading">

                <span>OUR GALLERY</span>

                <h2>Galeri AMOLE SOFA</h2>

                <p>
                    Temukan inspirasi desain dan berbagai hasil karya
                    AMOLE SOFA yang menghadirkan kenyamanan serta
                    keindahan untuk setiap ruangan.
                </p>

            </div>

            <div class="gallery-grid">

                @forelse ($galleries as $gallery)

                    <article class="gallery-card">

                        <img
                            src="{{ asset('storage/' . $gallery->image) }}"
                            alt="{{ $gallery->title }}"
                            loading="lazy"
                        >

                        <div class="gallery-card-overlay">

                            <h3>{{ $gallery->title }}</h3>

                            @if ($gallery->description)
                                <p>{{ $gallery->description }}</p>
                            @endif

                        </div>

                    </article>

                @empty

                    <div class="gallery-empty">
                        <p>Belum ada foto galeri yang tersedia.</p>
                    </div>

                @endforelse

            </div>

        </div>

    </section>


    <!-- TENTANG KAMI -->
    <section class="about-section" id="tentang">

        <div class="about-container">

            <span class="about-label">ABOUT US</span>

            <h2>TENTANG KAMI</h2>

            <h3>CV. Amole Inti Perkasa</h3>

            <p>
                AMOLE SOFA merupakan usaha yang bergerak di bidang
                pembuatan, perbaikan, dan custom sofa. Kami menghadirkan
                sofa dan kursi berkualitas dengan mengutamakan kenyamanan,
                kualitas bahan, serta desain yang sesuai dengan kebutuhan
                pelanggan. Kami berkomitmen memberikan pelayanan terbaik
                untuk menciptakan kenyamanan dan keindahan di setiap ruangan.
            </p>
        </div>

    </section>


    <!-- FOOTER -->
    <footer class="footer" id="kontak">

        <div class="footer-brand">

            <h2>AMOLE SOFA</h2>

            <p>
                Menghadirkan sofa berkualitas dengan desain menarik,
                kenyamanan maksimal, dan pengerjaan yang mengutamakan
                kepuasan pelanggan.
            </p>

        </div>

        <div class="footer-column">

            <h4>Navigasi</h4>

            <a href="{{ route('home') }}">Home</a>
            <a href="#produk">Produk</a>
            <a href="#galeri">Galeri</a>
            <a href="#layanan">Layanan</a>
            <a href="#tentang">Tentang Kami</a>

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

            <p><strong>CV. Amole Inti Perkasa</strong></p>

            <p>
                Jl. Bintaro Permai Raya RT 02/04 No. 90,
                Pesanggrahan, Jakarta Selatan
            </p>

            <p>
                Telepon:
                <a href="tel:+6281514744233">
                    +62 815-1474-4233
                </a>
            </p>

            <p>
                WhatsApp:
                <a
                    href="https://wa.me/6281514744233"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    +62 815-1474-4233
                </a>
            </p>

        </div>

        <div class="footer-column">

            <h4>Newsletter</h4>

            <p>
                Dapatkan informasi terbaru dari AMOLE SOFA.
            </p>

            <form class="newsletter-form">

                <input
                    type="email"
                    placeholder="Masukkan email Anda"
                >

                <button type="button">→</button>

            </form>

        </div>

    
<!-- LOKASI WORKSHOP GOOGLE MAPS -->
<div class="footer-map">

    <h4>Lokasi Workshop Kami</h4>

    <p>
        Kunjungi workshop CV. Amole Inti Perkasa
        di Pesanggrahan, Jakarta Selatan.
    </p>

    <iframe
        src="https://maps.google.com/maps?q=Jl.%20Bintaro%20Permai%20Raya%20No.%2090%2C%20Pesanggrahan%2C%20Jakarta%20Selatan&t=&z=16&ie=UTF8&iwloc=&output=embed"
        width="100%"
        height="300"
        style="border:0; border-radius:12px;"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>

    <p style="margin-top: 12px;">
        <a
            href="https://www.google.com/maps/search/?api=1&query=Jl.+Bintaro+Permai+Raya+No.+90%2C+Pesanggrahan%2C+Jakarta+Selatan"
            target="_blank"
            rel="noopener noreferrer">
            Lihat petunjuk arah di Google Maps →
        </a>
    </p>

</div>



        <div class="footer-bottom">
            © {{ date('Y') }} CV. Amole Inti Perkasa. All rights reserved.
        </div>

    </footer>



    <!-- MOBILE BOTTOM NAVIGATION -->
    <nav class="mobile-bottom-nav">

        <a href="{{ route('home') }}">
            <span>⌂</span>
            Beranda
        </a>

        <a href="#produk">
            <span>▦</span>
            Produk
        </a>

        @auth

            <a href="{{ route('wishlist.index') }}">
                <span>♡</span>
                Wishlist
            </a>

            <a href="{{ route('orders.mine') }}">
                <span>▤</span>
                Pesanan
            </a>

            <a href="{{ route('layanan.mine') }}">
                <span>✧</span>
                Layanan
            </a>

        @else

            <a href="{{ route('login') }}">
                <span>♙</span>
                Akun
            </a>

        @endauth

    </nav>


    <!-- JAVASCRIPT FILTER, SORTING DAN SLIDER -->
    <script>

        const searchInput = document.getElementById('searchInput');
        const categorySelect = document.getElementById('categorySelect');
        const discountFilter = document.getElementById('discountFilter');
        const newFilter = document.getElementById('newFilter');
        const sortProducts = document.getElementById('sortProducts');
        const productGrid = document.getElementById('productGrid');
        const productCount = document.getElementById('productCount');
        const emptyFilter = document.getElementById('emptyFilter');

        // FILTER PRODUK
        function filterProducts() {

            const search = searchInput.value.toLowerCase().trim();
            const selectedCategory = categorySelect.value;
            const discountOnly = discountFilter.checked;
            const newOnly = newFilter.checked;

            const cards = Array.from(
                productGrid.querySelectorAll('.product-card')
            );

            let visibleCount = 0;

            cards.forEach(card => {

                const matchesSearch =
                    card.dataset.name.includes(search);

                const matchesCategory =
                    selectedCategory === 'all' ||
                    selectedCategory === card.dataset.category;

                const matchesDiscount =
                    !discountOnly ||
                    card.dataset.discount === '1';

                const matchesNew =
                    !newOnly ||
                    card.dataset.new === '1';

                const visible =
                    matchesSearch &&
                    matchesCategory &&
                    matchesDiscount &&
                    matchesNew;

                card.style.display = visible ? '' : 'none';

                if (visible) {
                    visibleCount++;
                }

            });

            productCount.textContent = visibleCount;
            emptyFilter.hidden = visibleCount !== 0;

        }

        // PENCARIAN PRODUK
        searchInput.addEventListener('input', filterProducts);

        // FILTER KATEGORI
        categorySelect.addEventListener('change', filterProducts);

        // FILTER DISKON
        discountFilter.addEventListener('change', filterProducts);

        // FILTER PRODUK BARU
        newFilter.addEventListener('change', filterProducts);

        // PENGURUTAN PRODUK
        sortProducts.addEventListener('change', function () {

            const cards = Array.from(
                productGrid.querySelectorAll('.product-card')
            );

            const mode = this.value;

            cards.sort((a, b) => {

                if (mode === 'price-low') {
                    return Number(a.dataset.price) -
                           Number(b.dataset.price);
                }

                if (mode === 'price-high') {
                    return Number(b.dataset.price) -
                           Number(a.dataset.price);
                }

                if (mode === 'name') {
                    return a.dataset.name.localeCompare(b.dataset.name);
                }

                if (mode === 'latest') {
                    return Number(b.dataset.created) -
                           Number(a.dataset.created);
                }

                return 0;

            });

            cards.forEach(card => {
                productGrid.appendChild(card);
            });

            filterProducts();

        });

        // TAMPILKAN JUMLAH PRODUK AWAL
        filterProducts();


        // SLIDER BANNER PROMO
        const bannerTrack = document.getElementById('bannerTrack');

        if (bannerTrack) {

            const bannerSlides = bannerTrack.querySelectorAll('.banner-slide');
            const bannerDots = document.querySelectorAll('.banner-dot');
            const bannerPrev = document.getElementById('bannerPrev');
            const bannerNext = document.getElementById('bannerNext');

            let currentBanner = 0;
            let startX = 0;
            let moveX = 0;
            let isDragging = false;
            let autoplay = null;

            function showBanner(index) {

                if (index < 0) {
                    index = bannerSlides.length - 1;
                }

                if (index >= bannerSlides.length) {
                    index = 0;
                }

                currentBanner = index;

                bannerTrack.style.transform =
                    `translateX(-${currentBanner * 100}%)`;

                bannerDots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentBanner);
                });

            }

            function nextBanner() {
                showBanner(currentBanner + 1);
            }

            function prevBanner() {
                showBanner(currentBanner - 1);
            }

            function startAutoplay() {

                if (bannerSlides.length <= 1) return;

                stopAutoplay();

                autoplay = setInterval(() => {
                    nextBanner();
                }, 5000);

            }

            function stopAutoplay() {
                clearInterval(autoplay);
            }

            if (bannerSlides.length > 1) {

                bannerNext.addEventListener('click', () => {
                    nextBanner();
                    startAutoplay();
                });

                bannerPrev.addEventListener('click', () => {
                    prevBanner();
                    startAutoplay();
                });

                bannerDots.forEach((dot, index) => {

                    dot.addEventListener('click', () => {
                        showBanner(index);
                        startAutoplay();
                    });

                });

                // DRAG / GESER BANNER
                bannerTrack.addEventListener('pointerdown', (event) => {

                    if (event.target.closest('a')) return;

                    startX = event.clientX;
                    moveX = 0;
                    isDragging = true;

                    bannerTrack.classList.add('dragging');

                    stopAutoplay();

                    bannerTrack.setPointerCapture(event.pointerId);

                });

                bannerTrack.addEventListener('pointermove', (event) => {

                    if (!isDragging) return;

                    moveX = event.clientX - startX;

                });

                function finishDrag() {

                    if (!isDragging) return;

                    isDragging = false;

                    bannerTrack.classList.remove('dragging');

                    if (moveX < -50) {
                        nextBanner();
                    } else if (moveX > 50) {
                        prevBanner();
                    } else {
                        showBanner(currentBanner);
                    }

                    moveX = 0;

                    startAutoplay();

                }

                bannerTrack.addEventListener('pointerup', finishDrag);
                bannerTrack.addEventListener('pointercancel', finishDrag);

                // HENTIKAN OTOMATIS SAAT KURSOR DI ATAS BANNER
                const promoBanner = document.getElementById('promoBanner');

                promoBanner.addEventListener('mouseenter', stopAutoplay);
                promoBanner.addEventListener('mouseleave', startAutoplay);

            }

            // MULAI SLIDER
            showBanner(0);
            startAutoplay();

        }

    </script>

</body>
</html>
