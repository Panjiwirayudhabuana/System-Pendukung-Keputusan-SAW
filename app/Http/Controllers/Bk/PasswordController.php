<?php

namespace App\Http\Controllers\Bk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        return view('pages.bk.password');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user->loadMissing(['role', 'guruBk']);

        $request->validate([
            'current_password' => [
                'required',
                function ($attr, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password_hash)) {
                        $fail('Password lama tidak sesuai.');
                    }
                }
            ],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->update([
            'password_hash' => Hash::make($request->password),
            'must_change_password' => false,
        ]);

        // Cek lagi apakah profil Guru BK masih belum lengkap
        if ($user->isGuruBkProfileIncomplete()) {
            return redirect()
                ->route('bk.profil')
                ->with('success', 'Password berhasil diubah. Silakan lengkapi profil Guru BK.');
        }

        return redirect()
            ->route('bk.dashboard')
            ->with('success', 'Password berhasil diubah!');
    }
}