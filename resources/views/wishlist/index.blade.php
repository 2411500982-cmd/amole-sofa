@extends('layouts.app')

@section('title', 'My Wishlist - AMOLE SOFA')

@section('content')

<style>
    .wishlist-page {
        background: #faf8f5;
        min-height: 85vh;
        padding: 55px 6% 85px;
        color: #302820;
    }

    .wishlist-container {
        max-width: 1350px;
        margin: auto;
    }

    /* HEADER */
    .wishlist-hero {
        position: relative;
        background: linear-gradient(110deg, #eee5da, #f8f4ee 65%, #e8ded1);
        padding: 42px 48px;
        border-radius: 10px;
        margin-bottom: 35px;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .wishlist-hero::after {
        content: "♡";
        position: absolute;
        right: 55px;
        top: -55px;
        font-family: Georgia, serif;
        font-size: 240px;
        color: rgba(151, 119, 83, .09);
        pointer-events: none;
    }

    .wishlist-eyebrow {
        color: #98764d;
        font-size: 11px;
        letter-spacing: 3px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .wishlist-hero h1 {
        font-family: Georgia, serif;
        font-size: 39px;
        font-weight: 500;
        margin: 0 0 10px;
    }

    .wishlist-hero p {
        color: #82766a;
        font-size: 14px;
        margin: 0;
        line-height: 1.7;
    }

    .wishlist-total {
        position: relative;
        z-index: 1;
        background: rgba(255,255,255,.65);
        border: 1px solid rgba(151,119,83,.2);
        padding: 19px 28px;
        border-radius: 8px;
        text-align: center;
        min-width: 135px;
    }

    .wishlist-total strong {
        display: block;
        font-family: Georgia, serif;
        font-size: 32px;
        font-weight: 500;
        color: #98764d;
    }

    .wishlist-total span {
        color: #82766a;
        font-size: 11px;
        letter-spacing: 1px;
    }

    /* CONTENT LAYOUT */
    .wishlist-layout {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(260px, .85fr);
        gap: 30px;
        align-items: start;
    }

    .wishlist-main {
        min-width: 0;
    }

    .wishlist-section-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .wishlist-section-heading h2 {
        font-family: Georgia, serif;
        font-size: 23px;
        font-weight: 500;
        margin: 0;
    }

    .wishlist-section-heading span {
        color: #9a8d80;
        font-size: 12px;
    }

    /* PRODUCT GRID */
    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .wishlist-card {
        background: #fff;
        border: 1px solid #eee6dd;
        border-radius: 9px;
        overflow: hidden;
        transition: .3s ease;
    }

    .wishlist-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 13px 30px rgba(48,40,32,.09);
    }

    .wishlist-image-wrap {
        position: relative;
        height: 250px;
        overflow: hidden;
        background: #f3f0ec;
    }

    .wishlist-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
        padding: 12px;
        transition: transform .4s ease;
    }

    .wishlist-card:hover .wishlist-image {
        transform: scale(1.04);
    }

    .wishlist-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a28c75;
        font-family: Georgia, serif;
        font-size: 25px;
    }

    .wishlist-heart {
        position: absolute;
        top: 13px;
        right: 13px;
        width: 39px;
        height: 39px;
        border-radius: 50%;
        background: #fff;
        color: #c36c66;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 3px 12px rgba(0,0,0,.08);
    }

    .wishlist-info {
        padding: 20px;
    }

    .wishlist-category {
        color: #a28a70;
        font-size: 10px;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .wishlist-name {
        font-family: Georgia, serif;
        font-size: 21px;
        font-weight: 500;
        margin: 0 0 10px;
        line-height: 1.4;
    }

    .wishlist-price {
        font-size: 15px;
        font-weight: 700;
        color: #47372b;
        margin-bottom: 19px;
    }

    .wishlist-actions {
        display: flex;
        gap: 10px;
    }

    .wishlist-detail {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #3d332b;
        color: #fff;
        text-decoration: none;
        padding: 12px;
        border-radius: 4px;
        font-size: 11px;
        letter-spacing: 1px;
        transition: .2s;
    }

    .wishlist-detail:hover {
        background: #98764d;
        color: #fff;
    }

    .wishlist-remove {
        width: 43px;
        border: 1px solid #eadfd5;
        border-radius: 4px;
        background: #fff;
        color: #bd6861;
        font-size: 19px;
        cursor: pointer;
        transition: .2s;
    }

    .wishlist-remove:hover {
        background: #fbefed;
        border-color: #bd6861;
    }

    /* SIDE PANEL */
    .wishlist-aside {
        background: #fff;
        border: 1px solid #eee6dd;
        border-radius: 9px;
        overflow: hidden;
    }

    .wishlist-aside-banner {
        background: #e9dfd3;
        padding: 30px 25px;
        text-align: center;
    }

    .wishlist-aside-banner span {
        display: block;
        font-size: 32px;
        color: #98764d;
        margin-bottom: 12px;
    }

    .wishlist-aside-banner h3 {
        font-family: Georgia, serif;
        font-size: 23px;
        font-weight: 500;
        margin: 0;
        line-height: 1.4;
    }

    .wishlist-aside-content {
        padding: 25px;
    }

    .wishlist-aside-content > p {
        color: #82766a;
        font-size: 13px;
        line-height: 1.8;
        margin: 0 0 22px;
    }

    .wishlist-benefit {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 17px;
    }

    .wishlist-benefit-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        background: #f5eee6;
        color: #98764d;
        font-size: 16px;
    }

    .wishlist-benefit strong {
        display: block;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .wishlist-benefit small {
        display: block;
        font-size: 11px;
        color: #918579;
        line-height: 1.6;
    }

    .wishlist-shop {
        display: block;
        width: 100%;
        text-align: center;
        padding: 13px;
        background: #3d332b;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        font-size: 11px;
        letter-spacing: 1px;
        transition: .2s;
    }

    .wishlist-shop:hover {
        background: #98764d;
        color: #fff;
    }

    /* EMPTY STATE */
    .wishlist-empty {
        background: #fff;
        border: 1px solid #eee6dd;
        border-radius: 9px;
        padding: 65px 20px;
        text-align: center;
    }

    .wishlist-empty-icon {
        font-family: Georgia, serif;
        font-size: 65px;
        color: #b69a7b;
        margin-bottom: 12px;
    }

    .wishlist-empty h2 {
        font-family: Georgia, serif;
        font-weight: 500;
        font-size: 27px;
        margin: 0 0 12px;
    }

    .wishlist-empty p {
        color: #918579;
        font-size: 13px;
        margin-bottom: 25px;
    }

    .wishlist-alert {
        background: #edf6ed;
        color: #397344;
        padding: 13px 17px;
        margin-bottom: 22px;
        border-radius: 5px;
        font-size: 13px;
    }

    @media (max-width: 900px) {
        .wishlist-layout {
            grid-template-columns: 1fr;
        }

        .wishlist-aside {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .wishlist-aside-banner {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    }

    @media (max-width: 600px) {
        .wishlist-page {
            padding: 30px 16px 55px;
        }

        .wishlist-hero {
            padding: 28px 22px;
            align-items: flex-start;
            flex-direction: column;
            gap: 20px;
        }

        .wishlist-hero h1 {
            font-size: 30px;
        }

        .wishlist-hero::after {
            right: 0;
            font-size: 150px;
        }

        .wishlist-total {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 17px;
        }

        .wishlist-total strong {
            font-size: 24px;
        }

        .wishlist-grid {
            grid-template-columns: 1fr;
        }

        .wishlist-image-wrap {
            height: 240px;
        }

        .wishlist-aside {
            display: block;
        }
    }
</style>

<div class="wishlist-page">
    <div class="wishlist-container">

        <!-- HEADER WISHLIST -->
        <section class="wishlist-hero">
            <div>
                <div class="wishlist-eyebrow">YOUR PERSONAL COLLECTION</div>
                <h1>My Wishlist</h1>
                <p>
                    Simpan sofa favorit Anda dan temukan inspirasi
                    untuk ruang yang lebih nyaman.
                </p>
            </div>

            <div class="wishlist-total">
                <strong>{{ $wishlists->count() }}</strong>
                <span>PRODUK TERSIMPAN</span>
            </div>
        </section>

        @if(session('success'))
            <div class="wishlist-alert">
                {{ session('success') }}
            </div>
        @endif

        @if($wishlists->count() > 0)

            <div class="wishlist-layout">

                <!-- DAFTAR PRODUK -->
                <section class="wishlist-main">

                    <div class="wishlist-section-heading">
                        <h2>Koleksi Favorit</h2>
                        <span>{{ $wishlists->count() }} produk ditemukan</span>
                    </div>

                    <div class="wishlist-grid">

                        @foreach($wishlists as $wishlist)

                            @if($wishlist->product)
                                @php
                                    $product = $wishlist->product;
                                @endphp

                                <article class="wishlist-card">

                                    <div class="wishlist-image-wrap">

                                        <a href="{{ url('/produk/' . $product->id) }}">
                                            @if($product->image)
                                                <img
                                                    src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="wishlist-image"
                                                >
                                            @else
                                                <div class="wishlist-image-placeholder">
                                                    AMOLE SOFA
                                                </div>
                                            @endif
                                        </a>

                                        <div class="wishlist-heart">♥</div>

                                    </div>

                                    <div class="wishlist-info">

                                        <div class="wishlist-category">
                                            {{ $product->category->name ?? 'Furniture' }}
                                        </div>

                                        <h3 class="wishlist-name">
                                            {{ $product->name }}
                                        </h3>

                                        <div class="wishlist-price">
                                            Rp {{ number_format(
                                                $product->discount_price && $product->discount_price < $product->price
                                                    ? $product->discount_price
                                                    : $product->price,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </div>

                                        <div class="wishlist-actions">

                                            <a
                                                href="{{ url('/produk/' . $product->id) }}"
                                                class="wishlist-detail"
                                            >
                                                LIHAT DETAIL PRODUK
                                            </a>

                                            <form
                                                action="{{ route('wishlist.toggle', $product->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Hapus produk ini dari Wishlist?')"
                                            >
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="wishlist-remove"
                                                    title="Hapus dari Wishlist"
                                                >
                                                    ♥
                                                </button>
                                            </form>

                                        </div>

                                    </div>
                                </article>

                            @endif

                        @endforeach

                    </div>
                </section>

                <!-- PANEL SAMPING -->
                <aside class="wishlist-aside">

                    <div class="wishlist-aside-banner">
                        <span>✦</span>
                        <h3>Make Your Space More Beautiful</h3>
                    </div>

                    <div class="wishlist-aside-content">

                        <p>
                            Sofa favorit Anda sudah tersimpan di sini.
                            Jadikan pilihan ini inspirasi untuk menciptakan
                            ruangan yang nyaman dan berkelas.
                        </p>

                        <div class="wishlist-benefit">
                            <div class="wishlist-benefit-icon">♡</div>
                            <div>
                                <strong>Simpan Favorit</strong>
                                <small>Kumpulkan sofa yang paling Anda sukai.</small>
                            </div>
                        </div>

                        <div class="wishlist-benefit">
                            <div class="wishlist-benefit-icon">⌕</div>
                            <div>
                                <strong>Temukan Inspirasi</strong>
                                <small>Jelajahi berbagai desain untuk ruangan Anda.</small>
                            </div>
                        </div>

                        <div class="wishlist-benefit">
                            <div class="wishlist-benefit-icon">✧</div>
                            <div>
                                <strong>Pilih Sofa Impian</strong>
                                <small>Lihat detail produk sebelum melakukan pre-order.</small>
                            </div>
                        </div>

                        <a href="{{ route('home') }}#produk" class="wishlist-shop">
                            JELAJAHI KOLEKSI SOFA →
                        </a>

                    </div>
                </aside>

            </div>

        @else

            <div class="wishlist-empty">
                <div class="wishlist-empty-icon">♡</div>

                <h2>Wishlist Anda Masih Kosong</h2>

                <p>
                    Belum ada sofa favorit yang disimpan.
                    Yuk, temukan sofa impian Anda!
                </p>

                <a href="{{ route('home') }}#produk" class="wishlist-shop" style="display:inline-block; width:auto; padding:14px 25px;">
                    JELAJAHI PRODUK
                </a>
            </div>

        @endif

    </div>
</div>

@endsection
