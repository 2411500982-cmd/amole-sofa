@extends('layouts.app')

@section('title', $product->name . ' - AMOLE SOFA')

@section('content')

@php
    $hasDiscount = $product->discount_price &&
        $product->discount_price < $product->price;

    $finalPrice = $hasDiscount
        ? $product->discount_price
        : $product->price;

    $discountPercent = $hasDiscount
        ? round((($product->price - $product->discount_price) / $product->price) * 100)
        : 0;

    // Memeriksa Wishlist pengguna yang sedang login
    $isWishlisted = auth()->check()
        && $product->wishlists()
            ->where('user_id', auth()->id())
            ->exists();
@endphp

<style>
    .amole-detail {
        max-width: 1200px;
        margin: auto;
        padding: 28px 25px 60px;
        color: #302820;
        font-family: Arial, sans-serif;
    }

    .amole-detail * {
        box-sizing: border-box;
    }

    /* PESAN NOTIFIKASI */

    .amole-alert {
        padding: 12px 16px;
        margin-bottom: 20px;
        background: #edf7ed;
        color: #286b35;
        border: 1px solid #c8e6c9;
        border-radius: 5px;
        font-size: 13px;
    }

    .amole-breadcrumb {
        font-size: 12px;
        color: #888;
        margin-bottom: 22px;
    }

    .amole-breadcrumb a {
        color: #777;
        text-decoration: none;
    }

    .amole-breadcrumb span {
        color: #302820;
        font-weight: 600;
    }

    /* PRODUK UTAMA */

    .amole-product-main {
        display: grid;
        grid-template-columns: 1.05fr 1fr;
        gap: 25px;
        align-items: start;
    }

    /* GALERI FOTO */

    .amole-gallery {
        display: grid;
        grid-template-columns: 65px 1fr;
        gap: 12px;
        align-items: start;
    }

    .amole-thumbnails {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-height: 370px;
        overflow-y: auto;
        padding: 2px;
    }

    .amole-thumb {
        width: 60px;
        height: 60px;
        min-width: 60px;
        border: 1px solid #e5ded5;
        border-radius: 5px;
        overflow: hidden;
        padding: 0;
        background: #f3eee8;
        cursor: pointer;
        transition: .2s;
    }

    .amole-thumb:hover {
        border-color: #8c7156;
    }

    .amole-thumb.active {
        border: 2px solid #8c7156;
    }

    .amole-thumb img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    /* FOTO UTAMA DAN HOVER ZOOM */

    .amole-main-image {
        position: relative;
        background: #f3eee8;
        border-radius: 6px;
        overflow: hidden;
        width: 100%;
    }

    .amole-main-image img {
        width: 100%;
        height: 370px;
        display: block;
        object-fit: cover;
        transform: scale(1);
        transform-origin: center center;
        transition: transform .15s ease-out;
        user-select: none;
        -webkit-user-drag: none;
    }

    @media (hover: hover) and (pointer: fine) {
        .amole-main-image {
            cursor: crosshair;
        }

        .amole-main-image.is-zoomed img {
            transform: scale(2.5);
            transition: transform .08s ease-out;
        }
    }

    .amole-sale {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #c82e28;
        color: white;
        padding: 6px 10px;
        border-radius: 3px;
        font-size: 11px;
        font-weight: bold;
        pointer-events: none;
        z-index: 2;
    }

    /* INFORMASI PRODUK */

    .amole-product-info {
        padding: 2px 0 0 0;
    }

    .amole-best-seller {
        display: inline-block;
        background: #eee6da;
        color: #8b7156;
        padding: 4px 7px;
        font-size: 10px;
        letter-spacing: 1px;
        font-weight: bold;
        border-radius: 2px;
        margin-bottom: 8px;
    }

    .amole-product-info h1 {
        font-family: Georgia, serif;
        font-size: 30px;
        font-weight: 500;
        line-height: 1.25;
        margin: 0 0 10px;
    }

    .amole-rating {
        font-size: 12px;
        color: #777;
        margin-bottom: 15px;
    }

    .amole-stars {
        color: #f39a32;
        letter-spacing: 1px;
        font-size: 15px;
        margin-right: 6px;
    }

    .amole-old-price {
        color: #999;
        font-size: 13px;
        text-decoration: line-through;
        margin-bottom: 5px;
    }

    .amole-price-line {
        display: flex;
        align-items: center;
        gap: 13px;
        flex-wrap: wrap;
    }

    .amole-price {
        color: #c72e27;
        font-size: 26px;
        font-weight: 700;
    }

    .amole-discount {
        background: #c72e27;
        color: white;
        padding: 5px 8px;
        font-size: 11px;
        font-weight: bold;
        border-radius: 3px;
    }

    /* WISHLIST */

    .amole-wishlist-form {
        display: inline-block;
        margin-top: 20px;
    }

    .amole-wishlist {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 0;
        border: none;
        background: transparent;
        color: #302820;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        transition: .2s;
    }

    .amole-wishlist:hover {
        color: #c72e27;
    }

    .amole-wishlist-icon {
        font-size: 25px;
        line-height: 1;
        font-weight: 400;
    }

    .amole-wishlist.is-active {
        color: #c72e27;
    }

    .amole-wishlist.is-active .amole-wishlist-icon {
        color: #c72e27;
    }

    .amole-description-short {
        color: #777;
        font-size: 13px;
        line-height: 1.7;
        margin: 16px 0 20px;
    }

    /* JUMLAH PRODUK */

    .amole-option-title {
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .amole-quantity-row {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-bottom: 19px;
        flex-wrap: wrap;
    }

    .amole-quantity {
        display: flex;
        align-items: center;
        height: 39px;
        border: 1px solid #e3ded8;
        border-radius: 6px;
        overflow: hidden;
    }

    .amole-quantity button {
        width: 35px;
        height: 38px;
        border: none;
        background: white;
        font-size: 19px;
        cursor: pointer;
    }

    .amole-quantity input {
        width: 38px;
        height: 38px;
        border: none;
        outline: none;
        text-align: center;
        font-size: 13px;
        background: white;
    }

    .amole-stock {
        font-size: 11px;
        color: #777;
    }

    /* TOMBOL PRE ORDER */

    .amole-buy-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 25px;
    }

    .amole-btn-whatsapp {
        width: 100%;
        min-height: 55px;
        border-radius: 7px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 12px;
        transition: .2s;
        background: #000000;
        color: #ffffff;
        border: 1px solid #000000;
    }

    .amole-btn-whatsapp:hover {
        background: #222222;
        color: #ffffff;
    }

    .amole-btn-cart {
        width: 100%;
        min-height: 48px;
        border-radius: 7px;
        background: #3b3027;
        color: white;
        border: 1px solid #3b3027;
        font-size: 14px;
        font-weight: bold;
    }

    /* LAYANAN */

    .amole-services {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        padding-top: 4px;
    }

    .amole-service {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        color: #555;
    }

    .amole-service-icon {
        font-size: 19px;
    }

    .amole-service small {
        display: block;
        font-size: 9px;
        color: #999;
        margin-top: 4px;
    }

    /* TAB INFORMASI */

    .amole-tabs {
        margin-top: 65px;
        border-bottom: 1px solid #e5ded5;
        display: flex;
        gap: 25px;
    }

    .amole-tab {
        background: transparent;
        border: none;
        padding: 12px 15px;
        font-size: 12px;
        color: #777;
        cursor: pointer;
    }

    .amole-tab.active {
        color: #302820;
        font-weight: bold;
        border-bottom: 2px solid #806348;
    }

    .amole-tab-content {
        display: none;
        padding: 25px 0;
    }

    .amole-tab-content.active {
        display: block;
    }

    .amole-tab-content h3 {
        font-family: Georgia, serif;
        font-size: 20px;
        font-weight: 500;
        margin: 0 0 15px;
    }

    .amole-tab-content p {
        font-size: 13px;
        line-height: 1.8;
        color: #777;
    }

    .amole-description-layout {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 35px;
    }

    .amole-benefits {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }

    .amole-benefits li {
        font-size: 12px;
        color: #666;
        margin-bottom: 12px;
    }

    .amole-benefits li::before {
        content: "✓";
        color: #806348;
        font-weight: bold;
        margin-right: 9px;
    }

    .amole-spec-card {
        background: #f7f5f2;
        padding: 20px;
        border-radius: 7px;
    }

    .amole-spec-row {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 10px;
        padding: 11px 0;
        border-bottom: 1px solid #e8e3dd;
        font-size: 11px;
        line-height: 1.6;
    }

    .amole-spec-row:last-child {
        border-bottom: none;
    }

    .amole-spec-row span:first-child {
        color: #888;
    }

    /* PRODUK TERKAIT */

    .amole-related {
        margin-top: 35px;
    }

    .amole-related h2 {
        font-family: Georgia, serif;
        font-size: 25px;
        font-weight: 500;
        margin-bottom: 22px;
    }

    .amole-related-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .amole-related-card {
        color: #302820;
        text-decoration: none;
        border: 1px solid #eee9e3;
        border-radius: 6px;
        overflow: hidden;
        transition: .2s;
    }

    .amole-related-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px #00000010;
    }

    .amole-related-card img {
        width: 100%;
        height: 145px;
        object-fit: cover;
        display: block;
        background: #f3eee8;
    }

    .amole-related-info {
        padding: 10px;
    }

    .amole-related-info h3 {
        font-size: 11px;
        font-weight: 600;
        margin: 0 0 7px;
    }

    .amole-related-info p {
        color: #c72e27;
        font-size: 12px;
        font-weight: bold;
        margin: 0;
    }

    /* BANNER BAWAH */

    .amole-bottom-banner {
        margin-top: 30px;
        min-height: 145px;
        border-radius: 6px;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 25px 35px;
        background:
            linear-gradient(90deg, #eee3d6 0%, #eee3d6dd 35%, #ffffff00 100%),
            url('{{ $product->image ? asset("storage/" . $product->image) : "https://placehold.co/1200x300?text=AMOLE+SOFA" }}') center 55% / cover;
    }

    .amole-bottom-banner h2 {
        font-family: Georgia, serif;
        font-size: 24px;
        font-weight: 500;
        margin: 5px 0 15px;
    }

    .amole-bottom-banner p {
        font-size: 10px;
        letter-spacing: 2px;
        color: #806348;
    }

    .amole-bottom-banner a {
        display: inline-block;
        background: white;
        color: #302820;
        text-decoration: none;
        border-radius: 20px;
        padding: 9px 15px;
        font-size: 11px;
    }

    /* RESPONSIVE HP */

    @media(max-width: 768px) {
        .amole-detail {
            padding: 20px 15px 45px;
        }

        .amole-product-main {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .amole-gallery {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .amole-main-image {
            order: 1;
        }

        .amole-thumbnails {
            order: 2;
            flex-direction: row;
            max-height: none;
            overflow-x: auto;
            overflow-y: hidden;
            padding-bottom: 5px;
        }

        .amole-thumb {
            flex: 0 0 60px;
        }

        .amole-main-image img {
            height: 310px;
            transform: none !important;
        }

        .amole-product-info h1 {
            font-size: 26px;
        }

        .amole-price {
            font-size: 23px;
        }

        .amole-services {
            gap: 7px;
        }

        .amole-service {
            font-size: 9px;
        }

        .amole-service small {
            font-size: 8px;
        }

        .amole-tabs {
            margin-top: 40px;
            gap: 5px;
            justify-content: space-between;
        }

        .amole-tab {
            padding: 12px 7px;
            font-size: 11px;
        }

        .amole-description-layout {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .amole-related-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .amole-related-card img {
            height: 125px;
        }

        .amole-bottom-banner {
            min-height: 130px;
            padding: 18px;
        }

        .amole-bottom-banner h2 {
            font-size: 19px;
        }
    }
</style>

<div class="amole-detail">

    <!-- NOTIFIKASI WISHLIST -->

    @if (session('success'))
        <div class="amole-alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- BREADCRUMB -->

    <div class="amole-breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        &nbsp; › &nbsp;
        {{ $product->category->name ?? 'Produk' }}
        &nbsp; › &nbsp;
        <span>{{ $product->name }}</span>
    </div>

    <!-- PRODUK UTAMA -->

    <div class="amole-product-main">

        <!-- GALERI FOTO PRODUK -->

        @php
            $galleryImages = collect();

            if ($product->image) {
                $galleryImages->push($product->image);
            }

            if ($product->images) {
                $galleryImages = $galleryImages->merge(
                    $product->images->pluck('image_path')
                );
            }

            $galleryImages = $galleryImages
                ->filter()
                ->unique()
                ->values();
        @endphp

        <div class="amole-gallery">

            <!-- THUMBNAIL FOTO -->

            <div class="amole-thumbnails">

                @foreach ($galleryImages as $index => $imagePath)
                    <button
                        type="button"
                        class="amole-thumb {{ $index === 0 ? 'active' : '' }}"
                        data-image="{{ asset('storage/' . $imagePath) }}"
                        aria-label="Lihat foto {{ $index + 1 }}"
                    >
                        <img
                            src="{{ asset('storage/' . $imagePath) }}"
                            alt="{{ $product->name }} - Foto {{ $index + 1 }}"
                        >
                    </button>
                @endforeach

            </div>

            <!-- FOTO UTAMA -->

            <div class="amole-main-image" id="amoleMainImageBox">

                @if ($galleryImages->isNotEmpty())
                    <img
                        id="amoleMainPhoto"
                        src="{{ asset('storage/' . $galleryImages->first()) }}"
                        alt="{{ $product->name }}"
                    >
                @else
                    <img
                        id="amoleMainPhoto"
                        src="https://placehold.co/700x500?text=AMOLE+SOFA"
                        alt="Foto produk AMOLE SOFA"
                    >
                @endif

                @if ($hasDiscount)
                    <span class="amole-sale">SALE</span>
                @endif

            </div>

        </div>

        <!-- INFORMASI PRODUK -->

        <div class="amole-product-info">

            <h1>{{ $product->name }}</h1>

            <div class="amole-rating">
                <span class="amole-stars">★★★★★</span>
                <span>Informasi produk AMOLE SOFA</span>
            </div>

            @if ($hasDiscount)
                <div class="amole-old-price">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>
            @endif

            <div class="amole-price-line">

                <span class="amole-price">
                    Rp {{ number_format($finalPrice, 0, ',', '.') }}
                </span>

                @if ($hasDiscount)
                    <span class="amole-discount">
                        -{{ $discountPercent }}%
                    </span>
                @endif

            </div>

            <!-- ADD TO WISHLIST -->

            @auth
                <form
                    action="{{ route('wishlist.toggle', $product->id) }}"
                    method="POST"
                    class="amole-wishlist-form"
                >
                    @csrf

                    <button
                        type="submit"
                        class="amole-wishlist {{ $isWishlisted ? 'is-active' : '' }}"
                        aria-pressed="{{ $isWishlisted ? 'true' : 'false' }}"
                    >
                        <span class="amole-wishlist-icon">
                            {{ $isWishlisted ? '♥' : '♡' }}
                        </span>

                        <span>
                            {{ $isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                        </span>
                    </button>
                </form>
            @else
                <a
                    href="{{ route('login') }}"
                    class="amole-wishlist"
                >
                    <span class="amole-wishlist-icon">♡</span>
                    <span>Login untuk Add to Wishlist</span>
                </a>
            @endauth

            <!-- DESKRIPSI SINGKAT -->

            <div class="amole-description-short">
                {{ $product->description ?? 'Temukan kenyamanan dan keindahan furniture pilihan dari AMOLE SOFA untuk melengkapi ruangan Anda.' }}
            </div>

            <!-- PRE ORDER -->

            @if ($product->stock > 0)

                <div class="amole-option-title">
                    Jumlah
                </div>

                <div class="amole-quantity-row">

                    <div class="amole-quantity">

                        <button type="button" id="amoleMinus">
                            −
                        </button>

                        <input
                            type="number"
                            id="amoleQuantity"
                            value="1"
                            min="1"
                            max="{{ $product->stock }}"
                            required
                        >

                        <button type="button" id="amolePlus">
                            +
                        </button>

                    </div>

                    <span class="amole-stock">
                        Stok: {{ $product->stock }} tersedia
                    </span>

                </div>

                <div class="amole-buy-buttons">

                    <form
                        action="{{ route('checkout.direct', $product->id) }}"
                        method="GET"
                    >
                        <input
                            type="hidden"
                            name="quantity"
                            id="amoleCheckoutQuantity"
                            value="1"
                        >

                        <button type="submit" class="amole-btn-whatsapp">
                            PRE ORDER 2-3 MINGGU
                        </button>
                    </form>

                </div>

            @else

                <button class="amole-btn-cart" disabled>
                    Stok Habis
                </button>

            @endif

            <!-- LAYANAN -->

            <div class="amole-services">

                <div class="amole-service">
                    <span class="amole-service-icon">♧</span>
                    <div>
                        Gratis Ongkir
                        <small>Syarat dan ketentuan berlaku</small>
                    </div>
                </div>

                <div class="amole-service">
                    <span class="amole-service-icon">♢</span>
                    <div>
                        Garansi Produk
                        <small>Informasi garansi produk</small>
                    </div>
                </div>

                <div class="amole-service">
                    <span class="amole-service-icon">⟳</span>
                    <div>
                        Pengembalian
                        <small>Syarat pengembalian berlaku</small>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- TAB INFORMASI -->

    <div class="amole-tabs">

        <button class="amole-tab active" data-tab="description">
            Deskripsi
        </button>

        <button class="amole-tab" data-tab="specification">
            Spesifikasi
        </button>

        <button class="amole-tab" data-tab="reviews">
            Ulasan
        </button>

    </div>

    <!-- DESKRIPSI -->

    <div class="amole-tab-content active" id="description">

        <div class="amole-description-layout">

            <div>

                <h3>Deskripsi Produk</h3>

                <p>
                    {{ $product->description ?? 'Produk AMOLE SOFA dirancang untuk menghadirkan kenyamanan dan keindahan pada ruangan Anda.' }}
                </p>

                <ul class="amole-benefits">
                    <li>Desain furniture yang elegan dan modern</li>
                    <li>Dirancang untuk kenyamanan ruangan Anda</li>
                    <li>Tampilan yang cocok untuk berbagai interior</li>
                    <li>Tersedia informasi produk pada halaman ini</li>
                </ul>

            </div>

            <div class="amole-spec-card">

                <h3>Spesifikasi Produk</h3>

                <div class="amole-spec-row">
                    <span>Nama Produk</span>
                    <strong>{{ $product->name }}</strong>
                </div>

                <div class="amole-spec-row">
                    <span>Kategori</span>
                    <strong>{{ $product->category->name ?? '-' }}</strong>
                </div>

                <div class="amole-spec-row">
                    <span>Harga</span>
                    <strong>
                        Rp {{ number_format($finalPrice, 0, ',', '.') }}
                    </strong>
                </div>

                <div class="amole-spec-row">
                    <span>Stok</span>
                    <strong>{{ $product->stock }} pcs</strong>
                </div>

                <div class="amole-spec-row">
                    <span>Status</span>
                    <strong>
                        {{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}
                    </strong>
                </div>

            </div>

        </div>

    </div>

    <!-- SPESIFIKASI -->

    <div class="amole-tab-content" id="specification">

        <h3>Spesifikasi Produk</h3>

        <div class="amole-spec-card">

            <div class="amole-spec-row">
                <span>Nama Produk</span>
                <strong>{{ $product->name }}</strong>
            </div>

            <div class="amole-spec-row">
                <span>Kategori</span>
                <strong>{{ $product->category->name ?? '-' }}</strong>
            </div>

            <div class="amole-spec-row">
                <span>Kode Produk</span>
                <strong>{{ $product->id }}</strong>
            </div>

            <div class="amole-spec-row">
                <span>Stok</span>
                <strong>{{ $product->stock }} pcs</strong>
            </div>

        </div>

    </div>

    <!-- ULASAN -->

    <div class="amole-tab-content" id="reviews">

        <h3>Ulasan Pelanggan</h3>

        <p>
            Belum ada ulasan pelanggan untuk produk ini.
        </p>

    </div>

    <!-- PRODUK TERKAIT -->

    @if ($relatedProducts->count() > 0)

        <section class="amole-related">

            <h2>Produk Terkait</h2>

            <div class="amole-related-grid">

                @foreach ($relatedProducts as $related)

                    @php
                        $relatedPrice = $related->discount_price &&
                            $related->discount_price < $related->price
                            ? $related->discount_price
                            : $related->price;
                    @endphp

                    <a
                        href="{{ route('produk.detail', $related->id) }}"
                        class="amole-related-card"
                    >

                        @if ($related->image)
                            <img
                                src="{{ asset('storage/' . $related->image) }}"
                                alt="{{ $related->name }}"
                            >
                        @else
                            <img
                                src="https://placehold.co/400x250?text=AMOLE+SOFA"
                                alt="{{ $related->name }}"
                            >
                        @endif

                        <div class="amole-related-info">

                            <h3>{{ $related->name }}</h3>

                            <p>
                                Rp {{ number_format($relatedPrice, 0, ',', '.') }}
                            </p>

                        </div>

                    </a>

                @endforeach

            </div>

        </section>

    @endif

    <!-- BANNER BAWAH -->

    <div class="amole-bottom-banner">

        <div>

            <p>AMOLE SOFA</p>

            <h2>
                Luxury Comfort<br>
                for Your Home
            </h2>

            <a href="{{ route('home') }}">
                Lihat Koleksi Lainnya →
            </a>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* GALERI FOTO DAN HOVER ZOOM */

    const mainPhoto = document.getElementById('amoleMainPhoto');
    const mainImageBox = document.getElementById('amoleMainImageBox');
    const thumbnails = document.querySelectorAll('.amole-thumb');

    const canHover = window.matchMedia(
        '(hover: hover) and (pointer: fine)'
    ).matches;

    if (mainPhoto && mainImageBox) {

        if (canHover) {

            mainImageBox.addEventListener('mousemove', function (event) {

                const rect = mainImageBox.getBoundingClientRect();

                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;

                const positionX = Math.max(
                    0,
                    Math.min(100, (x / rect.width) * 100)
                );

                const positionY = Math.max(
                    0,
                    Math.min(100, (y / rect.height) * 100)
                );

                mainPhoto.style.transformOrigin =
                    `${positionX}% ${positionY}%`;

                mainImageBox.classList.add('is-zoomed');

            });

            mainImageBox.addEventListener('mouseleave', function () {

                mainImageBox.classList.remove('is-zoomed');

                mainPhoto.style.transformOrigin = 'center center';

            });

        }

        /* GANTI FOTO DARI THUMBNAIL */

        thumbnails.forEach(function (thumbnail) {

            thumbnail.addEventListener('click', function () {

                const newImage = thumbnail.dataset.image;

                if (newImage) {

                    mainImageBox.classList.remove('is-zoomed');

                    mainPhoto.style.transformOrigin = 'center center';

                    mainPhoto.src = newImage;

                }

                thumbnails.forEach(function (item) {
                    item.classList.remove('active');
                });

                thumbnail.classList.add('active');

            });

        });

    }

    /* JUMLAH PRODUK DAN PRE ORDER */

    const quantity = document.getElementById('amoleQuantity');
    const minus = document.getElementById('amoleMinus');
    const plus = document.getElementById('amolePlus');
    const checkoutQuantity = document.getElementById('amoleCheckoutQuantity');

    function updatePurchaseLinks() {

        if (!quantity) return;

        let value = parseInt(quantity.value) || 1;
        let maximum = parseInt(quantity.max) || 1;

        value = Math.min(Math.max(value, 1), maximum);

        quantity.value = value;

        if (checkoutQuantity) {
            checkoutQuantity.value = value;
        }

    }

    if (quantity && minus && plus) {

        minus.addEventListener('click', function () {

            quantity.value = (parseInt(quantity.value) || 1) - 1;

            updatePurchaseLinks();

        });

        plus.addEventListener('click', function () {

            quantity.value = (parseInt(quantity.value) || 1) + 1;

            updatePurchaseLinks();

        });

        quantity.addEventListener('input', updatePurchaseLinks);

        quantity.addEventListener('change', updatePurchaseLinks);

        updatePurchaseLinks();

    }

    /* TAB DESKRIPSI, SPESIFIKASI, ULASAN */

    const tabs = document.querySelectorAll('.amole-tab');
    const contents = document.querySelectorAll('.amole-tab-content');

    tabs.forEach(function (tab) {

        tab.addEventListener('click', function () {

            tabs.forEach(function (item) {
                item.classList.remove('active');
            });

            contents.forEach(function (content) {
                content.classList.remove('active');
            });

            tab.classList.add('active');

            const target = document.getElementById(tab.dataset.tab);

            if (target) {
                target.classList.add('active');
            }

        });

    });

});
</script>

@endsection
