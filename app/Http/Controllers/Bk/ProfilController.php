<?php

namespace App\Http\Controllers\Bk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user->loadMissing(['guruBk.jurusan']);

        $guruBk = $user->guruBk;

        return view('pages.bk.profil', compact('user', 'guruBk'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'nama' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nip' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'nip.required' => 'NIP wajib diisi.',
        ]);

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        $user->loadMissing('guruBk');

        if (!$user->guruBk) {
            $user->guruBk()->create([
                'nip' => $request->nip,
            ]);
        } else {
            $user->guruBk->update([
                'nip' => $request->nip,
            ]);
        }

        $user->refresh();
        $user->loadMissing(['role', 'guruBk']);

        if ($user->must_change_password) {
            return redirect()
                ->route('bk.password.index')
                ->with('success', 'Profil berhasil diperbarui. Silakan ganti password terlebih dahulu.');
        }

        return redirect()
            ->route('bk.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}