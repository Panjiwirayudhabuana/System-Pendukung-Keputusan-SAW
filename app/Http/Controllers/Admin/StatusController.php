<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Siswa, GuruBk};
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $siswas  = Siswa::with('user')->latest()->paginate(15, ['*'], 'siswa_page');
        $guruBks = GuruBk::with(['user', 'jurusan'])->latest()->paginate(10, ['*'], 'guru_page');
        return view('pages.admin.status.index', compact('siswas', 'guruBks'));
    }

    public function toggleSiswa($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        $siswa->user->update(['is_active' => !$siswa->user->is_active]);
        $status = $siswa->user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Akun siswa {$siswa->user->nama} berhasil {$status}.");
    }

    public function toggleGuru($id)
    {
        $guru = GuruBk::with('user')->findOrFail($id);
        $guru->user->update(['is_active' => !$guru->user->is_active]);
        $status = $guru->user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Akun Guru BK {$guru->user->nama} berhasil {$status}.");
    }
}