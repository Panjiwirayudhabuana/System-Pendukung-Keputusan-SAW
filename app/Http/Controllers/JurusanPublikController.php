<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\ArtikelJurusan;

class JurusanPublikController extends Controller
{
    public function show($id)
    {
        $jurusan = Jurusan::with([
            'informasiJurusan',
            'prospekKerja',
        ])->where('is_active', true)->findOrFail($id);

        $artikels = ArtikelJurusan::with(['gambarUpload', 'fileUpload'])
            ->where('jurusan_id', $id)
            ->latest()
            ->take(6)
            ->get();

        $prospekUmum   = $jurusan->prospekKerja->where('tipe', 'umum')->values();
        $prospekAlumni = $jurusan->prospekKerja->where('tipe', 'alumni')->values();
        $info          = $jurusan->informasiJurusan;

        return view('landingpage.jurusan-detail', compact(
            'jurusan', 'artikels', 'prospekUmum', 'prospekAlumni', 'info'
        ));
    }
}