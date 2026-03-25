<?php

namespace App\Http\Controllers;

use App\Models\ArtikelJurusan;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class ArtikelPublikController extends Controller
{
    /**
     * Halaman daftar semua artikel (publik, tanpa login)
     * Route: GET /artikel  →  route('artikel.index')
     */
    public function index(Request $request)
    {
        $query = ArtikelJurusan::with(['jurusan', 'creator'])
            ->whereHas('jurusan', fn($q) => $q->where('is_active', true));

        // Filter jurusan
        if ($request->filled('jurusan')) {
            $query->where('jurusan_id', $request->jurusan);
        }

        // Search judul / deskripsi
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('judul', 'like', "%$s%")
                  ->orWhere('deskripsi', 'like', "%$s%");
            });
        }

        $artikels  = $query->latest()->paginate(9)->withQueryString();
        $jurusans  = Jurusan::where('is_active', true)->orderBy('nama_jurusan')->get();

        return view('pages.artikel.index', compact('artikels', 'jurusans'));
    }

    /**
     * Detail satu artikel
     * Route: GET /artikel/{id}  →  route('artikel.show', $id)
     */
    public function show($id)
    {
        $artikel = ArtikelJurusan::with(['jurusan', 'creator', 'gambarUpload', 'fileUpload'])
            ->findOrFail($id);

        // Artikel terkait (jurusan sama, bukan artikel ini)
        $terkait = ArtikelJurusan::with(['jurusan', 'gambarUpload'])
            ->where('jurusan_id', $artikel->jurusan_id)
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.artikel.show', compact('artikel', 'terkait'));
    }
}