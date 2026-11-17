@extends('layouts.app')

@section('title', 'Tambah Produk - AMOLE SOFA')

@section('content')

<style>
    .product-form-container {
        max-width: 850px;
        margin: 40px auto;
        padding: 0 24px;
        color: #302820;
        font-family: Arial, sans-serif;
    }

    .product-form-card {
        background: #fff;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0,0,0,.06);
    }

    .product-form-container h1 {
        font-size: 27px;
        margin-bottom: 8px;
    }

    .form-description {
        color: #887d70;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd2c5;
        border-radius: 7px;
        font-size: 14px;
        box-sizing: border-box;
        background: #fff;
        color: #302820;
    }

    .form-group textarea {
        min-height: 110px;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #a88b68;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .image-preview {
        display: none;
        width: 200px;
        height: 160px;
        object-fit: cover;
        border-radius: 9px;
        margin-top: 15px;
        border: 1px solid #ddd2c5;
    }

    .gallery-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 12px;
        margin-top: 15px;
    }

    .gallery-preview-item {
        position: relative;
    }

    .gallery-preview-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd2c5;
    }

    .gallery-preview-item span {
        display: block;
        font-size: 11px;
        color: #887d70;
        margin-top: 5px;
        overflow-wrap: anywhere;
    }

    .featured-checkbox {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }

    .featured-checkbox input {
        width: 17px;
        height: 17px;
        cursor: pointer;
    }

    .featured-checkbox label {
        font-size: 14px;
        cursor: pointer;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 25px;
    }

    .btn-save,
    .btn-back {
        padding: 12px 22px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 14px;
        border: none;
        cursor: pointer;
    }

    .btn-save {
        background: #302820;
        color: #fff;
    }

    .btn-save:hover {
        background: #594735;
    }

    .btn-back {
        background: #eee7df;
        color: #594735;
    }

    .error-message {
        color: #c0392b;
        font-size: 12px;
        margin-top: 6px;
    }

    @media(max-width: 600px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .product-form-card {
            padding: 20px;
        }
    }
</style>

<div class="product-form-container">

    <h1>Tambah Produk</h1>

    <p class="form-description">
        Masukkan informasi produk baru AMOLE SOFA.
    </p>

    <div class="product-form-card">

        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="form-group">
                <label>Nama Produk *</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Sofa Minimalis 3 Seater"
                    required
                >

                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Kategori Produk *</label>

                <select name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>

                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
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
                <label>Deskripsi Produk</label>

                <textarea
                    name="description"
                    placeholder="Masukkan deskripsi produk..."
                >{{ old('description') }}</textarea>

                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Gambar Utama Produk</label>

                <input
                    type="file"
                    name="image"
                    id="productImage"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small style="color:#887d70;">
                    Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                </small>

                <img
                    id="imagePreview"
                    class="image-preview"
                    alt="Preview gambar utama"
                >

                @error('image')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Foto Tambahan Produk</label>

                <input
                    type="file"
                    name="images[]"
                    id="galleryImages"
                    accept=".jpg,.jpeg,.png,.webp"
                    multiple
                >

                <small style="color:#887d70;">
                    Kamu bisa memilih banyak foto sekaligus.
                    Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB per foto.
                </small>

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
                    <label>Harga Produk *</label>

                    <input
                        type="number"
                        name="price"
                        value="{{ old('price') }}"
                        placeholder="Contoh: 3500000"
                        min="0"
                        step="0.01"
                        required
                    >

                    @error('price')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Harga Diskon</label>

                    <input
                        type="number"
                        name="discount_price"
                        value="{{ old('discount_price') }}"
                        placeholder="Kosongkan jika tidak ada"
                        min="0"
                        step="0.01"
                    >

                    @error('discount_price')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="form-group">
                <label>Stok Produk *</label>

                <input
                    type="number"
                    name="stock"
                    value="{{ old('stock', 0) }}"
                    min="0"
                    placeholder="Masukkan jumlah stok"
                    required
                >

                @error('stock')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="featured-checkbox">
                <input
                    type="checkbox"
                    name="is_featured"
                    id="is_featured"
                    value="1"
                    {{ old('is_featured') ? 'checked' : '' }}
                >

                <label for="is_featured">
                    Jadikan sebagai produk unggulan
                </label>
            </div>

            {{-- Pilihan Produk Baru --}}
            <div class="featured-checkbox">
                <input
                    type="checkbox"
                    name="is_new"
                    id="is_new"
                    value="1"
                    {{ old('is_new') ? 'checked' : '' }}
                >

                <label for="is_new">
                    Tandai sebagai Produk Baru
                </label>
            </div>

            <div class="form-group">
                <label for="status">Status Produk</label>

                <select name="status" id="status" required>
                    <option value="public" {{ old('status', 'public') == 'public' ? 'selected' : '' }}>
                        Public (Tampilkan di Website)
                    </option>

                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                        Draft (Simpan, Jangan Tampilkan)
                    </option>
                </select>

                @error('status')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">

                <button type="submit" class="btn-save">
                    Simpan Produk
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

</div>

<script>
    // Preview foto utama
    document.getElementById('productImage').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    });

    // Preview banyak foto tambahan
    document.getElementById('galleryImages').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('galleryPreview');
        previewContainer.innerHTML = '';

        Array.from(event.target.files).forEach(function(file) {
            const item = document.createElement('div');
            item.className = 'gallery-preview-item';

            const image = document.createElement('img');
            image.src = URL.createObjectURL(file);
            image.alt = 'Preview foto produk';

            const name = document.createElement('span');
            name.textContent = file.name;

            item.appendChild(image);
            item.appendChild(name);

            previewContainer.appendChild(item);
        });
    });
</script>

@endsection
