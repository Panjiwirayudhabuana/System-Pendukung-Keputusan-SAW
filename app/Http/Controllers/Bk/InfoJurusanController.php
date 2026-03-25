<?php

namespace App\Http\Controllers\Bk;

use App\Http\Controllers\Controller;
use App\Models\{InformasiJurusan, ProspekKerja, Jurusan};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoJurusanController extends Controller
{
    public function index()
    {
        $guruBk = \App\Models\GuruBk::where('user_id', Auth::id())->first();

        if ($guruBk && $guruBk->jurusan_id) {
            return redirect()->route('bk.infojurusan.show', $guruBk->jurusan_id);
        }

        return redirect()->route('bk.dashboard')
            ->with('warning', 'Anda belum ditugaskan ke jurusan manapun.');
    }

    public function show($id)
    {
        $guruBk = \App\Models\GuruBk::where('user_id', Auth::id())->first();

        if ($guruBk && $guruBk->jurusan_id && $guruBk->jurusan_id != $id) {
            return redirect()->route('bk.dashboard')
                ->with('warning', 'Akses ditolak.');
        }

        $jurusan       = Jurusan::with(['informasiJurusan', 'prospekKerja'])->findOrFail($id);
        $info          = $jurusan->informasiJurusan;
        $prospekUmum   = $jurusan->prospekKerja->where('tipe', 'umum');
        $prospekAlumni = $jurusan->prospekKerja->where('tipe', 'alumni');

        return view('pages.bk.infojurusan.show', compact(
            'jurusan', 'info', 'prospekUmum', 'prospekAlumni'
        ));
    }

   public function edit($id)
    {
        $guruBk = \App\Models\GuruBk::where('user_id', Auth::id())->first();

        // Pastikan BK hanya bisa edit jurusannya sendiri
        if ($guruBk && $guruBk->jurusan_id && $guruBk->jurusan_id != $id) {
            return redirect()->route('bk.infojurusan.index')
                ->with('warning', 'Anda hanya bisa mengelola jurusan Anda sendiri.');
        }

        $jurusan = Jurusan::with(['informasiJurusan', 'prospekKerja'])->findOrFail($id);
        $info          = $jurusan->informasiJurusan;
        $prospekUmum   = $jurusan->prospekKerja->where('tipe', 'umum')->pluck('isi');
        $prospekAlumni = $jurusan->prospekKerja->where('tipe', 'alumni')->pluck('isi');

        return view('pages.bk.infojurusan.edit', compact(
            'jurusan', 'info', 'prospekUmum', 'prospekAlumni'
        ));
    }

    public function update(Request $request, $jurusanId)
    {
        $guruBk = \App\Models\GuruBk::where('user_id', Auth::id())->first();
        if ($guruBk && $guruBk->jurusan_id && $guruBk->jurusan_id != $jurusanId) {
            return redirect()->route('bk.infojurusan.index')
                ->with('warning', 'Anda hanya bisa mengelola jurusan Anda sendiri.');
        }

        $jurusan = Jurusan::findOrFail($jurusanId);

        InformasiJurusan::updateOrCreate(
            ['jurusan_id' => $jurusanId],
            [
                'fasilitas' => $request->fasilitas,
                'updated_by_user_id' => Auth::id()
            ]
        );

        ProspekKerja::where('jurusan_id', $jurusanId)
            ->where('tipe', 'umum')
            ->delete();

        foreach (array_filter($request->prospek_umum ?? []) as $isi) {
            ProspekKerja::create([
                'jurusan_id' => $jurusanId,
                'tipe' => 'umum',
                'isi' => $isi
            ]);
        }

        ProspekKerja::where('jurusan_id', $jurusanId)
            ->where('tipe', 'alumni')
            ->delete();

        foreach (array_filter($request->prospek_alumni ?? []) as $isi) {
            ProspekKerja::create([
                'jurusan_id' => $jurusanId,
                'tipe' => 'alumni',
                'isi' => $isi
            ]);
        }

    return redirect()->route('bk.infojurusan.show', $jurusanId)
        ->with('success', "Informasi jurusan berhasil diperbarui!");
    }
}