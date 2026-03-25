<?php
namespace App\Http\Controllers\Bk;

use App\Http\Controllers\Controller;
use App\Models\{Tes, HasilSaw};
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        $peminatJurusan = HasilSaw::where('peringkat', 1)
            ->with('jurusan')
            ->select('jurusan_id', DB::raw('COUNT(*) as total'))
            ->groupBy('jurusan_id')->orderByDesc('total')->get();

     $kesesuaian = DB::table('tes')
    ->join('hasil_saw', function ($j) {
        $j->on('hasil_saw.tes_id', '=', 'tes.id')
          ->where('hasil_saw.peringkat', 1);
    })
    ->join('jurusan', 'jurusan.id', '=', 'hasil_saw.jurusan_id')
    ->select(
        'jurusan.nama_jurusan as nama_jurusan',
        DB::raw('SUM(CASE WHEN tes.minat_jurusan_1_id = hasil_saw.jurusan_id THEN 1 ELSE 0 END) as sesuai'),
        DB::raw('SUM(CASE WHEN tes.minat_jurusan_1_id != hasil_saw.jurusan_id THEN 1 ELSE 0 END) as berbeda')
    )
    ->groupBy('jurusan.id', 'jurusan.nama_jurusan')
    ->orderByDesc('sesuai')
    ->get();

        $tren = Tes::selectRaw('MONTH(created_at) as bulan, YEAR(created_at) as tahun, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(7))
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderBy('tahun')->orderBy('bulan')->get();

        return view('pages.bk.statistik', compact('peminatJurusan', 'kesesuaian', 'tren'));
    }
}