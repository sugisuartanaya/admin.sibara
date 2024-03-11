<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->pegawai->is_admin == 1) {
            // Jika admin, lanjutkan permintaan
            return $next($request);
        }

        // Jika bukan admin, arahkan ke dashboard
        return abort(403, 'Unauthorized access.');
    }
}


