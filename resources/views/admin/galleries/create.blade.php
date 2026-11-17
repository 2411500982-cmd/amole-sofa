<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Foto Galeri | AMOLE SOFA</title>

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
            margin-bottom: 55px;
        }

        .menu-title {
            color: #a99680;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 16px;
        }

        .menu a {
            display: block;
            color: #e9dfd3;
            text-decoration: none;
            padding: 14px 15px;
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

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,.12);
        }

        .sidebar-bottom button {
            width: 100%;
            padding: 13px;
            border: 1px solid #9b8063;
            background: transparent;
            color: #f5eadd;
            border-radius: 9px;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
        }

        .sidebar-bottom button:hover {
            background: #71583f;
        }

        .main-content {
            flex: 1;
            padding: 38px 40px;
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

        .form-card {
            max-width: 850px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(65,45,29,.04);
        }

        .form-heading {
            margin-bottom: 25px;
        }

        .form-heading h2 {
            font-family: 'Playfair Display', serif;
            font-size: 23px;
            color: var(--brown-dark);
            margin-bottom: 7px;
        }

        .form-heading p {
            color: var(--muted);
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 21px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--brown);
            margin-bottom: 9px;
        }

        .form-control {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #e5d9cb;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            color: var(--text);
            background: #fffdfa;
            outline: none;
            transition: .2s;
        }

        .form-control:focus {
            border-color: var(--brown-light);
            box-shadow: 0 0 0 3px rgba(128,102,78,.10);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 115px;
        }

        input[type="file"].form-control {
            background: #fffdfa;
        }

        .help-text {
            color: var(--muted);
            font-size: 11px;
            margin-top: 8px;
        }

        .error-text {
            color: #b83d37;
            font-size: 12px;
            margin-top: 7px;
        }

        .preview-wrapper {
            margin-top: 13px;
            display: none;
        }

        .preview-wrapper img {
            width: 220px;
            height: 155px;
            object-fit: cover;
            border-radius: 9px;
            border: 1px solid var(--border);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }

        .checkbox-group input {
            width: 16px;
            height: 16px;
            accent-color: var(--brown);
        }

        .checkbox-group label {
            margin: 0;
            font-weight: 500;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .btn-save,
        .btn-back {
            display: inline-block;
            padding: 12px 22px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: .2s;
        }

        .btn-save {
            background: var(--brown);
            color: white;
        }

        .btn-save:hover {
            background: var(--brown-light);
        }

        .btn-back {
            background: #eee3d5;
            color: #594735;
        }

        .btn-back:hover {
            background: #dfcfba;
        }

        .footer {
            margin-top: 35px;
            text-align: center;
            color: #a39484;
            font-size: 11px;
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

            .form-card {
                padding: 22px 17px;
            }
        }
    </style>
</head>

<body>

<div class="admin-wrapper">

    <aside class="sidebar">

        <div class="brand">AMOLE SOFA</div>
        <div class="brand-subtitle">ADMIN MANAGEMENT PANEL</div>

        <div class="menu-title">MENU UTAMA</div>

        <nav class="menu">

            <a href="{{ route('admin.dashboard') }}">
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

            <a href="{{ route('admin.galleries.index') }}" class="active">
                Kelola Galeri
            </a>

            <a href="{{ route('home') }}">
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

    <main class="main-content">

        <header class="topbar">

            <div>
                <h1>Tambah Foto Galeri</h1>
                <p>Tambahkan dokumentasi hasil pengerjaan sofa AMOLE SOFA.</p>
            </div>

            <div class="admin-profile">
                {{ auth()->user()->name }}
            </div>

        </header>

        <div class="form-card">

            <div class="form-heading">
                <h2>Informasi Foto Portofolio</h2>
                <p>Isi informasi foto yang ingin ditampilkan pada galeri website.</p>
            </div>

            @if($errors->any())
                <div style="background:#fce5e3;color:#b83d37;padding:14px;border-radius:8px;margin-bottom:20px;font-size:13px;">
                    <strong>Periksa kembali data berikut:</strong>
                    <ul style="padding-left:20px;margin-top:7px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('admin.galleries.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <div class="form-group">
                    <label for="title">Judul Foto *</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        value="{{ old('title') }}"
                        placeholder="Contoh: Sofa Custom Ruang Keluarga"
                        required
                    >
                    @error('title')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Foto</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        placeholder="Tuliskan deskripsi singkat hasil pengerjaan sofa..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Pilih Foto *</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="form-control"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        required
                    >
                    <p class="help-text">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal ukuran file 5 MB.
                    </p>

                    <div class="preview-wrapper" id="previewWrapper">
                        <img src="" id="imagePreview" alt="Preview foto">
                    </div>

                    @error('image')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order">Urutan Tampilan</label>
                    <input
                        type="number"
                        id="sort_order"
                        name="sort_order"
                        class="form-control"
                        value="{{ old('sort_order', 0) }}"
                        min="0"
                    >
                    <p class="help-text">
                        Angka lebih kecil akan ditampilkan lebih dahulu.
                    </p>
                    @error('sort_order')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">

                    <div class="checkbox-group">
                        <input
                            type="checkbox"
                            id="is_active"
                            name="is_active"
                            value="1"
                            {{ old('is_active', '1') ? 'checked' : '' }}
                        >

                        <label for="is_active">
                            Tampilkan foto pada website
                        </label>
                    </div>

                </div>

                <div class="form-actions">

                    <button type="submit" class="btn-save">
                        Simpan Foto Galeri
                    </button>

                    <a
                        href="{{ route('admin.galleries.index') }}"
                        class="btn-back"
                    >
                        Kembali
                    </a>

                </div>

            </form>

        </div>

        <div class="footer">
            © {{ date('Y') }} AMOLE SOFA. All Rights Reserved.
        </div>

    </main>

</div>

<script>
    const imageInput = document.getElementById('image');
    const previewWrapper = document.getElementById('previewWrapper');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            previewWrapper.style.display = 'block';
        } else {
            imagePreview.src = '';
            previewWrapper.style.display = 'none';
        }
    });
</script>

</body>
</html>
