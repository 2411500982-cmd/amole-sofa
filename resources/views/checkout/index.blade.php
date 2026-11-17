@extends('layouts.app')

@section('title', 'Checkout - AMOLE SOFA')

@section('content')

<style>
    .checkout-page {
        max-width: 1100px;
        margin: 40px auto 70px;
        padding: 0 25px;
        font-family: Arial, sans-serif;
        color: #302820;
    }

    .checkout-heading {
        margin-bottom: 30px;
    }

    .checkout-heading h1 {
        font-size: 30px;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .checkout-heading p {
        color: #82776c;
        font-size: 14px;
    }

    .checkout-layout {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 25px;
        align-items: start;
    }

    .checkout-card {
        background: #fff;
        border: 1px solid #e8ded2;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
    }

    .checkout-card h2 {
        font-size: 19px;
        margin: 0 0 22px;
    }

    .checkout-product {
        display: flex;
        gap: 18px;
        align-items: center;
    }

    .checkout-product img {
        width: 125px;
        height: 110px;
        object-fit: contain;
        padding: 5px;
        box-sizing: border-box;
        border-radius: 9px;
        background: #f1e9df;
    }

    .checkout-product h3 {
        font-size: 17px;
        margin: 0 0 8px;
    }

    .checkout-product p {
        color: #82776c;
        font-size: 13px;
        margin: 5px 0;
    }

    .checkout-price {
        color: #806348 !important;
        font-weight: bold;
        font-size: 16px !important;
    }

    .checkout-field {
        margin-bottom: 18px;
    }

    .checkout-field label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .checkout-field input,
    .checkout-field textarea {
        width: 100%;
        padding: 13px 14px;
        border: 1px solid #ded4c9;
        border-radius: 7px;
        font-size: 14px;
        font-family: Arial, sans-serif;
        outline: none;
        box-sizing: border-box;
    }

    .checkout-field input:focus,
    .checkout-field textarea:focus {
        border-color: #806348;
    }

    .checkout-field textarea {
        min-height: 105px;
        resize: vertical;
    }

    .checkout-error {
        color: #c0392b;
        font-size: 12px;
        margin-top: 6px;
    }

    .checkout-summary-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .checkout-summary-row.total {
        border-top: 1px solid #e8ded2;
        padding-top: 17px;
        margin-top: 17px;
        font-size: 18px;
        font-weight: bold;
    }

    .checkout-summary-row.total span:last-child {
        color: #806348;
    }

    .checkout-preorder {
        background: #f5efe8;
        border-radius: 8px;
        padding: 15px;
        margin: 20px 0;
        font-size: 13px;
        line-height: 1.7;
    }

    .checkout-submit {
        width: 100%;
        border: none;
        background: #302820;
        color: white;
        padding: 16px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .checkout-submit:hover {
        background: #806348;
    }

    .checkout-back {
        display: inline-block;
        margin-top: 20px;
        color: #806348;
        text-decoration: none;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .checkout-layout {
            grid-template-columns: 1fr;
        }

        .checkout-page {
            margin-top: 25px;
            padding: 0 15px;
        }

        .checkout-product img {
            width: 100px;
            height: 100px;
        }
    }
</style>

<div class="checkout-page">

    <div class="checkout-heading">
        <h1>Checkout</h1>
        <p>Lengkapi informasi pemesanan sofa Anda.</p>
    </div>

    @if(session('error'))
        <div class="checkout-preorder" style="color: #c0392b;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('checkout.store', $product->id) }}" method="POST">
        @csrf

        <input type="hidden" name="quantity" value="{{ $quantity }}">

        <div class="checkout-layout">

            <div>
                <div class="checkout-card">
                    <h2>Produk yang Dipesan</h2>

                    <div class="checkout-product">

                        @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';"
                            >
                        @else
                            <img
                                src="{{ asset('images/no-image.png') }}"
                                alt="Gambar produk"
                            >
                        @endif

                        <div>
                            <h3>{{ $product->name }}</h3>

                            <p>Jumlah: {{ $quantity }} produk</p>

                            <p class="checkout-price">
                                Rp {{ number_format($finalPrice, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="checkout-card">
                    <h2>Informasi Penerima</h2>

                    <div class="checkout-field">
                        <label for="recipient_name">Nama Penerima</label>
                        <input
                            type="text"
                            id="recipient_name"
                            name="recipient_name"
                            value="{{ old('recipient_name', auth()->user()->name) }}"
                            placeholder="Masukkan nama penerima"
                            required
                        >
                        @error('recipient_name')
                            <div class="checkout-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="checkout-field">
                        <label for="phone">Nomor WhatsApp</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Contoh: 081234567890"
                            required
                        >
                        @error('phone')
                            <div class="checkout-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="checkout-field">
                        <label for="shipping_address">Alamat Pengiriman</label>
                        <textarea
                            id="shipping_address"
                            name="shipping_address"
                            placeholder="Masukkan alamat lengkap, nama jalan, nomor rumah, kecamatan, kota, dan kode pos"
                            required
                        >{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <div class="checkout-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="checkout-field">
                        <label for="notes">Catatan Tambahan (Opsional)</label>
                        <textarea
                            id="notes"
                            name="notes"
                            placeholder="Contoh: Mohon hubungi saya sebelum pengiriman."
                        >{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="checkout-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <div class="checkout-card">
                    <h2>Ringkasan Pesanan</h2>

                    <div class="checkout-summary-row">
                        <span>Harga produk</span>
                        <span>Rp {{ number_format($finalPrice, 0, ',', '.') }}</span>
                    </div>

                    <div class="checkout-summary-row">
                        <span>Jumlah</span>
                        <span>{{ $quantity }} produk</span>
                    </div>

                    <div class="checkout-summary-row">
                        <span>Subtotal</span>
                        <span>
                            Rp {{ number_format($finalPrice * $quantity, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="checkout-summary-row">
                        <span>Ongkos kirim</span>
                        <span>Dikonfirmasi admin</span>
                    </div>

                    <div class="checkout-summary-row total">
                        <span>Total produk</span>
                        <span>
                            Rp {{ number_format($finalPrice * $quantity, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="checkout-preorder">
                        <strong>Informasi Pre-Order</strong><br>
                        Produk ini menggunakan sistem pre-order dengan estimasi
                        pengerjaan sekitar <strong>2–3 minggu</strong>.
                        Ongkos kirim akan dikonfirmasi oleh admin melalui WhatsApp.
                    </div>

                    <button type="submit" class="checkout-submit">
                        PESAN SEKARANG
                    </button>

                    <a href="{{ route('produk.detail', $product->id) }}" class="checkout-back">
                        ← Kembali ke detail produk
                    </a>
                </div>
            </div>

        </div>
    </form>

</div>

@endsection
