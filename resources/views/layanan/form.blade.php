<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $namaLayanan }} - AMOLE SOFA</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: #40352c;
            background: #faf7f2;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .navbar {
            height: 82px;
            padding: 0 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .back-link {
            font-size: 13px;
            font-weight: 600;
            color: #8a7159;
        }

        .hero {
            min-height: 460px;
            position: relative;
            display: flex;
            align-items: center;
            background:
                linear-gradient(90deg, rgba(31, 25, 20, .82), rgba(31, 25, 20, .18)),
                url('https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=2000&q=85')
                center 55% / cover;
        }

        .hero-content {
            max-width: 750px;
            padding: 70px 10%;
            color: white;
        }

        .eyebrow {
            font-size: 11px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #e3c9a9;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(38px, 5vw, 62px);
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .hero p {
            max-width: 520px;
            font-size: 15px;
            line-height: 1.9;
            color: #eee4da;
            margin-bottom: 30px;
        }

        .hero-button {
            display: inline-block;
            background: #c4a47d;
            color: white;
            padding: 15px 28px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            transition: .3s;
        }

        .hero-button:hover {
            background: #a88765;
        }

        .benefits {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            padding: 32px 10%;
            background: #fff;
            gap: 25px;
        }

        .benefit {
            text-align: center;
            border-right: 1px solid #eee5da;
        }

        .benefit:last-child {
            border: none;
        }

        .benefit strong {
            display: block;
            font-family: 'Playfair Display', serif;
            font-size: 19px;
            margin-bottom: 7px;
        }

        .benefit span {
            font-size: 12px;
            color: #95816d;
        }

        .consultation {
            padding: 90px 8%;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 45px;
        }

        .section-heading span {
            color: #a88765;
            text-transform: uppercase;
            letter-spacing: 4px;
            font-size: 10px;
            font-weight: 700;
        }

        .section-heading h2 {
            font-family: 'Playfair Display', serif;
            font-size: 39px;
            margin: 13px 0;
        }

        .section-heading p {
            color: #897d70;
            font-size: 14px;
        }

        .consultation-wrapper {
            max-width: 1100px;
            margin: auto;
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            background: white;
            box-shadow: 0 15px 55px rgba(70, 52, 34, .07);
        }

        .form-area {
            padding: 45px;
        }

        .form-area h3,
        .info-area h3 {
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            margin-bottom: 12px;
        }

        .form-area > p {
            font-size: 13px;
            color: #918477;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #e8dfd4;
            background: #fdfbf8;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            color: #40352c;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #b79570;
        }

        .form-group textarea {
            min-height: 115px;
            resize: vertical;
        }

        /* UPLOAD GAMBAR */
        .upload-box {
            border: 1.5px dashed #cbb69e;
            background: #fdfbf8;
            padding: 30px 20px;
            text-align: center;
            cursor: pointer;
            transition: .3s;
            display: block;
        }

        .upload-box:hover {
            border-color: #80654b;
            background: #f7f0e7;
        }

        .upload-icon {
            color: #80654b;
            margin-bottom: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .upload-box strong {
            display: block;
            font-size: 13px;
            margin-bottom: 8px;
            color: #594532;
        }

        .upload-box span {
            display: block;
            color: #95816d;
            font-size: 11px;
            line-height: 1.7;
        }

        .upload-box input {
            display: none;
        }

        .upload-info {
            margin-top: 10px;
            font-size: 11px;
            color: #95816d;
            line-height: 1.7;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .preview-item {
            position: relative;
            aspect-ratio: 1 / 1;
            border-radius: 5px;
            overflow: hidden;
            background: #eee5da;
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-image {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 27px;
            height: 27px;
            border: none;
            border-radius: 50%;
            background: #30271f;
            color: white;
            font-size: 17px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-image:hover {
            background: #a44343;
        }

        .image-count {
            margin-top: 12px;
            font-size: 11px;
            color: #80654b;
            font-weight: 700;
        }

        .error-message {
            color: #b13e3e;
            font-size: 12px;
            margin-top: 7px;
            line-height: 1.5;
        }

        .error-alert {
            padding: 15px;
            margin-bottom: 22px;
            background: #fff0ef;
            border: 1px solid #e9c2bd;
            color: #a33b35;
            font-size: 12px;
            line-height: 1.8;
        }

        .submit-button {
            width: 100%;
            border: none;
            padding: 17px;
            background: #80654b;
            color: white;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            transition: .3s;
        }

        .submit-button:hover {
            background: #5e4936;
        }

        .info-area {
            padding: 45px 35px;
            background: #eee5da;
        }

        .info-area > p {
            font-size: 13px;
            line-height: 1.9;
            color: #786958;
            margin-bottom: 30px;
        }

        .info-item {
            padding: 20px 0;
            border-bottom: 1px solid #d9cbb9;
        }

        .info-item strong {
            display: block;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .info-item span {
            font-size: 12px;
            color: #786958;
            line-height: 1.7;
        }

        .info-note {
            margin-top: 30px;
            padding: 20px;
            background: rgba(255,255,255,.55);
            font-size: 12px;
            line-height: 1.8;
            color: #786958;
        }

        .footer {
            padding: 30px 8%;
            background: #30271f;
            color: #d7c8b7;
            text-align: center;
            font-size: 12px;
        }

        .footer strong {
            display: block;
            font-family: 'Playfair Display', serif;
            font-size: 21px;
            color: white;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        @media(max-width: 768px) {
            .navbar {
                padding: 0 6%;
                height: 70px;
            }

            .hero {
                min-height: 420px;
            }

            .hero-content {
                padding: 55px 7%;
            }

            .benefits {
                grid-template-columns: 1fr;
                gap: 22px;
            }

            .benefit {
                border-right: none;
                border-bottom: 1px solid #eee5da;
                padding-bottom: 18px;
            }

            .benefit:last-child {
                border: none;
            }

            .consultation {
                padding: 60px 5%;
            }

            .section-heading h2 {
                font-size: 31px;
            }

            .consultation-wrapper {
                grid-template-columns: 1fr;
            }

            .form-area,
            .info-area {
                padding: 30px 23px;
            }

            .preview-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
    </style>
</head>

<body>

    <header class="navbar">
        <a href="{{ route('home') }}" class="logo">
            AMOLE SOFA
        </a>

        <a href="{{ route('home') }}#layanan" class="back-link">
            ← Kembali ke Beranda
        </a>
    </header>

    <section class="hero">
        <div class="hero-content">
            <div class="eyebrow">AMOLE SOFA SERVICE</div>

            <h1>{{ $namaLayanan }}</h1>

            <p>
                Wujudkan kembali kenyamanan sofa Anda bersama AMOLE SOFA.
                Kami siap membantu menghadirkan kualitas, kenyamanan,
                dan tampilan sofa yang lebih baik untuk ruang Anda.
            </p>

            <a href="#konsultasi" class="hero-button">
                KONSULTASI SEKARANG →
            </a>
        </div>
    </section>

    <section class="benefits">
        <div class="benefit">
            <strong>Tenaga Profesional</strong>
            <span>Dikerjakan dengan perhatian terhadap detail</span>
        </div>

        <div class="benefit">
            <strong>Material Berkualitas</strong>
            <span>Mengutamakan kenyamanan dan kualitas</span>
        </div>

        <div class="benefit">
            <strong>Konsultasi Mudah</strong>
            <span>Hubungi tim kami melalui WhatsApp</span>
        </div>
    </section>

    <section class="consultation" id="konsultasi">

        <div class="section-heading">
            <span>LET'S TALK ABOUT YOUR SOFA</span>
            <h2>Konsultasikan Kebutuhan Anda</h2>
            <p>Isi formulir berikut agar tim AMOLE SOFA dapat membantu Anda.</p>
        </div>

        <div class="consultation-wrapper">

            <div class="form-area">
                <h3>Form Konsultasi</h3>

                <p>
                    Lengkapi informasi berikut dengan benar.
                    Kami akan membantu menindaklanjuti kebutuhan Anda.
                </p>

                @if ($errors->any())
                    <div class="error-alert">
                        <strong>Formulir belum dapat dikirim.</strong>
                        <ul style="padding-left: 18px; margin-top: 7px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="consultationForm"
                    action="{{ route('layanan.konsultasi') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <input type="hidden"
                        name="namaLayanan"
                        value="{{ $namaLayanan }}">

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama lengkap"
                            required>

                        @error('nama')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telepon">Nomor WhatsApp</label>
                        <input type="tel"
                            id="telepon"
                            name="telepon"
                            value="{{ old('telepon') }}"
                            placeholder="Contoh: 081234567890"
                            required>

                        @error('telepon')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- UPLOAD FOTO SOFA -->
                    <div class="form-group">
                        <label>Foto Sofa atau Gambar Referensi</label>

                        <label for="gambar" class="upload-box">

                            <div class="upload-icon">
                                <svg width="34" height="34"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 16V4"/>
                                    <path d="m7 9 5-5 5 5"/>
                                    <path d="M20 16.5v2A1.5 1.5 0 0 1 18.5 20h-13A1.5 1.5 0 0 1 4 18.5v-2"/>
                                </svg>
                            </div>

                            <strong>Klik untuk memilih gambar</strong>

                            <span>
                                Upload foto sofa Anda atau desain yang diinginkan
                            </span>

                            <span style="margin-top: 8px;">
                            </span>
                        </label>

                        <input type="file"
                            id="gambar"
                            name="gambar[]"
                            accept=".jpg,.jpeg,.png,.webp"
                            multiple
                            style="display: none;">

                        <div class="upload-info">
                            Maksimal 5 gambar. Ukuran setiap gambar maksimal 5 MB.
                            Foto bersifat opsional.
                        </div>

                        <div id="previewGrid" class="preview-grid"></div>

                        <div id="imageCount" class="image-count">
                            Belum ada gambar dipilih.
                        </div>

                        @error('gambar')
                            <div class="error-message">{{ $message }}</div>
                        @enderror

                        @foreach ($errors->get('gambar.*') as $messages)
                            @foreach ($messages as $message)
                                <div class="error-message">{{ $message }}</div>
                            @endforeach
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text"
                            id="alamat"
                            name="alamat"
                            value="{{ old('alamat') }}"
                            placeholder="Masukkan alamat Anda"
                            required>

                        @error('alamat')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="detail">Detail Kebutuhan</label>
                        <textarea id="detail"
                            name="detail"
                            placeholder="Ceritakan kondisi sofa atau kebutuhan Anda..."
                            required>{{ old('detail') }}</textarea>

                        @error('detail')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="submit-button">
                        KIRIM KONSULTASI MELALUI WHATSAPP →
                    </button>

                </form>
            </div>

            <aside class="info-area">
                <h3>Mengapa AMOLE SOFA?</h3>

                <p>
                    Kami percaya setiap sofa memiliki cerita dan kenyamanan
                    tersendiri. Karena itu, kami membantu Anda mendapatkan
                    solusi yang sesuai dengan kebutuhan.
                </p>

                <div class="info-item">
                    <strong>01. Konsultasi Kebutuhan</strong>
                    <span>Ceritakan kondisi dan kebutuhan sofa Anda.</span>
                </div>

                <div class="info-item">
                    <strong>02. Diskusi Solusi</strong>
                    <span>Tim kami membantu mendiskusikan solusi yang tepat.</span>
                </div>

                <div class="info-item">
                    <strong>03. Penawaran Layanan</strong>
                    <span>Dapatkan informasi dan penawaran sesuai kebutuhan.</span>
                </div>

                <div class="info-note">
                    <strong>Informasi:</strong><br>
                    Foto sofa atau gambar referensi dapat dilampirkan
                    agar tim AMOLE SOFA lebih mudah memahami kebutuhan Anda.
                    Setelah formulir dikirim, WhatsApp akan terbuka
                    secara otomatis.
                </div>
            </aside>

        </div>
    </section>

    <footer class="footer">
        <strong>AMOLE SOFA</strong>
        © {{ date('Y') }} AMOLE SOFA. All rights reserved.
    </footer>

    <script>
        const inputGambar = document.getElementById('gambar');
        const previewGrid = document.getElementById('previewGrid');
        const imageCount = document.getElementById('imageCount');

        let daftarFile = [];

        inputGambar.addEventListener('change', function () {

            const fileBaru = Array.from(this.files);
            const formatDiizinkan = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            let fileValid = [];

            fileBaru.forEach(file => {

                if (!formatDiizinkan.includes(file.type)) {
                    alert('Format ' + file.name + ' tidak didukung.');
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran ' + file.name + ' melebihi 5 MB.');
                    return;
                }

                fileValid.push(file);
            });

            if (fileValid.length > 5) {
                alert('Maksimal hanya boleh memilih 5 gambar.');
                fileValid = fileValid.slice(0, 5);
            }

            daftarFile = fileValid;

            perbaruiPreview();
        });

        function perbaruiPreview() {

            previewGrid.innerHTML = '';

            const dataTransfer = new DataTransfer();

            daftarFile.forEach((file, index) => {

                dataTransfer.items.add(file);

                const previewItem = document.createElement('div');
                previewItem.className = 'preview-item';

                const gambar = document.createElement('img');
                gambar.src = URL.createObjectURL(file);
                gambar.alt = 'Preview gambar ' + (index + 1);

                const tombolHapus = document.createElement('button');
                tombolHapus.type = 'button';
                tombolHapus.className = 'remove-image';
                tombolHapus.innerHTML = '&times;';
                tombolHapus.title = 'Hapus gambar';

                tombolHapus.addEventListener('click', function () {
                    daftarFile.splice(index, 1);
                    perbaruiPreview();
                });

                previewItem.appendChild(gambar);
                previewItem.appendChild(tombolHapus);

                previewGrid.appendChild(previewItem);
            });

            inputGambar.files = dataTransfer.files;

            if (daftarFile.length === 0) {
                imageCount.textContent = 'Belum ada gambar dipilih.';
            } else {
                imageCount.textContent =
                    daftarFile.length + ' dari 5 gambar dipilih.';
            }
        }
    </script>

</body>
</html>
