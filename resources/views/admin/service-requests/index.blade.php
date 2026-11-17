<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Layanan - AMOLE SOFA</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f7f3ed;
            color: #382d24;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #30251e;
            padding: 32px 22px;
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            color: #e6cba8;
            margin-bottom: 45px;
        }

        .brand span {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-size: 10px;
            letter-spacing: 4px;
            color: #c9b49d;
            margin-top: 5px;
        }

        .menu-title {
            color: #a99a8b;
            font-size: 10px;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: #d6c9bb;
            padding: 13px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
            font-size: 13px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #514033;
            color: #f0d4ae;
        }

        .logout {
            position: absolute;
            bottom: 30px;
            left: 22px;
            right: 22px;
        }

        .logout button {
            width: 100%;
            padding: 12px;
            border: 1px solid #6d5948;
            border-radius: 8px;
            background: transparent;
            color: #e0c7aa;
            cursor: pointer;
            font-family: inherit;
        }

        .main {
            margin-left: 250px;
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            font-weight: 600;
        }

        .header p {
            color: #8c7c6d;
            font-size: 13px;
            margin-top: 7px;
        }

        .date {
            color: #806e5d;
            font-size: 13px;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .summary-card {
            background: #fff;
            border: 1px solid #eee5da;
            border-radius: 12px;
            padding: 23px;
        }

        .summary-card p {
            color: #938273;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .summary-card h2 {
            font-size: 27px;
            color: #49372a;
        }

        .content-card {
            background: #fff;
            border: 1px solid #eee5da;
            border-radius: 12px;
            padding: 25px;
        }

        .content-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .content-heading h2 {
            font-family: 'Playfair Display', serif;
            font-size: 21px;
        }

        .content-heading span {
            color: #9b8977;
            font-size: 12px;
        }

        .alert {
            padding: 13px 16px;
            background: #edf5ec;
            color: #456d43;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th {
            text-align: left;
            padding: 15px 12px;
            background: #f8f4ee;
            color: #8a7765;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        td {
            padding: 17px 12px;
            border-bottom: 1px solid #f0ebe5;
            font-size: 12px;
            vertical-align: middle;
        }

        .customer {
            font-weight: 700;
            color: #49372a;
        }

        .phone {
            color: #948475;
            margin-top: 5px;
            font-size: 11px;
        }

        .service {
            font-weight: 600;
            color: #6c5039;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .menunggu {
            background: #fff3d9;
            color: #a87925;
        }

        .diproses {
            background: #e8effa;
            color: #456b9d;
        }

        .selesai {
            background: #e6f3e7;
            color: #4c8051;
        }

        .ditolak {
            background: #fbe9e7;
            color: #b6534c;
        }

        .action {
            display: inline-block;
            padding: 8px 12px;
            background: #49372a;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 11px;
            white-space: nowrap;
        }

        .action:hover {
            background: #71533d;
        }

        .empty {
            text-align: center;
            padding: 45px 15px;
            color: #a08f7e;
            font-size: 13px;
        }

        .pagination {
            margin-top: 22px;
        }

        @media(max-width: 900px) {
            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
                padding: 25px;
            }

            .summary {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 600px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .logout {
                position: static;
                margin-top: 20px;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .header {
                display: block;
            }

            .date {
                display: block;
                margin-top: 12px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">
            AMOLE SOFA
            <span>ADMIN PANEL</span>
        </div>

        <div class="menu">
            <p class="menu-title">MENU UTAMA</p>

            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.products.index') }}">Kelola Produk</a>
            <a href="{{ route('admin.orders.index') }}">Kelola Pesanan</a>
            <a href="{{ route('admin.service-requests.index') }}" class="active">Kelola Layanan</a>
            <a href="{{ route('home') }}" target="_blank">Lihat Website</a>
        </div>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <main class="main">

        <div class="header">
            <div>
                <h1>Kelola Layanan</h1>
                <p>Daftar permintaan konsultasi dan layanan pelanggan AMOLE SOFA.</p>
            </div>

            <span class="date">{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>

        <div class="summary">
            <div class="summary-card">
                <p>Total Konsultasi</p>
                <h2>{{ $serviceRequests->total() }}</h2>
            </div>

            <div class="summary-card">
                <p>Menunggu</p>
                <h2>{{ \App\Models\ServiceRequest::where('status', 'Menunggu')->count() }}</h2>
            </div>

            <div class="summary-card">
                <p>Selesai</p>
                <h2>{{ \App\Models\ServiceRequest::where('status', 'Selesai')->count() }}</h2>
            </div>
        </div>

        <div class="content-card">

            <div class="content-heading">
                <h2>Daftar Konsultasi Pelanggan</h2>
                <span>{{ $serviceRequests->total() }} permintaan</span>
            </div>

            @if(session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pelanggan</th>
                            <th>Jenis Layanan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($serviceRequests as $index => $item)
                            <tr>
                                <td>{{ $serviceRequests->firstItem() + $index }}</td>

                                <td>
                                    <div class="customer">{{ $item->nama }}</div>
                                    <div class="phone">{{ $item->telepon }}</div>
                                </td>

                                <td>
                                    <span class="service">{{ $item->nama_layanan }}</span>
                                </td>

                                <td>{{ $item->created_at->format('d/m/Y') }}</td>

                                <td>
                                    @php
                                        $statusClass = match($item->status) {
                                            'Menunggu' => 'menunggu',
                                            'Sedang Diproses' => 'diproses',
                                            'Selesai' => 'selesai',
                                            'Ditolak' => 'ditolak',
                                            default => 'menunggu',
                                        };
                                    @endphp

                                    <span class="status {{ $statusClass }}">
                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.service-requests.show', $item->id) }}" class="action">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty">
                                        Belum ada permintaan konsultasi dari pelanggan.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $serviceRequests->links() }}
            </div>

        </div>

    </main>

</body>
</html>
