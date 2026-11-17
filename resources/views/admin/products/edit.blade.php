@extends('layouts.app')

@section('title', 'Edit Produk - AMOLE SOFA')

@section('content')

<style>
    .product-form-wrapper {
        max-width: 850px;
        margin: 35px auto;
        padding: 30px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(70, 50, 30, 0.08);
        color: #302820;
    }

    .product-form-wrapper h2 {
        margin-bottom: 8px;
        color: #302820;
    }

    .form-description {
        color: #887b6d;
        margin-bottom: 28px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-control {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #ded4c8;
        border-radius: 8px;
        background: #fffdfb;
        color: #302820;
        font-size: 14px;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #a77b50;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .current-image {
        margin-top: 12px;
    }

    .current-image img {
        width: 150px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ded4c8;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 14px;
        margin-top: 15px;
    }

    .gallery-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ded4c8;
    }

    .gallery-item p {
        font-size: 12px;
        color: #887b6d;
        margin-top: 5px;
        overflow-wrap: anywhere;
    }

    .gallery-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 14px;
        margin-top: 15px;
    }

    .gallery-preview img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ded4c8;
    }

    .image-note {
        color: #887b6d;
        font-size: 12px;
        margin-top: 7px;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .checkbox-group label {
        margin: 0;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 28px;
    }

    .btn-submit,
    .btn-back {
        display: inline-block;
        padding: 12px 22px;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-submit {
        background: #806044;
        color: white;
    }

    .btn-submit:hover {
        background: #674b34;
    }

    .btn-back {
        background: #eee7df;
        color: #554638;
    }

    .error-message {
        color: #c0392b;
        font-size: 12px;
        margin-top: 6px;
    }

    @media (max-width: 600px) {
        .product-form-wrapper {
            margin: 20px 12px;
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }
</style>

<div class="product-form-wrapper">

    <h2>Edit Produk</h2>

    <p class="form-description">
        Perbarui informasi dan foto produk AMOLE SOFA.
    </p>

    <form
        action="{{ route('admin.products.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Produk</label>

            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name', $product->name) }}"
                required
            >

            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Kategori Produk</label>

            <select
                name="category_id"
                id="category_id"
                class="form-control"
                required
            >
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Produk</label>

            <textarea
                name="description"
                id="description"
                class="form-control"
            >{{ old('description', $product->description) }}</textarea>

            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Foto Utama -->
        <div class="form-group">
            <label for="image">Ganti Foto Utama Produk</label>

            <input
                type="file"
                name="image"
                id="image"
                class="form-control"
                accept=".jpg,.jpeg,.png,.webp"
            >

            <p class="image-note">
                Kosongkan jika tidak ingin mengganti foto utama.
                Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
            </p>

            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="current-image">
                <p>Foto utama saat ini:</p>

                @if ($product->image)
                    <img
                        id="imagePreview"
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                    >
                @else
                    <img
                        id="imagePreview"
                        src=""
                        alt="Preview foto produk"
                        style="display: none;"
                    >

                    <p id="noImageText">Belum ada foto utama.</p>
                @endif
            </div>
        </div>

        <!-- Foto Galeri yang Sudah Tersimpan -->
        <div class="form-group">
            <label>Foto Tambahan Saat Ini</label>

            @if ($product->images->count() > 0)

                <div class="gallery-grid">
                    @foreach ($product->images as $galleryImage)
                        <div class="gallery-item">
                            <img
                                src="{{ asset('storage/' . $galleryImage->image_path) }}"
                                alt="Foto tambahan {{ $product->name }}"
                            >

                            <p>Foto tambahan {{ $loop->iteration }}</p>
                        </div>
                    @endforeach
                </div>

            @else

                <p class="image-note">
                    Belum ada foto tambahan untuk produk ini.
                </p>

            @endif
        </div>

        <!-- Upload Foto Tambahan -->
        <div class="form-group">
            <label for="galleryImages">Tambah Foto Produk</label>

            <input
                type="file"
                name="images[]"
                id="galleryImages"
                class="form-control"
                accept=".jpg,.jpeg,.png,.webp"
                multiple
            >

            <p class="image-note">
                Kamu bisa memilih lebih dari dua foto sekaligus.
                Foto lama tidak akan dihapus.
                Maksimal 2 MB per foto.
            </p>

            <div id="galleryPreview" class="gallery-preview"></div>

            @error('images')
                <div class="error-message">{{ $message }}</div>
            @enderror

            @error('images.*')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">

            <div class="form-group">
                <label for="price">Harga Produk</label>

                <input
                    type="number"
                    name="price"
                    id="price"
                    class="form-control"
                    value="{{ old('price', $product->price) }}"
                    min="0"
                    step="0.01"
                    required
                >

                @error('price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="discount_price">Harga Diskon</label>

                <input
                    type="number"
                    name="discount_price"
                    id="discount_price"
                    class="form-control"
                    value="{{ old('discount_price', $product->discount_price) }}"
                    min="0"
                    step="0.01"
                >

                @error('discount_price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="form-group">
            <label for="stock">Stok Produk</label>

            <input
                type="number"
                name="stock"
                id="stock"
                class="form-control"
                value="{{ old('stock', $product->stock) }}"
                min="0"
                required
            >

            @error('stock')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Produk Unggulan -->
        <div class="form-group">
            <div class="checkbox-group">
                <input
                    type="checkbox"
                    name="is_featured"
                    id="is_featured"
                    value="1"
                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                >

                <label for="is_featured">
                    Jadikan Produk Unggulan
                </label>
            </div>
        </div>

        <!-- Status Produk -->
        <div class="form-group">
            <label for="status">Status Produk</label>

            <select
                name="status"
                id="status"
                class="form-control"
                required
            >
                <option
                    value="public"
                    {{ old('status', $product->status) == 'public' ? 'selected' : '' }}
                >
                    Public (Tampilkan di Website)
                </option>

                <option
                    value="draft"
                    {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}
                >
                    Draft (Simpan, Jangan Tampilkan)
                </option>
            </select>

            @error('status')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">

            <button type="submit" class="btn-submit">
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.products.index') }}"
                class="btn-back"
            >
                Kembali
            </a>

        </div>

    </form>
</div>

<script>
    // Preview foto utama
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const noImageText = document.getElementById('noImageText');

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';

            if (noImageText) {
                noImageText.style.display = 'none';
            }
        }
    });

    // Preview banyak foto tambahan
    document.getElementById('galleryImages').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('galleryPreview');

        previewContainer.innerHTML = '';

        Array.from(event.target.files).forEach(function(file) {
            const image = document.createElement('img');

            image.src = URL.createObjectURL(file);
            image.alt = 'Preview foto tambahan';

            previewContainer.appendChild(image);
        });
    });
</script>

@endsection
