<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Banner Promo | AMOLE SOFA</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f7f3ed;
            color: #30251e;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #382d25;
            padding: 30px 20px;
            color: white;
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .brand-subtitle {
            font-size: 11px;
            color: #c6b6a5;
            margin-bottom: 40px;
        }

        .menu-title {
            font-size: 10px;
            color: #b8a794;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        .menu a {
            display: block;
            padding: 13px 15px;
            color: #e7ded4;
            text-decoration: none;
            border-radius: 9px;
            margin-bottom: 7px;
            font-size: 13px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #80664e;
            color: white;
        }

        .main {
            margin-left: 250px;
            padding: 35px;
        }

        .topbar {
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
        }

        .topbar p {
            color: #938477;
            font-size: 13px;
            margin-top: 5px;
        }

        .form-card {
            max-width: 850px;
            background: white;
            border-radius: 13px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(55, 40, 25, .05);
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .required {
            color: #c45c50;
        }

        input,
        textarea {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #e5dbcf;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            color: #30251e;
            outline: none;
            background: #fffdfa;
        }

        input:focus,
        textarea:focus {
            border-color: #80664e;
            box-shadow: 0 0 0 3px rgba(128, 102, 78, .1);
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        .hint {
            color: #938477;
            font-size: 11px;
            margin-top: 7px;
        }

        .error {
            color: #c0392b;
            font-size: 11px;
            margin-top: 6px;
        }

        .image-preview {
            display: none;
            width: 100%;
            max-width: 650px;
            aspect-ratio: 16 / 6;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 15px;
            border: 1px solid #e5dbcf;
            background: #f7f3ed;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .checkbox-row input {
            width: 17px;
            height: 17px;
            accent-color: #80664e;
        }

        .checkbox-row label {
            margin: 0;
            font-size: 13px;
            font-weight: 500;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            padding-top: 20px;
            border-top: 1px solid #eee5da;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            text-decoration: none;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-primary {
            background: #80664e;
            color: white;
        }

        .btn-primary:hover {
            background: #604b39;
        }

        .btn-secondary {
            background: #eee5da;
            color: #604b39;
        }

        @media(max-width: 800px) {
            .sidebar {
                width: 75px;
                padding: 20px 8px;
            }

            .brand {
                font-size: 11px;
                text-align: center;
            }

            .brand-subtitle,
            .menu-title {
                display: none;
            }

            .menu a {
                font-size: 0;
                text-align: center;
                padding: 13px 5px;
            }

            .menu a::first-letter {
                font-size: 17px;
            }

            .main {
                margin-left: 75px;
                padding: 20px 12px;
            }

            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">AMOLE SOFA</div>
    <div class="brand-subtitle">ADMINISTRATION PANEL</div>

    <div class="menu-title">MENU UTAMA</div>

    <nav class="menu">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.products.index') }}">Kelola Produk</a>
        <a href="{{ route('admin.orders.index') }}">Kelola Pesanan</a>
        <a href="{{ route('admin.service-requests.index') }}">Kelola Layanan</a>
        <a href="{{ route('admin.galleries.index') }}">Kelola Galeri</a>
        <a href="{{ route('admin.banners.index') }}" class="active">Kelola Banner Promo</a>
        <a href="{{ route('home') }}" target="_blank">Lihat Website</a>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</aside>

<main class="main">

    <div class="topbar">
        <h1>Tambah Banner Promo</h1>
        <p>Tambahkan gambar promosi baru untuk halaman utama AMOLE SOFA.</p>
    </div>

    <div class="form-card">

        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Judul Promo <span class="required">*</span></label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Contoh: Diskon Sofa Hingga 30%"
                    required
                >
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Deskripsi Promo</label>
                <textarea
                    name="subtitle"
                    placeholder="Contoh: Wujudkan ruang keluarga impian dengan koleksi sofa pilihan."
                >{{ old('subtitle') }}</textarea>
                @error('subtitle')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Gambar Banner <span class="required">*</span></label>
                <input
                    type="file"
                    name="image"
                    id="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    required
                >
                <p class="hint">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 5 MB.
                    Disarankan menggunakan gambar horizontal dengan rasio 16:6.
                </p>

                <img id="preview" class="image-preview" alt="Preview banner">

                @error('image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Teks Tombol Promo</label>
                <input
                    type="text"
                    name="button_text"
                    value="{{ old('button_text') }}"
                    placeholder="Contoh: Lihat Koleksi"
                >
                @error('button_text')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Link Tombol Promo</label>
                <input
                    type="text"
                    name="button_link"
                    value="{{ old('button_link') }}"
                    placeholder="Contoh: /produk/1 atau #produk"
                >
                <p class="hint">
                    Isi dengan alamat halaman tujuan tombol. Boleh dikosongkan.
                </p>
                @error('button_link')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Urutan Banner</label>
                <input
                    type="number"
                    name="sort_order"
                    value="{{ old('sort_order', 0) }}"
                    min="0"
                >
                <p class="hint">
                    Angka lebih kecil akan ditampilkan lebih dahulu.
                </p>
                @error('sort_order')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="checkbox-row">
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    id="is_active"
                    {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                >
                <label for="is_active">Tampilkan banner di website</label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Simpan Banner
                </button>

                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</main>

<script>
    const imageInput = document.getElementById('image');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.removeAttribute('src');
            preview.style.display = 'none';
        }
    });
</script>

</body>
</html>
