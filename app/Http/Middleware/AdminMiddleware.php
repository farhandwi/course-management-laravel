<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah pengguna sudah login dan memiliki peran 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika pengguna bukan admin, redirect ke halaman home atau halaman lain yang sesuai
        return redirect('/')->with('error', 'You do not have admin access');
    }
}
