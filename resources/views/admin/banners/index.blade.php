<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Banner Promo | AMOLE SOFA</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
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

        .btn {
            display: inline-block;
            padding: 12px 19px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-primary {
            background: #80664e;
            color: white;
        }

        .btn-primary:hover {
            background: #604b39;
        }

        .alert {
            padding: 14px 17px;
            background: #e5f2e7;
            color: #286338;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .table-card {
            background: white;
            border-radius: 13px;
            padding: 22px;
            box-shadow: 0 5px 20px rgba(55, 40, 25, .05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th {
            text-align: left;
            font-size: 11px;
            color: #938477;
            padding: 15px 12px;
            border-bottom: 1px solid #eee5da;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td {
            padding: 16px 12px;
            border-bottom: 1px solid #f1ece6;
            font-size: 12px;
            vertical-align: middle;
        }

        .banner-image {
            width: 150px;
            height: 75px;
            object-fit: cover;
            border-radius: 7px;
            background: #eee5da;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
        }

        .active-status {
            background: #e4f2e6;
            color: #367346;
        }

        .inactive-status {
            background: #f4e8e5;
            color: #a34f42;
        }

        .action {
            display: flex;
            gap: 7px;
        }

        .btn-edit {
            background: #eee5da;
            color: #604b39;
        }

        .btn-delete {
            background: #f9e7e5;
            color: #b94b43;
        }

        .empty {
            text-align: center;
            color: #938477;
            padding: 45px 15px;
        }

        .pagination {
            margin-top: 20px;
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

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .topbar h1 {
                font-size: 24px;
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
        <div>
            <h1>Kelola Banner Promo</h1>
            <p>Atur foto dan urutan banner promosi AMOLE SOFA.</p>
        </div>

        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
            + Tambah Banner
        </a>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-card">

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto Banner</th>
                    <th>Judul Promo</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($banners as $index => $banner)
                    <tr>
                        <td>{{ $banners->firstItem() + $index }}</td>

                        <td>
                            <img
                                src="{{ asset('storage/' . $banner->image) }}"
                                alt="{{ $banner->title }}"
                                class="banner-image"
                            >
                        </td>

                        <td>
                            <strong>{{ $banner->title }}</strong>

                            @if($banner->subtitle)
                                <p style="color:#938477; margin-top:5px;">
                                    {{ $banner->subtitle }}
                                </p>
                            @endif
                        </td>

                        <td>{{ $banner->sort_order }}</td>

                        <td>
                            @if($banner->is_active)
                                <span class="status active-status">Aktif</span>
                            @else
                                <span class="status inactive-status">Nonaktif</span>
                            @endif
                        </td>

                        <td>
                            <div class="action">
                                <a
                                    href="{{ route('admin.banners.edit', $banner->id) }}"
                                    class="btn btn-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.banners.destroy', $banner->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus banner ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada banner promo.
                            Silakan tambahkan banner pertama.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $banners->links() }}
        </div>

    </div>

</main>

</body>
</html>
