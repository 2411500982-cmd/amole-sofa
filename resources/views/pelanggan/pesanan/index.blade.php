@extends('layouts.app')

@section('title', 'Pesanan Saya - AMOLE SOFA')

@section('content')

<style>
    .orders-page {
        background: #f8f5f0;
        min-height: 100vh;
        padding: 55px 20px 90px;
        font-family: Arial, sans-serif;
        color: #302820;
    }

    .orders-container {
        max-width: 1120px;
        margin: auto;
    }

    .orders-heading {
        margin-bottom: 30px;
    }

    .orders-eyebrow {
        color: #a7835c;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .orders-heading h1 {
        font-family: Georgia, serif;
        font-size: 36px;
        font-weight: 500;
        margin: 0 0 10px;
        color: #302820;
    }

    .orders-heading p {
        color: #82776b;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
    }

    /* SUMMARY */
    .orders-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 24px 28px;
        background: #302820;
        border-radius: 15px;
        color: white;
        margin-bottom: 32px;
        box-shadow: 0 8px 25px rgba(48, 40, 32, .08);
    }

    .summary-label {
        color: #d5c5ae;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .summary-number {
        font-family: Georgia, serif;
        font-size: 30px;
        color: #fff;
    }

    .summary-icon {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(215, 184, 124, .15);
        border: 1px solid rgba(215, 184, 124, .35);
        border-radius: 50%;
        color: #d7b87c;
        font-size: 25px;
    }

    /* SECTION */
    .orders-section-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        gap: 15px;
    }

    .orders-section-title h2 {
        font-family: Georgia, serif;
        font-size: 23px;
        font-weight: 500;
        margin: 0;
    }

    .orders-section-title span {
        font-size: 12px;
        color: #948779;
    }

    /* ORDER CARD */
    .order-card {
        background: #fff;
        border: 1px solid #eee6dc;
        border-radius: 14px;
        margin-bottom: 20px;
        overflow: hidden;
        transition: .25s ease;
    }

    .order-card:hover {
        box-shadow: 0 10px 28px rgba(48, 40, 32, .07);
        transform: translateY(-2px);
    }

    .order-card-header {
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        border-bottom: 1px solid #f1ece5;
        flex-wrap: wrap;
    }

    .order-number-label {
        color: #a09283;
        font-size: 11px;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .order-number {
        color: #302820;
        font-weight: 700;
        font-size: 14px;
    }

    .order-date {
        color: #92877c;
        font-size: 12px;
        margin-top: 5px;
    }

    /* STATUS */
    .order-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .order-status::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-pending {
        background: #fff4dc;
        color: #ad7925;
    }

    .status-processing {
        background: #eaf1ff;
        color: #4269a9;
    }

    .status-shipped {
        background: #e8f5f0;
        color: #37866a;
    }

    .status-completed {
        background: #e9f4e6;
        color: #53834c;
    }

    .status-cancelled {
        background: #fcebea;
        color: #bd5a55;
    }

    /* ORDER BODY */
    .order-card-body {
        padding: 23px 24px;
    }

    .order-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
        margin-bottom: 22px;
    }

    .order-info-label {
        font-size: 11px;
        color: #a09283;
        text-transform: uppercase;
        letter-spacing: .7px;
        margin-bottom: 7px;
    }

    .order-info-value {
        font-size: 13px;
        color: #40362e;
        font-weight: 600;
        line-height: 1.6;
    }

    /* PRODUCT */
    .order-products {
        background: #faf8f5;
        border: 1px solid #f0ebe4;
        border-radius: 10px;
        padding: 17px;
        margin-bottom: 20px;
    }

    .order-products-title {
        font-size: 12px;
        font-weight: 700;
        color: #766757;
        margin-bottom: 13px;
    }

    .order-product-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 13px 0;
        border-bottom: 1px solid #eee8df;
        font-size: 13px;
    }

    .order-product-row:first-of-type {
        padding-top: 5px;
    }

    .order-product-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .order-product-detail {
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 0;
    }

    .order-product-image {
        width: 100px;
        height: 85px;
        flex-shrink: 0;
        border-radius: 9px;
        overflow: hidden;
        background: #eee7de;
        border: 1px solid #e9e0d5;
    }

    .order-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .product-name {
        color: #40362e;
        font-weight: 600;
        font-size: 14px;
        line-height: 1.5;
    }

    .product-quantity {
        color: #998b7c;
        font-size: 12px;
        margin-top: 5px;
    }

    .product-price {
        color: #6e5945;
        font-weight: 600;
        white-space: nowrap;
        font-size: 13px;
    }

    /* TOTAL */
    .order-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding-top: 18px;
        border-top: 1px solid #eee8df;
        flex-wrap: wrap;
    }

    .order-total-label {
        font-size: 12px;
        color: #95887b;
        margin-bottom: 5px;
    }

    .order-total {
        color: #a7835c;
        font-size: 21px;
        font-weight: 700;
    }

    .order-payment {
        font-size: 11px;
        color: #938678;
        margin-top: 5px;
    }

    /* EMPTY STATE */
    .empty-orders {
        background: #fff;
        border: 1px solid #eee6dc;
        border-radius: 16px;
        padding: 65px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 78px;
        height: 78px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f5eee5;
        border-radius: 50%;
        color: #a7835c;
        font-size: 34px;
    }

    .empty-orders h3 {
        font-family: Georgia, serif;
        font-size: 23px;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .empty-orders p {
        color: #938678;
        font-size: 13px;
        line-height: 1.7;
        margin-bottom: 24px;
    }

    .shop-button {
        display: inline-block;
        background: #302820;
        color: #fff !important;
        padding: 12px 25px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .5px;
        transition: .2s;
    }

    .shop-button:hover {
        background: #a7835c;
    }

    /* PAGINATION */
    .orders-pagination {
        margin-top: 25px;
    }

    .orders-pagination nav {
        display: flex;
        justify-content: center;
    }

    .orders-pagination svg {
        width: 18px;
    }

    /* RESPONSIVE */
    @media (max-width: 650px) {
        .orders-page {
            padding: 35px 14px 65px;
        }

        .orders-heading h1 {
            font-size: 29px;
        }

        .orders-summary {
            padding: 20px;
        }

        .order-card-header,
        .order-card-body {
            padding: 17px;
        }

        .order-info-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .order-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .order-status {
            font-size: 10px;
        }

        .order-product-row {
            align-items: flex-start;
            flex-direction: column;
        }

        .order-product-detail {
            width: 100%;
        }

        .order-product-image {
            width: 85px;
            height: 75px;
        }

        .product-price {
            margin-left: 100px;
        }
    }
</style>

<div class="orders-page">
    <div class="orders-container">

        {{-- HEADER --}}
        <div class="orders-heading">
            <div class="orders-eyebrow">AMOLE SOFA CUSTOMER AREA</div>
            <h1>Pesanan Saya</h1>
            <p>Pantau pesanan sofa Anda dan lihat informasi pemesanan dalam satu halaman.</p>
        </div>

        {{-- SUMMARY --}}
        <div class="orders-summary">
            <div>
                <div class="summary-label">Riwayat Pesanan Anda</div>
                <div class="summary-number">
                    {{ $orders->total() }}
                    <span style="font-size: 14px; color: #d5c5ae;">Pesanan</span>
                </div>
            </div>

            <div class="summary-icon">▤</div>
        </div>

        {{-- ORDER LIST --}}
        <div class="orders-section-title">
            <h2>Daftar Pesanan</h2>
            <span>Riwayat transaksi Anda</span>
        </div>

        @forelse ($orders as $order)

            @php
                $statusLabels = [
                    'pending' => 'Menunggu Konfirmasi',
                    'processing' => 'Sedang Diproses',
                    'shipped' => 'Sedang Dikirim',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                ];

                $statusClass = [
                    'pending' => 'status-pending',
                    'processing' => 'status-processing',
                    'shipped' => 'status-shipped',
                    'completed' => 'status-completed',
                    'cancelled' => 'status-cancelled',
                ];
            @endphp

            <div class="order-card">

                {{-- CARD HEADER --}}
                <div class="order-card-header">
                    <div>
                        <div class="order-number-label">Nomor Pesanan</div>
                        <div class="order-number">{{ $order->order_number }}</div>
                        <div class="order-date">
                            {{ $order->created_at->format('d F Y, H:i') }}
                        </div>
                    </div>

                    <span class="order-status {{ $statusClass[$order->status] ?? 'status-pending' }}">
                        {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                    </span>
                </div>

                {{-- CARD BODY --}}
                <div class="order-card-body">

                    <div class="order-info-grid">
                        <div>
                            <div class="order-info-label">Nama Penerima</div>
                            <div class="order-info-value">
                                {{ $order->recipient_name }}
                            </div>
                        </div>

                        <div>
                            <div class="order-info-label">Nomor Telepon</div>
                            <div class="order-info-value">
                                {{ $order->phone }}
                            </div>
                        </div>

                        <div>
                            <div class="order-info-label">Alamat Pengiriman</div>
                            <div class="order-info-value">
                                {{ $order->shipping_address }}
                            </div>
                        </div>

                        <div>
                            <div class="order-info-label">Metode Pembayaran</div>
                            <div class="order-info-value">
                                {{ $order->payment_method }}
                            </div>
                        </div>
                    </div>

                    {{-- PRODUCTS --}}
                    <div class="order-products">
                        <div class="order-products-title">
                            PRODUK YANG DIPESAN
                        </div>

                        @foreach ($order->items as $item)
                            <div class="order-product-row">

                                <div class="order-product-detail">

                                    {{-- GAMBAR PRODUK --}}
                                    <div class="order-product-image">
                                        @if ($item->product && $item->product->image)
                                            <img
                                                src="{{ asset('storage/' . $item->product->image) }}"
                                                alt="{{ $item->product_name }}"
                                                onerror="this.onerror=null; this.src='https://placehold.co/300x250/f0e9df/8b7965?text=AMOLE+SOFA';"
                                            >
                                        @else
                                            <img
                                                src="https://placehold.co/300x250/f0e9df/8b7965?text=AMOLE+SOFA"
                                                alt="Gambar sofa"
                                            >
                                        @endif
                                    </div>

                                    <div>
                                        <div class="product-name">
                                            {{ $item->product_name }}
                                        </div>

                                        <div class="product-quantity">
                                            Jumlah: {{ $item->quantity }} produk
                                        </div>
                                    </div>

                                </div>

                                <div class="product-price">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </div>

                            </div>
                        @endforeach
                    </div>

                    {{-- TOTAL --}}
                    <div class="order-footer">
                        <div>
                            <div class="order-total-label">Total Pembayaran</div>
                            <div class="order-total">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </div>
                            <div class="order-payment">
                                Termasuk ongkos kirim Rp
                                {{ number_format($order->shipping_cost, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        @empty

            <div class="empty-orders">
                <div class="empty-icon">▤</div>
                <h3>Belum Ada Pesanan</h3>
                <p>
                    Anda belum memiliki riwayat pesanan.<br>
                    Temukan sofa pilihan Anda dan lakukan pre-order sekarang.
                </p>
                <a href="{{ route('home') }}" class="shop-button">
                    LIHAT KOLEKSI SOFA
                </a>
            </div>

        @endforelse

        {{-- PAGINATION --}}
        @if ($orders->hasPages())
            <div class="orders-pagination">
                {{ $orders->links() }}
            </div>
        @endif

    </div>
</div>

@endsection
