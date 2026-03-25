<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil siswa
     */
    public function index()
    {
        $user  = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        if (!$siswa) {
            return redirect()->route('landing.home')
                             ->withErrors('Data siswa tidak ditemukan.');
        }

        return view('pages.siswa.profile', compact('siswa'));
    }

    /**
     * Update data profil (email, no_telepon, sekolah_asal, jenis_kelamin)
     * nama diambil dari users.name
     */
    public function update(Request $request)
    {
        $user  = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->firstOrCreate(
            ['user_id' => $user->id],
            [
                'no_telepon'    => null,
                'sekolah_asal'  => null,
                'jenis_kelamin' => 'L', // sesuaikan bila perlu, atau pastikan data sudah ada sejak registrasi
            ]
        );

        $request->validate([
            'nama'         => 'required|string|max:120',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'no_telepon'   => 'nullable|string|max:30',
            'sekolah_asal' => 'nullable|string|max:150',
        ]);

        // update tabel users
        $user->update([
            'nama'  => $request->nama,
            'email' => $request->email,
        ]);

        // update tabel siswa
        $siswa->update([
            'no_telepon'   => $request->no_telepon,
            'sekolah_asal' => $request->sekolah_asal,
        ]);

        return redirect()->route('siswa.profile')
                        ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Ubah password
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', function ($attr, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password_hash)) {
                    $fail('Password lama tidak sesuai.');
                }
            }],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min'       => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->update([
            'password_hash' => Hash::make($request->password),
        ]);

        return redirect()->route('siswa.profile')
                         ->with('success', 'Password berhasil diubah!');
    }
}