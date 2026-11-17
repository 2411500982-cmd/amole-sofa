@extends('layouts.app')

@section('title', 'Kelola Foto Layanan - AMOLE SOFA')

@section('content')

<style>
    .website-images-page {
        background: #f7f3ed;
        min-height: 100vh;
        padding: 45px 20px 80px;
        color: #49392c;
    }

    .website-images-container {
        max-width: 1150px;
        margin: auto;
    }

    .website-images-heading {
        margin-bottom: 30px;
    }

    .website-images-heading h2 {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .website-images-heading p {
        color: #938477;
        margin: 0;
    }

    .website-images-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 25px;
    }

    .website-image-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(73, 57, 44, 0.07);
    }

    .website-image-preview {
        width: 100%;
        height: 240px;
        object-fit: cover;
        display: block;
    }

    .website-image-content {
        padding: 25px;
    }

    .website-image-content h3 {
        font-size: 19px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .website-image-content label {
        display: block;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .website-image-content input {
        width: 100%;
        padding: 11px;
        border: 1px solid #ded5ca;
        border-radius: 8px;
        background: #fff;
    }

    .website-image-content small {
        display: block;
        color: #938477;
        margin-top: 9px;
    }

    .website-image-button {
        width: 100%;
        border: none;
        border-radius: 8px;
        padding: 13px;
        margin-top: 18px;
        background: #49392c;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .website-image-button:hover {
        background: #80664e;
    }

    .website-alert {
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .website-alert.success {
        background: #e5f3e8;
        color: #28643a;
    }

    .website-alert.error {
        background: #fbe9e7;
        color: #a33c32;
    }

    @media(max-width: 700px) {
        .website-images-grid {
            grid-template-columns: 1fr;
        }

        .website-images-heading h2 {
            font-size: 24px;
        }
    }
</style>

<div class="website-images-page">
    <div class="website-images-container">

        <div class="website-images-heading">
            <h2>Kelola Foto Layanan</h2>
            <p>Atur dan ganti foto layanan AMOLE SOFA dengan mudah.</p>
        </div>

        @if(session('success'))
            <div class="website-alert success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="website-alert error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="website-alert error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="website-images-grid">

            @foreach($images as $item)

                @php
                    $websiteImage = $websiteImages->get($item['key']);
                    $foto = $websiteImage?->image ?? $item['default'];

                    $fotoUrl = str_starts_with($foto, 'http')
                        ? $foto
                        : asset('storage/' . $foto);
                @endphp

                <div class="website-image-card">

                    <img
                        src="{{ $fotoUrl }}"
                        alt="{{ $item['label'] }}"
                        class="website-image-preview"
                    >

                    <div class="website-image-content">

                        <h3>{{ $item['label'] }}</h3>

                        <form
                            action="{{ route('admin.website-images.update', $item['key']) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @csrf

                            <label>Pilih Foto Baru</label>

                            <input
                                type="file"
                                name="image"
                                accept=".jpg,.jpeg,.png,.webp"
                                required
                            >

                            <small>
                                Format JPG, JPEG, PNG, WEBP. Maksimal 5 MB.
                            </small>

                            <button type="submit" class="website-image-button">
                                SIMPAN FOTO
                            </button>

                        </form>

                    </div>
                </div>

            @endforeach

        </div>
    </div>
</div>

@endsection
