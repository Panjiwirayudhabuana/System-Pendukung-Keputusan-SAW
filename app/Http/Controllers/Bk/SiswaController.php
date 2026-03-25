<?php
namespace App\Http\Controllers\Bk;

use App\Http\Controllers\Controller;
use App\Models\{Siswa, Tes};

class SiswaController extends Controller
{
    public function index()
    {
        $query = Siswa::with([
            'user',
            'tes' => fn($q) => $q->latest()->with('rekomendasiTeratas.jurusan', 'minatJurusan1', 'minatJurusan2'),
        ]);

        if (request('search')) {
            $query->whereHas('user', fn($q) => $q->where('nama', 'like', '%'.request('search').'%'));
        }

        $siswas = $query->paginate(15);
        return view('pages.bk.siswa.index', compact('siswas'));
    }

    public function show($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);

        $riwayatTes = Tes::where('siswa_id', $id)
            ->with([
                'rekomendasiTeratas.jurusan',
                'minatJurusan1', 'minatJurusan2',
                'hasilSaw' => fn($q) => $q->orderBy('peringkat')->with('jurusan'),
            ])->latest()->get();

        return view('pages.bk.siswa.show', compact('siswa', 'riwayatTes'));
    }

    public function downloadPdf($siswaId, $tesId)
{
    $tes = \App\Models\Tes::where('siswa_id', $siswaId)->findOrFail($tesId);

    $tesPdf = \App\Models\TesPdf::with('upload')
                ->where('tes_id', $tesId)->first();

    if ($tesPdf && $tesPdf->upload && \Storage::disk('public')->exists($tesPdf->upload->storage_path)) {
        return \Storage::disk('public')->download(
            $tesPdf->upload->storage_path,
            'hasil_tes_' . $tesId . '.pdf'
        );
    }

    return back()->with('warning', 'File PDF belum tersedia untuk tes ini.');
}

public function hasilTes($siswaId, $tesId)
{
    $tes = \App\Models\Tes::with([
        'siswa.user',
        'hasilSaw' => fn($q) => $q->orderBy('peringkat')->with('jurusan'),
        'minatJurusan1', 'minatJurusan2',
    ])->where('siswa_id', $siswaId)->findOrFail($tesId);

    $hasilList      = $tes->hasilSaw;
    $tesTerakhir    = $tes;
    $siswa          = $tes->siswa;

    $jurusanPilihan1 = $tes->minatJurusan1;
    $jurusanPilihan2 = $tes->minatJurusan2;
    $skorPilihan1    = $hasilList->firstWhere('jurusan_id', $tes->minat_jurusan_1_id);
    $skorPilihan2    = $hasilList->firstWhere('jurusan_id', $tes->minat_jurusan_2_id);

    return view('pages.siswa.hasil', compact(
        'hasilList', 'tesTerakhir', 'siswa',
        'jurusanPilihan1', 'jurusanPilihan2',
        'skorPilihan1', 'skorPilihan2'
    ));
}
}