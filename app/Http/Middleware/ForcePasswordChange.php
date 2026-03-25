<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForcePasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return $next($request);
        }

        $user->loadMissing(['role', 'guruBk']);

        // Kalau bukan Guru BK, biarkan lewat
        if (!$user->isGuruBk()) {
            return $next($request);
        }

        // Route yang tetap boleh diakses walaupun onboarding belum selesai
        if (
            $request->routeIs('bk.password.*') ||
            $request->routeIs('bk.profil') ||
            $request->routeIs('bk.profil.update') ||
            $request->routeIs('logout')
        ) {
            return $next($request);
        }

        // Kalau profil belum lengkap, arahkan ke halaman profil
        if ($user->isGuruBkProfileIncomplete()) {
            return redirect()
                ->route('bk.profil')
                ->with('warning', 'Lengkapi data Guru BK terlebih dahulu.');
        }

        // Kalau password masih wajib diganti, arahkan ke halaman ubah password
        if ($user->must_change_password) {
            return redirect()
                ->route('bk.password.index')
                ->with('warning', 'Anda wajib mengganti password terlebih dahulu.');
        }

        return $next($request);
    }
}