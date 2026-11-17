<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Pesanan | AMOLE SOFA</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f1eb;
            color: #302820;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #302820;
            color: white;
            padding: 30px 20px;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .subtitle {
            color: #c9b59b;
            font-size: 11px;
            margin-top: 8px;
            margin-bottom: 45px;
        }

        .menu-title {
            color: #bba98f;
            font-size: 11px;
            margin-bottom: 15px;
        }

        .menu a {
            display: block;
            color: #eee5d9;
            text-decoration: none;
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: #a7835c;
        }

        .main {
            flex: 1;
            min-width: 0;
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
            font-size: 27px;
        }

        .topbar p {
            color: #887b6c;
            font-size: 13px;
            margin-top: 7px;
        }

        .profile {
            background: white;
            padding: 13px 18px;
            border-radius: 9px;
            font-size: 13px;
        }

        .summary {
            background: linear-gradient(120deg, #493a2d, #967654);
            color: white;
            padding: 25px;
            border-radius: 13px;
            margin-bottom: 25px;
        }

        .summary h2 {
            font-size: 17px;
            margin-bottom: 10px;
        }

        .summary strong {
            font-size: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 13px;
        }

        .card h2 {
            font-size: 19px;
            margin-bottom: 20px;
        }

        .success {
            background: #e5f4e8;
            color: #276738;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid #eee7df;
            text-align: left;
            font-size: 13px;
            vertical-align: middle;
        }

        th {
            background: #f8f4ef;
            color: #665544;
        }

        .status {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 11px;
            background: #f1e8d9;
        }

        select {
            padding: 9px;
            border: 1px solid #d9cabb;
            border-radius: 6px;
            background: white;
        }

        button {
            background: #493a2d;
            color: white;
            border: none;
            padding: 10px 13px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #a7835c;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #887b6c;
        }

        .pagination {
            margin-top: 20px;
        }

        @media(max-width: 700px) {
            .wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 20px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">

    <aside class="sidebar">

        <div class="brand">AMOLE SOFA</div>
        <div class="subtitle">ADMIN MANAGEMENT PANEL</div>

        <div class="menu-title">MENU UTAMA</div>

        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}">
                Kelola Produk
            </a>

            <a href="{{ route('admin.orders.index') }}" class="active">
                Kelola Pesanan
            </a>

            <a href="{{ route('admin.service-requests.index') }}">
                Kelola Layanan
            </a>

            <a href="{{ route('home') }}">
                Lihat Website
            </a>
        </nav>

    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h1>Kelola Pesanan</h1>
                <p>Daftar pesanan pelanggan AMOLE SOFA.</p>
            </div>

            <div class="profile">
                Admin: {{ auth()->user()->name }}
            </div>
        </header>

        <section class="summary">
            <h2>Pesanan Menunggu Konfirmasi</h2>
            <strong>{{ $totalPending }}</strong>
            <p>Pesanan yang masih berstatus pending.</p>
        </section>

        <section class="card">

            <h2>Daftar Pesanan Pelanggan</h2>

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($orders as $order)

                            <tr>
                                <td>{{ $orders->firstItem() + $loop->index }}</td>

                                <td>
                                    {{ $order->order_number }}
                                </td>

                                <td>
                                    {{ $order->recipient_name }}
                                    <br>
                                    {{ $order->phone }}
                                </td>

                                <td>
                                    @foreach($order->items as $item)
                                        {{ $item->product_name }}
                                        ({{ $item->quantity }}x)
                                        <br>
                                    @endforeach
                                </td>

                                <td>
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $order->created_at->format('d-m-Y') }}
                                </td>

                                <td>
                                    <span class="status">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td>
                                    <form
                                        action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <select name="status" required>
                                            <option value="pending"
                                                {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Menunggu Konfirmasi
                                            </option>

                                            <option value="processing"
                                                {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                Sedang Diproses
                                            </option>

                                            <option value="shipped"
                                                {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                                Sedang Dikirim
                                            </option>

                                            <option value="completed"
                                                {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                Selesai
                                            </option>

                                            <option value="cancelled"
                                                {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                Dibatalkan
                                            </option>
                                        </select>

                                        <button type="submit">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="empty">
                                    Belum ada pesanan pelanggan.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>

            </div>

            <div class="pagination">
                {{ $orders->links() }}
            </div>

        </section>

    </main>

</div>

</body>
</html>
