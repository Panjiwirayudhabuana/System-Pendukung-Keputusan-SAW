<?php
namespace App\Http\Controllers\Bk;

use App\Http\Controllers\Controller;
use App\Models\{Siswa, Tes, HasilSaw};
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $sudahTes   = Tes::distinct('siswa_id')->count('siswa_id');
        $belumTes   = $totalSiswa - $sudahTes;

        $minatBeda = Tes::whereHas('rekomendasiTeratas', function ($q) {
            $q->whereColumn('hasil_saw.jurusan_id', '!=', 'tes.minat_jurusan_1_id');
        })->distinct('siswa_id')->count('siswa_id');

        $trenTes = Tes::selectRaw('MONTH(created_at) as bulan, YEAR(created_at) as tahun, COUNT(*) as total')
                      ->where('created_at', '>=', now()->subMonths(7))
                      ->groupByRaw('YEAR(created_at), MONTH(created_at)')
                      ->orderBy('tahun')->orderBy('bulan')->get();

        $rekapJurusan = HasilSaw::where('peringkat', 1)
                                ->with('jurusan')
                                ->select('jurusan_id', DB::raw('COUNT(*) as total'))
                                ->groupBy('jurusan_id')->orderByDesc('total')->get();

        $tesTerbaru = Tes::with(['siswa.user', 'minatJurusan1', 'rekomendasiTeratas.jurusan'])
                         ->latest()->take(5)->get();

        return view('pages.bk.dashboard', compact(
            'totalSiswa', 'sudahTes', 'belumTes', 'minatBeda',
            'trenTes', 'rekapJurusan', 'tesTerbaru'
        ));
    }
}