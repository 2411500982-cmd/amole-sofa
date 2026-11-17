<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Galeri | AMOLE SOFA</title>

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
            transition: .25s;
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

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 23px;
            flex-wrap: wrap;
        }

        .content-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 23px;
            color: var(--brown-dark);
            margin-bottom: 7px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 13px;
        }

        .btn-add {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            background: var(--brown);
            color: white;
            transition: .2s;
        }

        .btn-add:hover {
            background: var(--brown-light);
        }

        .success-message {
            background: #e8f2e8;
            color: #38683e;
            padding: 14px 17px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .error-message {
            background: #fce5e3;
            color: #b83d37;
            padding: 14px 17px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .table-wrapper {
            overflow-x: auto;
            background: white;
            border: 1px solid var(--border);
            border-radius: 13px;
            box-shadow: 0 5px 20px rgba(65,45,29,.04);
        }

        .gallery-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        .gallery-table th,
        .gallery-table td {
            padding: 17px 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }

        .gallery-table th {
            background: #f5eee5;
            color: var(--brown);
            font-weight: 700;
            white-space: nowrap;
        }

        .gallery-table tbody tr:hover {
            background: #fcfaf7;
        }

        .gallery-table tbody tr:last-child td {
            border-bottom: none;
        }

        .gallery-image {
            width: 105px;
            height: 75px;
            object-fit: cover;
            border-radius: 8px;
            background: #f1e9df;
        }

        .no-image {
            width: 105px;
            height: 75px;
            background: #f1e9df;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: var(--muted);
            font-size: 11px;
        }

        .status-label {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-active {
            background: #e2f5e9;
            color: #21834a;
        }

        .status-inactive {
            background: #fff0d9;
            color: #a66a12;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .btn-edit,
        .btn-delete {
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-family: inherit;
            font-weight: 600;
            transition: .2s;
        }

        .btn-edit {
            background: #eee3d5;
            color: #594735;
        }

        .btn-edit:hover {
            background: #dfcfba;
        }

        .btn-delete {
            background: #fce5e3;
            color: #b83d37;
        }

        .btn-delete:hover {
            background: #f7d0cc;
        }

        .empty-data {
            text-align: center;
            padding: 40px !important;
            color: var(--muted);
        }

        .pagination {
            padding: 20px;
        }

        .pagination nav {
            display: flex;
            justify-content: center;
        }

        .footer {
            margin-top: 35px;
            text-align: center;
            color: #a39484;
            font-size: 11px;
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

            .content-header {
                align-items: flex-start;
                flex-direction: column;
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
                <h1>Kelola Galeri</h1>
                <p>Kelola dokumentasi hasil pekerjaan dan portofolio AMOLE SOFA.</p>
            </div>

            <div class="admin-profile">
                {{ auth()->user()->name }}
            </div>

        </header>

        <div class="content-header">

            <div>
                <h2>Galeri Portofolio</h2>
                <p class="subtitle">
                    Foto hasil pengerjaan sofa yang akan ditampilkan pada website.
                </p>
            </div>

            <a href="{{ route('admin.galleries.create') }}" class="btn-add">
                + Tambah Foto Galeri
            </a>

        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="table-wrapper">

            <table class="gallery-table">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($galleries as $gallery)

                        <tr>

                            <td>
                                {{ $galleries->firstItem() + $loop->index }}
                            </td>

                            <td>
                                @if($gallery->image)
                                    <img
                                        src="{{ asset('storage/' . $gallery->image) }}"
                                        alt="{{ $gallery->title }}"
                                        class="gallery-image"
                                    >
                                @else
                                    <div class="no-image">
                                        Belum ada foto
                                    </div>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $gallery->title }}</strong>
                            </td>

                            <td>
                                {{ $gallery->description ?: '-' }}
                            </td>

                            <td>
                                {{ $gallery->sort_order }}
                            </td>

                            <td>
                                @if($gallery->is_active)
                                    <span class="status-label status-active">
                                        Aktif
                                    </span>
                                @else
                                    <span class="status-label status-inactive">
                                        Disembunyikan
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="action-buttons">

                                    <a
                                        href="{{ route('admin.galleries.edit', $gallery->id) }}"
                                        class="btn-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.galleries.destroy', $gallery->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus foto galeri ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="empty-data">
                                Belum ada foto portofolio.
                                Silakan klik tombol Tambah Foto Galeri untuk menambahkan foto.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="pagination">
                {{ $galleries->links() }}
            </div>

        </div>

        <div class="footer">
            © {{ date('Y') }} AMOLE SOFA. All Rights Reserved.
        </div>

    </main>

</div>

</body>
</html>
