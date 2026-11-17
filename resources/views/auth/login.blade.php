<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AMOLE SOFA</title>

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

        /* LOGIN CARD */
        .login-container {
            width: 100%;
            max-width: 440px;
            padding: 48px 42px;
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 18px;
            box-shadow: 0 20px 70px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(15px);
        }

        .brand {
            text-align: center;
            margin-bottom: 35px;
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
            font-size: 34px;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .brand p {
            color: #8b7c70;
            font-size: 13px;
            line-height: 1.8;
        }

        .login-form h2 {
            color: #302820;
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            text-align: center;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: #8b7c70;
            text-align: center;
            font-size: 12px;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #4b3a2e;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 15px;
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

        .login-button {
            width: 100%;
            padding: 15px;
            margin-top: 8px;
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

        .login-button:hover {
            background: #98764d;
            transform: translateY(-2px);
        }

        .message-success {
            color: #27834b;
            background: #edf8f0;
            padding: 12px;
            border-radius: 7px;
            font-size: 12px;
            margin-bottom: 18px;
        }

        .message-error {
            color: #c0392b;
            background: #fff0ee;
            padding: 12px;
            border-radius: 7px;
            font-size: 12px;
            margin-bottom: 18px;
        }

        .register-link {
            margin-top: 25px;
            text-align: center;
            color: #817368;
            font-size: 12px;
        }

        .register-link a {
            color: #98764d;
            font-weight: 700;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .back-home {
            margin-top: 20px;
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
                padding: 18px;
            }

            .login-container {
                padding: 38px 25px;
            }

            .brand h1 {
                font-size: 29px;
            }

            .login-form h2 {
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

    <!-- BACKGROUND GAMBAR -->
    <div
        class="background-image"
        style="background-image: url('{{ $fotoCustomUrl }}');">
    </div>

    <div class="background-overlay"></div>

    <!-- FORM LOGIN DI TENGAH -->
    <div class="login-container">

        <div class="brand">
            <div class="brand-label">COMFORT & ELEGANCE</div>

            <h1>AMOLE SOFA</h1>

        </div>

        <div class="login-form">

            <h2>Selamat Datang</h2>

            <p class="login-subtitle">
                Silakan masuk ke akun AMOLE SOFA Anda.
            </p>

            @if (session('success'))
                <div class="message-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="message-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Alamat Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan alamat email"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >
                </div>

                <button type="submit" class="login-button">
                    MASUK KE AKUN
                </button>
            </form>

            <div class="register-link">
                Belum memiliki akun?
                <a href="{{ route('register') }}">
                    Daftar Sekarang
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
