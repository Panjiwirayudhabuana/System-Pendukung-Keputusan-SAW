<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanAdminController extends Controller
{
    public function index()
    {
       $jurusans = Jurusan::withCount(['artikelJurusan', 'prospekKerja'])->orderBy('nama_jurusan')->get();
        return view('pages.admin.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('pages.admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:100|unique:jurusan,nama_jurusan',
            'is_active'    => 'required|boolean',
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
            'is_active'    => $request->is_active,
        ]);

        return redirect()->route('admin.jurusan.index')
                         ->with('success', "Jurusan {$request->nama} berhasil ditambahkan!");
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('pages.admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $request->validate([
            'nama_jurusan'      => 'required|string|max:100|unique:jurusan,nama_jurusan,'.$id,
            'is_active' => 'required|boolean',
        ]);

        $jurusan->update(['nama_jurusan' => $request->nama_jurusan, 'is_active' => $request->is_active]);

        return redirect()->route('admin.jurusan.index')
                         ->with('success', "Jurusan {$jurusan->nama_jurusan} berhasil diperbarui!");
    }

    public function toggleStatus($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update(['is_active' => !$jurusan->is_active]);
        $status = $jurusan->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Jurusan {$jurusan->nama} berhasil {$status}.");
    }
}