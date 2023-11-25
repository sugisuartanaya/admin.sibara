<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user()->pegawai;
        // Pemeriksaan is_admin
        if ($user && $user->is_admin) {
            return $next($request);
        }

        // Jika admin tidak sesuai, redirect atau tanggapi sesuai kebijakan Anda
        return redirect('/dashboard'); 
    }
}
