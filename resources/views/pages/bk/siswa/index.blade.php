@extends('layouts.bk')
@section('title','Data Siswa')
@section('page-title','Data Siswa')
@section('page-sub','FR-BK-05 · Lihat hasil rekomendasi siswa')

@section('content')
<div class="alert alert-info">ℹ️ Data bersifat <strong>read-only</strong>. Guru BK hanya dapat melihat hasil rekomendasi siswa.</div>

<div class="card">
    <div class="card-head">
        <div class="card-title">Daftar Siswa</div>
        <form method="GET" style="display:flex;gap:8px;">
            <input name="search" class="form-control" style="width:220px;padding:7px 12px;" placeholder="🔍 Cari nama siswa..." value="{{ request('search') }}"/>
            <button class="btn btn-primary btn-sm">Cari</button>
            @if(request('search'))
                <a href="{{ route('bk.siswa.index') }}" class="btn btn-outline btn-sm">Reset</a>
            @endif
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th><th>Sekolah Asal</th><th>Rekomendasi SAW</th>
                <th>Minat 1</th><th>Minat 2</th><th>Sesuai?</th><th>Jml Tes</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswas as $siswa)
            @php
                $lastTes = $siswa->tes->first();
                $rek     = $lastTes?->rekomendasiTeratas?->jurusan?->nama_jurusan;
                $m1      = $lastTes?->minatJurusan1?->nama_jurusan;
                $m2      = $lastTes?->minatJurusan2?->nama_jurusan;
                $sesuai  = $lastTes
                    && $lastTes->rekomendasiTeratas
                    && $lastTes->rekomendasiTeratas->jurusan_id === $lastTes->minat_jurusan_1_id;
            @endphp
            <tr>
                <td style="font-weight:700;color:var(--primary-dark);">{{ $siswa->user->nama ?? '-' }}</td>
                <td style="font-size:11.5px;color:var(--text-dim);">{{ $siswa->sekolah_asal ?? '-' }}</td>
                <td>
                    @if($rek)
                        <span class="badge badge-blue">{{ $rek }}</span>
                    @else
                        <span class="badge badge-gray">Belum tes</span>
                    @endif
                </td>
                <td><span class="badge badge-gray">{{ $m1 ?? '-' }}</span></td>
                <td><span class="badge badge-gray">{{ $m2 ?? '-' }}</span></td>
                <td>
                    @if($lastTes && $lastTes->rekomendasiTeratas)
                        <span class="badge {{ $sesuai ? 'badge-green':'badge-red' }}">
                            {{ $sesuai ? '✅ Sesuai':'⚠ Berbeda' }}
                        </span>
                    @else
                        —
                    @endif
                </td>
                <td style="text-align:center;font-weight:700;">{{ $siswa->tes->count() }}</td>
                <td><a href="{{ route('bk.siswa.show', $siswa->id) }}" class="btn btn-outline btn-sm">Detail</a></td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center;color:var(--text-dim);padding:24px;">Tidak ada data siswa.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding:14px 20px;border-top:1px solid var(--border);">{{ $siswas->links() }}</div>
</div>
@endsection
