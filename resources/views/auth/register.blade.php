
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - AMOLE SOFA</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'DM Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            position: relative;
            overflow-x: hidden;
            background: #6a5140;
        }

        /* BACKGROUND GAMBAR SOFA */
        .background-image {
            position: fixed;
            inset: 0;
            z-index: -2;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .background-overlay {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: rgba(30, 21, 15, 0.48);
            backdrop-filter: blur(2px);
        }

        /* REGISTER CARD */
        .register-container {
            width: 100%;
            max-width: 460px;
            padding: 42px;
            margin: 20px 0;
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 18px;
            box-shadow: 0 20px 70px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(15px);
        }

        /* BRAND */
        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-label {
            color: #98764d;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 4px;
            margin-bottom: 12px;
        }

        .brand h1 {
            color: #302820;
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            letter-spacing: 2px;
            margin-bottom: 9px;
        }

        .brand p {
            color: #8b7c70;
            font-size: 12px;
            line-height: 1.8;
        }

        /* FORM */
        .register-form h2 {
            color: #302820;
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            text-align: center;
            margin-bottom: 8px;
        }

        .register-subtitle {
            color: #8b7c70;
            text-align: center;
            font-size: 12px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            color: #4b3a2e;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #ded4ca;
            border-radius: 8px;
            outline: none;
            font-size: 13px;
            background: #fff;
            transition: .3s;
        }

        .form-group input:focus {
            border-color: #98764d;
            box-shadow: 0 0 0 3px rgba(152, 118, 77, .12);
        }

        .form-group input::placeholder {
            color: #b4aaa1;
        }

        .error-message {
            display: block;
            color: #c0392b;
            font-size: 12px;
            margin-top: 6px;
        }

        .error-box {
            color: #c0392b;
            background: #fff0ee;
            padding: 12px;
            border-radius: 7px;
            font-size: 12px;
            margin-bottom: 18px;
            line-height: 1.7;
        }

        /* BUTTON */
        .register-button {
            width: 100%;
            padding: 15px;
            margin-top: 7px;
            border: none;
            border-radius: 8px;
            background: #5a4030;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            transition: .3s;
        }

        .register-button:hover {
            background: #98764d;
            transform: translateY(-2px);
        }

        /* LINK */
        .login-link {
            margin-top: 23px;
            text-align: center;
            color: #817368;
            font-size: 12px;
        }

        .login-link a {
            color: #98764d;
            font-weight: 700;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .back-home {
            margin-top: 18px;
            text-align: center;
        }

        .back-home a {
            color: #8b7c70;
            text-decoration: none;
            font-size: 12px;
        }

        .back-home a:hover {
            color: #5a4030;
        }

        /* RESPONSIVE HP */
        @media (max-width: 500px) {
            body {
                padding: 15px;
            }

            .register-container {
                padding: 32px 23px;
            }

            .brand h1 {
                font-size: 28px;
            }

            .register-form h2 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

    @php
        $fotoCustom = \App\Models\WebsiteImage::where('image_key', 'service_custom')->value('image')
            ?? 'https://images.unsplash.com/photo-1550254478-ead40cc54513?w=1600';

        $fotoCustomUrl = str_starts_with($fotoCustom, 'http')
            ? $fotoCustom
            : asset('storage/' . $fotoCustom);
    @endphp

    <!-- BACKGROUND GAMBAR SOFA -->
    <div
        class="background-image"
        style="background-image: url('{{ $fotoCustomUrl }}');">
    </div>

    <div class="background-overlay"></div>

    <!-- FORM REGISTER DI TENGAH -->
    <div class="register-container">

        <div class="brand">

            <div class="brand-label">
                COMFORT & ELEGANCE
            </div>

            <h1>AMOLE SOFA</h1>

            <p>
                Bergabunglah bersama AMOLE SOFA dan
                wujudkan kenyamanan di rumah Anda.
            </p>

        </div>

        <div class="register-form">

            <h2>Buat Akun Baru</h2>

            <p class="register-subtitle">
                Lengkapi data berikut untuk mendaftar.
            </p>

            @if ($errors->any())
                <div class="error-box">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="form-group">

                    <label for="name">Nama Lengkap</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                </div>

                <div class="form-group">

                    <label for="email">Alamat Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan alamat email"
                        required
                    >

                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                </div>

                <div class="form-group">

                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        required
                    >

                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                </div>

                <div class="form-group">

                    <label for="password_confirmation">
                        Konfirmasi Password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        required
                    >

                </div>

                <button type="submit" class="register-button">
                    DAFTAR SEKARANG
                </button>

            </form>

            <div class="login-link">
                Sudah memiliki akun?
                <a href="{{ route('login') }}">
                    Masuk di Sini
                </a>
            </div>

            <div class="back-home">
                <a href="{{ route('home') }}">
                    ← Kembali ke Beranda
                </a>
            </div>

        </div>

    </div>

</body>
</html>
