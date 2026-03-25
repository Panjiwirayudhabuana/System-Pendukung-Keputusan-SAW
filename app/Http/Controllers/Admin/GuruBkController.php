<?php
// ============================================================
// FILE 1: app/Http/Controllers/Admin/GuruBkController.php
// FR-A-02, FR-A-03, FR-A-04, FR-A-05
// ============================================================
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GuruBk;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruBkController extends Controller
{
    public function index()
    {
        $guruBks = GuruBk::with(['user', 'jurusan'])->latest()->paginate(15);
        return view('pages.admin.gurubk.index', compact('guruBks'));
    }

    public function create()
    {
        $jurusans = Jurusan::where('is_active', true)->orderBy('nama_jurusan')->get();
        return view('pages.admin.gurubk.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:120',
            'email'       => 'required|email|unique:users,email',
            'nip'         => 'required|string|max:30',
            'jurusan_id'  => 'nullable|exists:jurusan,id',
        ]);

        $roleId = \App\Models\Role::where('nama_role', 'guru_bk')->value('id');

        $user = User::create([
            'role_id'              => $roleId,
            'nama'                 => $request->nama,
            'email'                => $request->email,
            'password_hash'        => Hash::make('password123'), // default
            'is_active'            => true,
            'must_change_password' => true,
        ]);

        GuruBk::create([
            'user_id'    => $user->id,
            'nip'        => $request->nip,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->route('admin.gurubk.index')
                         ->with('success', "Akun Guru BK {$request->nama} berhasil dibuat! Password default: password123");
    }

    public function edit($id)
    {
        $guruBk   = GuruBk::with(['user', 'jurusan'])->findOrFail($id);
        $jurusans = Jurusan::where('is_active', true)->orderBy('nama_jurusan')->get();
        return view('pages.admin.gurubk.edit', compact('guruBk', 'jurusans'));
    }

    public function update(Request $request, $id)
    {
        $guruBk = GuruBk::with('user')->findOrFail($id);

        $request->validate([
            'nama'       => 'required|string|max:120',
            'email'      => 'required|email|unique:users,email,'.$guruBk->user_id,
            'nip'        => 'required|string|max:30',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'password'   => 'nullable|string|min:8',
        ]);

        $guruBk->user->update([
            'nama'  => $request->nama,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $guruBk->user->update([
                'password_hash'        => Hash::make($request->password),
                'must_change_password' => true,
            ]);
        }

        $guruBk->update([
            'nip'        => $request->nip,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->route('admin.gurubk.index')
                         ->with('success', "Data Guru BK {$request->nama} berhasil diperbarui!");
    }

    public function toggleStatus($id)
    {
        $guruBk = GuruBk::with('user')->findOrFail($id);
        $guruBk->user->update(['is_active' => !$guruBk->user->is_active]);
        $status = $guruBk->user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Akun Guru BK berhasil {$status}.");
    }
}