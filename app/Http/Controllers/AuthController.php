<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Menampilkan halaman registrasi
    public function showRegister()
    {
        return view('auth.register');
    }

    // Memproses registrasi pelanggan
    public function register(Request $request)
    {
        // Rapikan email
        $request->merge([
            'email' => Str::lower(trim($request->input('email', ''))),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers(),
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Membuat akun pelanggan
        $user = new User();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];

        // Role ditentukan langsung oleh server
        $user->role = 'customer';

        $user->save();

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Regenerasi session
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('success', 'Registrasi berhasil. Selamat datang di AMOLE SOFA!');
    }

    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses login admin dan customer
    public function login(Request $request)
    {
        // Normalisasi email
        $request->merge([
            'email' => Str::lower(trim($request->input('email', ''))),
        ]);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Pembatasan percobaan berdasarkan email dan IP
        $key = Str::lower($credentials['email']) . '|' . $request->ip();

        // Maksimal 5 percobaan dalam 1 menit
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.",
            ])->onlyInput('email');
        }

        // Memeriksa email dan password
        if (Auth::attempt($credentials)) {

            // Hapus penghitung percobaan gagal
            RateLimiter::clear($key);

            // Regenerasi session setelah login berhasil
            $request->session()->regenerate();

            $user = Auth::user();

            // Jika login sebagai admin
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Jika login sebagai customer
            return redirect()->intended(route('home'));
        }

        // Catat percobaan login gagal selama 60 detik
        RateLimiter::hit($key, 60);

        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan salah.',
        ])->onlyInput('email');
    }

    // Logout admin dan customer
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus session dan buat token CSRF baru
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Anda berhasil logout.');
    }
}
