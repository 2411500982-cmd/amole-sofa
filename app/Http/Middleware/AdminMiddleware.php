<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Periksa apakah pengguna memiliki role admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman admin.');
        }

        // Lanjutkan jika pengguna adalah admin
        return $next($request);
    }
}
