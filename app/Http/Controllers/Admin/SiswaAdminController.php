<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaAdminController extends Controller
{
    public function index()
    {
        $query = Siswa::with('user');
        if (request('search')) {
            $query->whereHas('user', fn($q) => $q->where('nama', 'like', '%'.request('search').'%')
                                                   ->orWhere('email', 'like', '%'.request('search').'%'));
        }
        $siswas = $query->latest()->paginate(15);
        return view('pages.admin.siswa.index', compact('siswas'));
    }

    public function edit($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        return view('pages.admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);

        $request->validate([
            'nama'         => 'required|string|max:120',
            'email'        => 'required|email|unique:users,email,'.$siswa->user_id,
            'no_telepon'   => 'nullable|string|max:20',
            'alamat'       => 'nullable|string',
            'sekolah_asal' => 'nullable|string|max:120',
            'password'     => 'nullable|string|min:8',
        ]);

        $siswa->user->update([
            'nama'  => $request->nama,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $siswa->user->update(['password_hash' => Hash::make($request->password)]);
        }

        $siswa->update([
            'no_telepon'   => $request->no_telepon,
            'alamat'       => $request->alamat,
            'sekolah_asal' => $request->sekolah_asal,
        ]);

        return redirect()->route('admin.siswa.index')
                         ->with('success', "Data siswa {$request->nama} berhasil diperbarui!");
    }

    public function toggleStatus($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        $siswa->user->update(['is_active' => !$siswa->user->is_active]);
        $status = $siswa->user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Akun siswa berhasil {$status}.");
    }
}