<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Siswa, GuruBk, Jurusan, Tes, HasilSaw};
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function index()
    {
        $totalSiswa   = Siswa::count();
        $totalGuruBk  = GuruBk::count();
        $totalJurusan = Jurusan::count();
        $totalTes     = Tes::count();

        $tesPerBulan = Tes::selectRaw('MONTH(created_at) as bulan, YEAR(created_at) as tahun, COUNT(*) as total')
                         ->where('created_at', '>=', now()->subMonths(7))
                         ->groupByRaw('YEAR(created_at), MONTH(created_at)')
                         ->orderBy('tahun')->orderBy('bulan')->get();

        $peminatJurusan = HasilSaw::where('peringkat', 1)
                                  ->with('jurusan')
                                  ->select('jurusan_id', DB::raw('COUNT(*) as total'))
                                  ->groupBy('jurusan_id')->orderByDesc('total')->get();

        $siswaAktif    = Siswa::whereHas('user', fn($q) => $q->where('is_active', true))->count();
        $siswaInaktif  = Siswa::whereHas('user', fn($q) => $q->where('is_active', false))->count();
        $guruBkAktif   = GuruBk::whereHas('user', fn($q) => $q->where('is_active', true))->count();
        $guruBkInaktif = GuruBk::whereHas('user', fn($q) => $q->where('is_active', false))->count();

        $activityLogs = DB::table('activity_log')
                          ->orderByDesc('created_at')->paginate(20);

        return view('pages.admin.monitoring', compact(
            'totalSiswa', 'totalGuruBk', 'totalJurusan', 'totalTes',
            'tesPerBulan', 'peminatJurusan',
            'siswaAktif', 'siswaInaktif', 'guruBkAktif', 'guruBkInaktif',
            'activityLogs'
        ));
    }
}
