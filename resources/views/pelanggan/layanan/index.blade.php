@extends('layouts.app')

@section('title', 'Layanan Saya - AMOLE SOFA')

@section('content')

<style>
    .services-page {
        background: #f8f5f0;
        min-height: 100vh;
        padding: 55px 20px 90px;
        font-family: Arial, sans-serif;
        color: #302820;
    }

    .services-container {
        max-width: 1120px;
        margin: auto;
    }

    /* HEADER */
    .services-heading {
        margin-bottom: 30px;
    }

    .services-eyebrow {
        color: #a7835c;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .services-heading h1 {
        font-family: Georgia, serif;
        font-size: 36px;
        font-weight: 500;
        color: #302820;
        margin: 0 0 10px;
    }

    .services-heading p {
        color: #82776b;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
    }

    /* SUMMARY */
    .services-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 24px 28px;
        background: #302820;
        border-radius: 15px;
        color: #fff;
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

    .summary-number span {
        font-family: Arial, sans-serif;
        font-size: 14px;
        color: #d5c5ae;
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

    /* SECTION TITLE */
    .services-section-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 18px;
    }

    .services-section-title h2 {
        font-family: Georgia, serif;
        font-size: 23px;
        font-weight: 500;
        margin: 0;
    }

    .services-section-title span {
        color: #948779;
        font-size: 12px;
    }

    /* SERVICE CARD */
    .service-card {
        background: #fff;
        border: 1px solid #eee6dc;
        border-radius: 14px;
        margin-bottom: 20px;
        overflow: hidden;
        transition: .25s ease;
    }

    .service-card:hover {
        box-shadow: 0 10px 28px rgba(48, 40, 32, .07);
        transform: translateY(-2px);
    }

    .service-card-header {
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        border-bottom: 1px solid #f1ece5;
        flex-wrap: wrap;
    }

    .service-label {
        color: #a09283;
        font-size: 11px;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .service-name {
        font-family: Georgia, serif;
        font-size: 21px;
        font-weight: 600;
        color: #60452f;
    }

    .service-date {
        color: #92877c;
        font-size: 12px;
        margin-top: 7px;
    }

    /* STATUS */
    .service-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .service-status::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-menunggu {
        background: #fff4dc;
        color: #ad7925;
    }

    .status-proses {
        background: #eaf1ff;
        color: #4269a9;
    }

    .status-selesai {
        background: #e9f4e6;
        color: #53834c;
    }

    .status-ditolak {
        background: #fcebea;
        color: #bd5a55;
    }

    /* SERVICE BODY */
    .service-card-body {
        padding: 23px 24px;
    }

    .service-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .info-group {
        min-width: 0;
    }

    .info-label {
        display: block;
        color: #a09283;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
        margin-bottom: 7px;
    }

    .info-value {
        color: #40362e;
        font-size: 13px;
        font-weight: 500;
        line-height: 1.8;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .service-detail {
        grid-column: 1 / -1;
        background: #faf8f5;
        border: 1px solid #f0ebe4;
        border-radius: 10px;
        padding: 16px;
    }

    /* PHOTOS */
    .service-photos {
        margin-top: 23px;
        padding-top: 20px;
        border-top: 1px solid #eee8df;
    }

    .service-photos-title {
        color: #766757;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 13px;
    }

    .photo-list {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .photo-item {
        width: 125px;
        height: 105px;
        display: block;
        border-radius: 9px;
        overflow: hidden;
        border: 1px solid #e9e0d5;
        background: #f0e9df;
    }

    .photo-item img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: .3s ease;
    }

    .photo-item:hover img {
        transform: scale(1.06);
    }

    /* EMPTY STATE */
    .empty-services {
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

    .empty-services h3 {
        font-family: Georgia, serif;
        font-size: 23px;
        font-weight: 500;
        color: #302820;
        margin-bottom: 10px;
    }

    .empty-services p {
        color: #938678;
        font-size: 13px;
        line-height: 1.7;
        margin-bottom: 24px;
    }

    .service-button {
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

    .service-button:hover {
        background: #a7835c;
    }

    /* PAGINATION */
    .services-pagination {
        margin-top: 25px;
    }

    .services-pagination nav {
        display: flex;
        justify-content: center;
    }

    .services-pagination svg {
        width: 18px;
    }

    /* RESPONSIVE */
    @media (max-width: 650px) {
        .services-page {
            padding: 35px 14px 65px;
        }

        .services-heading h1 {
            font-size: 29px;
        }

        .services-summary {
            padding: 20px;
        }

        .service-card-header,
        .service-card-body {
            padding: 17px;
        }

        .service-name {
            font-size: 19px;
        }

        .service-info-grid {
            grid-template-columns: 1fr;
            gap: 17px;
        }

        .service-detail {
            grid-column: auto;
        }

        .service-status {
            font-size: 10px;
        }

        .photo-item {
            width: 95px;
            height: 85px;
        }

        .services-section-title {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

<div class="services-page">
    <div class="services-container">

        {{-- HEADER --}}
        <div class="services-heading">
            <div class="services-eyebrow">AMOLE SOFA CUSTOMER AREA</div>
            <h1>Layanan Saya</h1>
            <p>Pantau pengajuan layanan dan perkembangan pengerjaan sofa Anda.</p>
        </div>

        {{-- SUMMARY --}}
        <div class="services-summary">
            <div>
                <div class="summary-label">Riwayat Pengajuan Layanan</div>
                <div class="summary-number">
                    {{ $serviceRequests->total() }}
                    <span>Pengajuan</span>
                </div>
            </div>

        </div>

        {{-- SERVICE LIST --}}
        <div class="services-section-title">
            <h2>Daftar Pengajuan</h2>
            <span>Riwayat layanan Anda</span>
        </div>

        @forelse ($serviceRequests as $service)

            @php
                $statusClass = match ($service->status) {
                    'Menunggu' => 'status-menunggu',
                    'Sedang Diproses' => 'status-proses',
                    'Selesai' => 'status-selesai',
                    'Ditolak' => 'status-ditolak',
                    default => 'status-menunggu',
                };
            @endphp

            <div class="service-card">

                {{-- CARD HEADER --}}
                <div class="service-card-header">
                    <div>
                        <div class="service-label">Jenis Layanan</div>

                        <div class="service-name">
                            {{ $service->nama_layanan }}
                        </div>

                        <div class="service-date">
                            Tanggal pengajuan:
                            {{ $service->created_at->format('d F Y, H:i') }}
                        </div>
                    </div>

                    <span class="service-status {{ $statusClass }}">
                        {{ $service->status }}
                    </span>
                </div>

                {{-- CARD BODY --}}
                <div class="service-card-body">

                    <div class="service-info-grid">

                        <div class="info-group">
                            <span class="info-label">Nama Pelanggan</span>
                            <div class="info-value">
                                {{ $service->nama }}
                            </div>
                        </div>

                        <div class="info-group">
                            <span class="info-label">Nomor WhatsApp</span>
                            <div class="info-value">
                                {{ $service->telepon }}
                            </div>
                        </div>

                        <div class="info-group">
                            <span class="info-label">Alamat</span>
                            <div class="info-value">
                                {{ $service->alamat }}
                            </div>
                        </div>

                        <div class="info-group service-detail">
                            <span class="info-label">Detail Konsultasi</span>
                            <div class="info-value">
                                {{ $service->detail }}
                            </div>
                        </div>

                    </div>

                    {{-- FOTO REFERENSI --}}
                    @if (!empty($service->gambar) && count($service->gambar) > 0)
                        <div class="service-photos">

                            <div class="service-photos-title">
                                FOTO REFERENSI
                            </div>

                            <div class="photo-list">
                                @foreach ($service->gambar as $gambar)
                                    <a
                                        href="{{ asset('storage/' . $gambar) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="photo-item"
                                    >
                                        <img
                                            src="{{ asset('storage/' . $gambar) }}"
                                            alt="Foto referensi layanan"
                                            loading="lazy"
                                        >
                                    </a>
                                @endforeach
                            </div>

                        </div>
                    @endif

                </div>
            </div>

        @empty

            {{-- EMPTY STATE --}}
            <div class="empty-services">

                <h3>Belum Ada Pengajuan Layanan</h3>

                <p>
                    Anda belum pernah mengajukan layanan.<br>
                    Silakan pilih layanan yang dibutuhkan untuk sofa Anda.
                </p>

                <a href="{{ route('home') }}" class="service-button">
                    KEMBALI KE BERANDA
                </a>
            </div>

        @endforelse

        {{-- PAGINATION --}}
        @if ($serviceRequests->hasPages())
            <div class="services-pagination">
                {{ $serviceRequests->links() }}
            </div>
        @endif

    </div>
</div>

@endsection
