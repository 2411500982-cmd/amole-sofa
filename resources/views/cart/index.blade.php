@extends('layouts.app')

@section('title', 'Keranjang Belanja - AMOLE SOFA')

@section('content')

@php
    $totalBelanja = 0;

    foreach ($cart->items as $item) {
        $harga = $item->product->discount_price ?? $item->product->price;
        $totalBelanja += $harga * $item->quantity;
    }
@endphp

<style>
    .cart-page {
        max-width: 1200px;
        margin: auto;
        padding: 25px 25px 65px;
        color: #302820;
        font-family: Arial, sans-serif;
    }

    /* BANNER */
    .cart-hero {
        min-height: 240px;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #e9dfd2;
        border-radius: 8px;
        margin-bottom: 25px;
        padding: 35px 45px;
    }

    .cart-hero-content {
        position: relative;
        z-index: 2;
        max-width: 430px;
    }

    .cart-hero h1 {
        font-family: Georgia, serif;
        font-size: 38px;
        line-height: 1.15;
        font-weight: normal;
        margin-bottom: 12px;
    }

    .cart-hero p {
        font-size: 14px;
        line-height: 1.6;
        color: #5e554c;
    }

    .cart-hero-image {
        position: absolute;
        right: 0;
        top: 0;
        width: 57%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        mask-image: linear-gradient(to right, transparent, black 25%);
    }

    /* LAYOUT */
    .cart-container {
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(320px, 1fr);
        gap: 25px;
        align-items: start;
    }

    .cart-card,
    .cart-summary {
        background: white;
        border: 1px solid #e8e2da;
        padding: 24px;
        border-radius: 5px;
    }

    .cart-section-title {
        font-family: Georgia, serif;
        font-size: 22px;
        font-weight: normal;
        margin-bottom: 20px;
    }

    /* ITEM */
    .cart-item {
        display: grid;
        grid-template-columns: 125px minmax(0, 1fr);
        gap: 18px;
        padding: 18px 0;
        border-bottom: 1px solid #eaeaea;
    }

    .cart-item:first-of-type {
        padding-top: 0;
    }

    .cart-image {
        width: 125px;
        height: 115px;
        object-fit: cover;
        border-radius: 4px;
        background: #f2eee8;
    }

    .cart-info h3 {
        font-size: 16px;
        margin: 3px 0 8px;
        font-weight: 600;
    }

    .cart-price {
        color: #94734e;
        font-size: 14px;
        font-weight: bold;
    }

    .cart-stock {
        font-size: 12px;
        color: #888;
        margin-top: 5px;
    }

    .cart-item-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 13px;
    }

    .quantity-form {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
    }

    .quantity-form button {
        width: 30px;
        height: 29px;
        border: none;
        background: #fff;
        cursor: pointer;
        font-size: 17px;
    }

    .quantity-form button:hover {
        background: #f2eee8;
    }

    .quantity-form input {
        width: 36px;
        height: 29px;
        text-align: center;
        border: none;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        outline: none;
        font-size: 13px;
    }

    .item-subtotal {
        font-size: 13px;
        color: #555;
    }

    .item-subtotal strong {
        color: #302820;
    }

    /* SUMMARY */
    .cart-summary h2,
    .shipping-title {
        font-family: Georgia, serif;
        font-size: 22px;
        font-weight: normal;
        margin-bottom: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
        font-size: 13px;
        color: #555;
    }

    .summary-row strong {
        color: #302820;
        text-align: right;
    }

    .summary-total {
        border-top: 1px solid #ddd;
        padding-top: 17px;
        margin-top: 18px;
        font-size: 16px;
        font-weight: bold;
        color: #302820;
    }

    .shipping-divider {
        border: none;
        border-top: 1px solid #e8e2da;
        margin: 24px 0;
    }

    /* FORM PENGIRIMAN */
    .shipping-form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .shipping-field label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .shipping-field input,
    .shipping-field textarea {
        width: 100%;
        padding: 11px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 13px;
        outline: none;
        font-family: Arial, sans-serif;
    }

    .shipping-field input:focus,
    .shipping-field textarea:focus {
        border-color: #98764d;
    }

    .shipping-field textarea {
        min-height: 75px;
        resize: vertical;
    }

    .shipping-two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    /* WHATSAPP */
    .whatsapp-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        width: 100%;
        padding: 14px;
        margin-top: 22px;
        background: #278b46;
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .whatsapp-checkout:hover {
        background: #1d7439;
        color: white;
    }

    .whatsapp-checkout svg {
        width: 20px;
        height: 20px;
        fill: currentColor;
    }

    .checkout-note {
        text-align: center;
        color: #888;
        font-size: 11px;
        line-height: 1.5;
        margin-top: 12px;
    }

    /* EMPTY CART */
    .empty-cart {
        background: white;
        text-align: center;
        padding: 65px 20px;
        border: 1px solid #e8e2da;
    }

    .empty-cart h2 {
        font-family: Georgia, serif;
        font-weight: normal;
        margin: 15px 0 10px;
    }

    .empty-cart p {
        color: #777;
        font-size: 14px;
        margin-bottom: 22px;
    }

    .shopping-button {
        display: inline-block;
        background: #98764d;
        color: white;
        text-decoration: none;
        padding: 12px 25px;
        border-radius: 5px;
    }

    .cart-alert {
        padding: 12px 15px;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 13px;
    }

    .cart-alert.success {
        background: #e8f5eb;
        color: #246b37;
    }

    .cart-alert.error {
        background: #fbeaea;
        color: #a32c2c;
    }

    @media (max-width: 768px) {
        .cart-page {
            padding: 20px 14px 45px;
        }

        .cart-hero {
            min-height: 190px;
            padding: 25px;
        }

        .cart-hero h1 {
            font-size: 28px;
        }

        .cart-hero p {
            max-width: 230px;
            font-size: 12px;
        }

        .cart-hero-image {
            width: 65%;
            opacity: .65;
        }

        .cart-container {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .cart-card,
        .cart-summary {
            padding: 18px;
        }

        .cart-item {
            grid-template-columns: 90px minmax(0, 1fr);
            gap: 12px;
        }

        .cart-image {
            width: 90px;
            height: 90px;
        }

        .cart-item-bottom {
            align-items: flex-start;
            flex-direction: column;
        }

        .shipping-two-columns {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="cart-page">

    {{-- BANNER --}}
    <div class="cart-hero">

        <div class="cart-hero-content">
            <h1>Keranjang Belanja<br>& Checkout</h1>
            <p>
                Review pesanan Anda dan lengkapi detail
                pengiriman untuk kenyamanan rumah Anda.
            </p>
        </div>

        @if ($cart->items->isNotEmpty() && $cart->items->first()->product->image)
            <img
                src="{{ asset('storage/' . $cart->items->first()->product->image) }}"
                class="cart-hero-image"
                alt="AMOLE SOFA"
            >
        @endif

    </div>

    @if (session('success'))
        <div class="cart-alert success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="cart-alert error">{{ session('error') }}</div>
    @endif

    @if ($cart->items->isEmpty())

        <div class="empty-cart">
            <div style="font-size:50px;">🛒</div>
            <h2>Keranjang Anda Masih Kosong</h2>
            <p>Silakan pilih produk furniture favorit Anda terlebih dahulu.</p>

            <a href="{{ route('home') }}#produk" class="shopping-button">
                Mulai Belanja
            </a>
        </div>

    @else

        <div class="cart-container">

            {{-- DAFTAR PRODUK --}}
            <div class="cart-card">

                <h2 class="cart-section-title">
                    Produk Pilihan Anda
                </h2>

                @foreach ($cart->items as $item)

                    @php
                        $harga = $item->product->discount_price
                            ?? $item->product->price;

                        $subtotal = $harga * $item->quantity;
                    @endphp

                    <div
                        class="cart-item"
                        data-name="{{ $item->product->name }}"
                        data-price="{{ $harga }}"
                    >

                        <img
                            src="{{ $item->product->image
                                ? asset('storage/' . $item->product->image)
                                : 'https://placehold.co/300x300?text=AMOLE+SOFA' }}"
                            alt="{{ $item->product->name }}"
                            class="cart-image"
                        >

                        <div class="cart-info">

                            <h3>{{ $item->product->name }}</h3>

                            <div class="cart-price">
                                Rp {{ number_format($harga, 0, ',', '.') }}
                            </div>

                            <div class="cart-stock">
                                Produk furniture AMOLE SOFA
                            </div>

                            <div class="cart-item-bottom">

                                <form
                                    action="{{ route('cart.update', $item->id) }}"
                                    method="POST"
                                    class="quantity-form"
                                >
                                    @csrf

                                    <button
                                        type="button"
                                        class="quantity-minus"
                                        aria-label="Kurangi jumlah"
                                    >−</button>

                                    <input
                                        type="number"
                                        name="quantity"
                                        class="quantity-input"
                                        value="{{ $item->quantity }}"
                                        min="1"
                                        max="{{ $item->product->stock }}"
                                        readonly
                                    >

                                    <button
                                        type="button"
                                        class="quantity-plus"
                                        aria-label="Tambah jumlah"
                                    >+</button>

                                </form>

                                <div class="item-subtotal">
                                    Subtotal:
                                    <strong>
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </strong>
                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            {{-- RINGKASAN DAN PENGIRIMAN --}}
            <div class="cart-summary">

                <h2>Ringkasan Pesanan</h2>

                <div class="summary-row">
                    <span>Total Produk</span>
                    <strong>{{ $cart->items->sum('quantity') }} pcs</strong>
                </div>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <strong>
                        Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                    </strong>
                </div>

                <div class="summary-row">
                    <span>Estimasi Pengiriman</span>
                    <strong>Dikonfirmasi</strong>
                </div>

                <div class="summary-row summary-total">
                    <span>Total Sementara</span>
                    <strong>
                        Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                    </strong>
                </div>

                <hr class="shipping-divider">

                <h2 class="shipping-title">Detail Pengiriman</h2>

                <div class="shipping-form">

                    <div class="shipping-field">
                        <label for="customerName">Nama Lengkap</label>
                        <input
                            type="text"
                            id="customerName"
                            placeholder="Masukkan nama lengkap"
                        >
                    </div>

                    <div class="shipping-field">
                        <label for="customerAddress">Alamat Lengkap</label>
                        <textarea
                            id="customerAddress"
                            placeholder="Nama jalan, nomor rumah, RT/RW, dan kelurahan"
                        ></textarea>
                    </div>

                    <div class="shipping-two-columns">

                        <div class="shipping-field">
                            <label for="customerCity">Kota/Kabupaten</label>
                            <input
                                type="text"
                                id="customerCity"
                                placeholder="Contoh: Jakarta Selatan"
                            >
                        </div>

                        <div class="shipping-field">
                            <label for="customerPostal">Kode Pos</label>
                            <input
                                type="text"
                                id="customerPostal"
                                placeholder="Kode pos"
                            >
                        </div>

                    </div>

                    <div class="shipping-field">
                        <label for="customerPhone">Nomor Telepon</label>
                        <input
                            type="tel"
                            id="customerPhone"
                            placeholder="08xxxxxxxxxx"
                        >
                    </div>

                </div>

                <a
                    href="#"
                    id="cartWhatsapp"
                    class="whatsapp-checkout"
                    target="_blank"
                    rel="noopener"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M20.52 3.48A11.78 11.78 0 0 0 12.13 0C5.55 0 .2 5.35.2 11.93c0 2.1.55 4.15 1.6 5.96L.1 24l6.26-1.64a11.9 11.9 0 0 0 5.76 1.47h.01c6.58 0 11.93-5.35 11.93-11.93a11.85 11.85 0 0 0-3.54-8.42ZM12.13 21.8a9.9 9.9 0 0 1-5.04-1.38l-.36-.21-3.72.98.99-3.63-.23-.37a9.85 9.85 0 0 1-1.51-5.26c0-5.47 4.45-9.92 9.93-9.92a9.86 9.86 0 0 1 7.03 2.91 9.86 9.86 0 0 1 2.9 7.03c0 5.47-4.45 9.92-9.99 9.92Zm5.45-7.43c-.3-.15-1.77-.87-2.05-.97-.28-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.25-.46-2.38-1.47-.88-.78-1.47-1.75-1.64-2.05-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.49s1.07 2.89 1.22 3.09c.15.2 2.1 3.21 5.08 4.5.71.3 1.27.49 1.7.62.72.23 1.37.2 1.88.12.57-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.07-.13-.27-.2-.57-.35Z"/>
                    </svg>

                    Selesaikan via WhatsApp
                </a>

                <p class="checkout-note">
                    Detail pesanan akan dikirimkan ke WhatsApp AMOLE SOFA
                    untuk konfirmasi lebih lanjut.
                </p>

            </div>

        </div>

    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Tombol jumlah produk
    document.querySelectorAll('.quantity-form').forEach(function (form) {

        const input = form.querySelector('.quantity-input');
        const minus = form.querySelector('.quantity-minus');
        const plus = form.querySelector('.quantity-plus');

        minus.addEventListener('click', function () {
            let value = parseInt(input.value) || 1;

            if (value > 1) {
                input.value = value - 1;
                form.submit();
            }
        });

        plus.addEventListener('click', function () {
            let value = parseInt(input.value) || 1;
            let maximum = parseInt(input.max) || 1;

            if (value < maximum) {
                input.value = value + 1;
                form.submit();
            } else {
                alert('Jumlah produk sudah mencapai stok yang tersedia.');
            }
        });

    });

    // Tombol WhatsApp
    const whatsappButton = document.getElementById('cartWhatsapp');

    if (whatsappButton) {

        whatsappButton.addEventListener('click', function (event) {

            const name = document.getElementById('customerName').value.trim();
            const address = document.getElementById('customerAddress').value.trim();
            const city = document.getElementById('customerCity').value.trim();
            const postal = document.getElementById('customerPostal').value.trim();
            const phone = document.getElementById('customerPhone').value.trim();

            if (!name || !address || !city || !phone) {
                event.preventDefault();
                alert('Mohon lengkapi nama, alamat, kota, dan nomor telepon terlebih dahulu.');
                return;
            }

            let message = 'Halo AMOLE SOFA, saya ingin melakukan pemesanan.%0A%0A';
            message += '*DETAIL PRODUK*%0A';

            document.querySelectorAll('.cart-item').forEach(function (item) {

                const productName = item.dataset.name;
                const price = Number(item.dataset.price);
                const quantity = Number(item.querySelector('.quantity-input').value);
                const subtotal = price * quantity;

                message += '%0A' + productName;
                message += '%0AHarga: Rp ' + price.toLocaleString('id-ID');
                message += '%0AJumlah: ' + quantity + ' pcs';
                message += '%0ASubtotal: Rp ' + subtotal.toLocaleString('id-ID');
                message += '%0A';
            });

            message += '%0A*DETAIL PENGIRIMAN*';
            message += '%0ANama: ' + encodeURIComponent(name);
            message += '%0AAlamat: ' + encodeURIComponent(address);
            message += '%0AKota: ' + encodeURIComponent(city);
            message += '%0AKode Pos: ' + encodeURIComponent(postal || '-');
            message += '%0ANomor Telepon: ' + encodeURIComponent(phone);

            message += '%0A%0ATotal Produk: Rp {{ number_format($totalBelanja, 0, ',', '.') }}';
            message += '%0A%0AMohon informasi lebih lanjut mengenai ongkos kirim dan proses pemesanan. Terima kasih.';

            whatsappButton.href = 'https://wa.me/6285719627787?text=' + message;

        });

    }

});
</script>

@endsection
