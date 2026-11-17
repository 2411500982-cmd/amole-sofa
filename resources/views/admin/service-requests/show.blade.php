<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konsultasi - AMOLE SOFA</title>

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
            max-width: 1500px;
        }

        .back {
            display: inline-block;
            text-decoration: none;
            color: #806b58;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .header {
            margin-bottom: 30px;
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

        .content-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 22px;
            align-items: start;
        }

        .card {
            background: #fff;
            border: 1px solid #eee5da;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 22px;
        }

        .card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 21px;
            margin-bottom: 22px;
            color: #49372a;
        }

        .info-row {
            padding: 15px 0;
            border-bottom: 1px solid #f0ebe5;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            display: block;
            color: #a08e7c;
            font-size: 11px;
            margin-bottom: 7px;
        }

        .info-value {
            color: #49372a;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .detail-text {
            white-space: pre-line;
            font-weight: 400;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
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

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .photo-grid img {
            width: 100%;
            height: 190px;
            object-fit: cover;
            border-radius: 9px;
            border: 1px solid #eee5da;
        }

        .no-photo {
            color: #a08f7e;
            font-size: 13px;
            padding: 20px 0;
        }

        .status-form label {
            display: block;
            color: #8c7c6d;
            font-size: 12px;
            margin-bottom: 9px;
        }

        .status-form select {
            width: 100%;
            padding: 12px;
            border: 1px solid #e7ddd1;
            border-radius: 7px;
            font-family: inherit;
            font-size: 13px;
            color: #49372a;
            background: #fff;
            margin-bottom: 16px;
        }

        .btn {
            display: inline-block;
            width: 100%;
            border: none;
            border-radius: 7px;
            padding: 13px;
            background: #49372a;
            color: #fff;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .btn:hover {
            background: #71533d;
        }

        .btn-delete {
            background: #fff;
            color: #bd5750;
            border: 1px solid #e8c7c3;
            margin-top: 12px;
        }

        .btn-delete:hover {
            background: #fff1ef;
        }

        .alert {
            padding: 13px 16px;
            background: #edf5ec;
            color: #456d43;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .error {
            color: #bd5750;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 12px;
        }

        @media(max-width: 950px) {
            .content-grid {
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

            .photo-grid {
                grid-template-columns: 1fr;
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

        <a href="{{ route('admin.service-requests.index') }}" class="back">
            ← Kembali ke Kelola Layanan
        </a>

        <div class="header">
            <h1>Detail Konsultasi</h1>
            <p>Informasi lengkap permintaan layanan pelanggan AMOLE SOFA.</p>
        </div>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="content-grid">

            <div>

                <div class="card">
                    <h2>Informasi Pelanggan</h2>

                    <div class="info-row">
                        <span class="info-label">Nama Pelanggan</span>
                        <div class="info-value">{{ $serviceRequest->nama }}</div>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Nomor WhatsApp</span>
                        <div class="info-value">{{ $serviceRequest->telepon }}</div>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Alamat</span>
                        <div class="info-value">{{ $serviceRequest->alamat }}</div>
                    </div>
                </div>

                <div class="card">
                    <h2>Informasi Layanan</h2>

                    <div class="info-row">
                        <span class="info-label">Jenis Layanan</span>
                        <div class="info-value">{{ $serviceRequest->nama_layanan }}</div>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Tanggal Konsultasi</span>
                        <div class="info-value">
                            {{ $serviceRequest->created_at->format('d F Y, H:i') }}
                        </div>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Detail Permintaan</span>
                        <div class="info-value detail-text">{{ $serviceRequest->detail }}</div>
                    </div>
                </div>

                <div class="card">
                    <h2>Foto Referensi Sofa</h2>

                    @if(!empty($serviceRequest->gambar))
                        <div class="photo-grid">
                            @foreach($serviceRequest->gambar as $gambar)
                                <a href="{{ asset('storage/' . $gambar) }}" target="_blank">
                                    <img
                                        src="{{ asset('storage/' . $gambar) }}"
                                        alt="Foto referensi sofa pelanggan"
                                    >
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="no-photo">
                            Pelanggan tidak mengunggah foto referensi.
                        </div>
                    @endif
                </div>

            </div>

            <div>

                <div class="card">
                    <h2>Status Konsultasi</h2>

                    <div style="margin-bottom: 22px;">
                        <span class="info-label">Status Saat Ini</span>

                        @php
                            $statusClass = match($serviceRequest->status) {
                                'Menunggu' => 'menunggu',
                                'Sedang Diproses' => 'diproses',
                                'Selesai' => 'selesai',
                                'Ditolak' => 'ditolak',
                                default => 'menunggu',
                            };
                        @endphp

                        <span class="status {{ $statusClass }}">
                            {{ $serviceRequest->status }}
                        </span>
                    </div>

                    <form
                        action="{{ route('admin.service-requests.updateStatus', $serviceRequest->id) }}"
                        method="POST"
                        class="status-form"
                    >
                        @csrf
                        @method('PATCH')

                        <label for="status">Ubah Status Konsultasi</label>

                        <select name="status" id="status" required>
                            <option value="Menunggu" {{ $serviceRequest->status == 'Menunggu' ? 'selected' : '' }}>
                                Menunggu
                            </option>

                            <option value="Sedang Diproses" {{ $serviceRequest->status == 'Sedang Diproses' ? 'selected' : '' }}>
                                Sedang Diproses
                            </option>

                            <option value="Selesai" {{ $serviceRequest->status == 'Selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                            <option value="Ditolak" {{ $serviceRequest->status == 'Ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                        </select>

                        @error('status')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn">
                            Simpan Perubahan Status
                        </button>
                    </form>
                </div>

                <div class="card">
                    <h2>Hapus Konsultasi</h2>

                    <p style="font-size: 12px; color: #968576; line-height: 1.7; margin-bottom: 18px;">
                        Data konsultasi yang dihapus tidak dapat dikembalikan. Foto referensi juga akan dihapus.
                    </p>

                    <form
                        action="{{ route('admin.service-requests.destroy', $serviceRequest->id) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus konsultasi ini?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-delete">
                            Hapus Konsultasi
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </main>

</body>
</html>
