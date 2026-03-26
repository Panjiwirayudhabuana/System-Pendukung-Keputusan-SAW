<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kriteria;
use App\Models\JurusanKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanAdminController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::withCount(['artikelJurusan', 'prospekKerja'])
            ->orderBy('nama_jurusan')
            ->get();

        return view('pages.admin.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        $kriterias = Kriteria::where('is_active', true)
            ->orderBy('kode_kriteria')
            ->get();

        $bobotMap = [];

        return view('pages.admin.jurusan.create', compact('kriterias', 'bobotMap'));
    }

    public function store(Request $request)
    {
        $kriterias = Kriteria::where('is_active', true)
            ->orderBy('kode_kriteria')
            ->get();

        $rules = [
            'nama_jurusan' => 'required|string|max:100|unique:jurusan,nama_jurusan',
            'is_active'    => 'required|boolean',
            'bobot'        => 'required|array',
        ];

        foreach ($kriterias as $kriteria) {
            $rules["bobot.{$kriteria->id}"] = 'required|numeric|min:0|max:1';
        }

        $request->validate($rules);

        if ((int) $request->is_active === 1 && !$this->isBobotValid($request->bobot)) {
            return back()
                ->withErrors([
                    'bobot' => 'Jurusan tidak dapat dibuat aktif karena bobot kriteria belum lengkap atau total bobot tidak sama dengan 1.00.'
                ])
                ->withInput();
        }

        DB::transaction(function () use ($request, $kriterias) {
            $jurusan = Jurusan::create([
                'nama_jurusan' => $request->nama_jurusan,
                'is_active'    => $request->is_active,
            ]);

            $insertData = [];

            foreach ($kriterias as $kriteria) {
                $insertData[] = [
                    'jurusan_id'  => $jurusan->id,
                    'kriteria_id' => $kriteria->id,
                    'bobot'       => (float) ($request->bobot[$kriteria->id] ?? 0),
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }

            if (!empty($insertData)) {
                JurusanKriteria::upsert(
                    $insertData,
                    ['jurusan_id', 'kriteria_id'],
                    ['bobot', 'updated_at']
                );
            }
        });

        return redirect()->route('admin.jurusan.index')
            ->with('success', "Jurusan {$request->nama_jurusan} berhasil ditambahkan!");
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $kriterias = Kriteria::where('is_active', true)
            ->orderBy('kode_kriteria')
            ->get();

        $bobotMap = JurusanKriteria::where('jurusan_id', $jurusan->id)
            ->pluck('bobot', 'kriteria_id')
            ->toArray();

        return view('pages.admin.jurusan.create', compact('jurusan', 'kriterias', 'bobotMap'));
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $kriterias = Kriteria::where('is_active', true)
            ->orderBy('kode_kriteria')
            ->get();

        $rules = [
            'nama_jurusan' => 'required|string|max:100|unique:jurusan,nama_jurusan,' . $id,
            'is_active'    => 'required|boolean',
            'bobot'        => 'required|array',
        ];

        foreach ($kriterias as $kriteria) {
            $rules["bobot.{$kriteria->id}"] = 'required|numeric|min:0|max:1';
        }

        $request->validate($rules);

        if ((int) $request->is_active === 1 && !$this->isBobotValid($request->bobot)) {
            return back()
                ->withErrors([
                    'bobot' => 'Jurusan tidak dapat dibuat aktif karena bobot kriteria belum lengkap atau total bobot tidak sama dengan 1.00.'
                ])
                ->withInput();
        }

        DB::transaction(function () use ($request, $jurusan, $kriterias) {
            $jurusan->update([
                'nama_jurusan' => $request->nama_jurusan,
                'is_active'    => $request->is_active,
            ]);

            $updateData = [];

            foreach ($kriterias as $kriteria) {
                $updateData[] = [
                    'jurusan_id'  => $jurusan->id,
                    'kriteria_id' => $kriteria->id,
                    'bobot'       => (float) ($request->bobot[$kriteria->id] ?? 0),
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }

            if (!empty($updateData)) {
                JurusanKriteria::upsert(
                    $updateData,
                    ['jurusan_id', 'kriteria_id'],
                    ['bobot', 'updated_at']
                );
            }
        });

        return redirect()->route('admin.jurusan.index')
            ->with('success', "Jurusan {$jurusan->nama_jurusan} berhasil diperbarui!");
    }

    public function toggleStatus($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        // Jika jurusan sedang nonaktif dan akan diaktifkan,
        // maka bobot harus valid terlebih dahulu.
        if (!$jurusan->is_active) {
            $bobot = JurusanKriteria::where('jurusan_id', $jurusan->id)
                ->pluck('bobot')
                ->toArray();

            if (!$this->isBobotValid($bobot)) {
                return redirect()->back()
                    ->withErrors([
                        'error' => 'Jurusan tidak dapat diaktifkan karena bobot kriteria belum lengkap atau total bobot tidak sama dengan 1.00.'
                    ]);
            }
        }

        $jurusan->update([
            'is_active' => !$jurusan->is_active
        ]);

        $status = $jurusan->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Jurusan {$jurusan->nama_jurusan} berhasil {$status}.");
    }

    /**
     * Validasi bobot:
     * - semua bobot harus > 0
     * - total bobot harus = 1.00
     */
    private function isBobotValid(array $bobot): bool
    {
        if (empty($bobot)) {
            return false;
        }

        foreach ($bobot as $nilai) {
            if (!is_numeric($nilai) || (float) $nilai <= 0) {
                return false;
            }
        }

        $total = collect($bobot)->sum(fn($v) => (float) $v);

        return abs($total - 1) <= 0.001;
    }
}