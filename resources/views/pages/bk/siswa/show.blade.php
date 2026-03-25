@extends('layouts.bk')
@section('title','Detail Siswa')
@section('page-title','Detail Siswa')
@section('page-sub','FR-BK-05 · Riwayat tes & perbandingan minat vs rekomendasi')

@section('content')

<div style="margin-bottom:16px;">
    <a href="{{ route('bk.siswa.index') }}" class="btn btn-outline btn-sm">← Kembali</a>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">

    {{-- ═══ INFO SISWA ═══ --}}
    <div class="card" style="padding:24px;">
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:18px;">
            <div style="width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,#1a3c6e,#2563eb);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:20px;color:#fff;flex-shrink:0;">
                {{ strtoupper(substr($siswa->user->nama ?? 'S', 0, 1)) }}
            </div>
            <div>
                <div style="font-family:'Syne',sans-serif;font-size:16px;font-weight:800;color:var(--primary-dark);">
                    {{ $siswa->user->nama ?? '-' }}
                </div>
                <div style="font-size:11.5px;color:var(--text-dim);">{{ $siswa->sekolah_asal ?? 'Sekolah asal tidak diisi' }}</div>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <div>
                <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-dim);margin-bottom:3px;">EMAIL</div>
                <div style="font-size:12.5px;color:var(--text);">{{ $siswa->user->email ?? '-' }}</div>
            </div>
            <div>
                <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-dim);margin-bottom:3px;">TELEPON</div>
                <div style="font-size:12.5px;color:var(--text);">{{ $siswa->no_telepon ?? '-' }}</div>
            </div>
            <div>
                <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-dim);margin-bottom:3px;">GENDER</div>
                <div style="font-size:12.5px;color:var(--text);">
                    @if($siswa->jenis_kelamin === 'L') 👦 Laki-laki
                    @elseif($siswa->jenis_kelamin === 'P') 👧 Perempuan
                    @else -
                    @endif
                </div>
            </div>
            <div>
                <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-dim);margin-bottom:3px;">JUMLAH TES</div>
                <div style="font-size:12.5px;font-weight:700;color:var(--text);">{{ $riwayatTes->count() }} kali</div>
            </div>
        </div>
    </div>

    {{-- ═══ MINAT VS REKOMENDASI ═══ --}}
    <div class="card" style="padding:24px;">
        <div style="font-family:'Syne',sans-serif;font-size:13.5px;font-weight:800;color:var(--primary-dark);margin-bottom:14px;">
            🎯 Minat vs Rekomendasi
        </div>

        @php $lastTes = $riwayatTes->first(); @endphp

        @if($lastTes)
            @php
                $rek = $lastTes->rekomendasiTeratas?->jurusan?->nama_jurusan ?? '-';
                $m1  = $lastTes->minatJurusan1?->nama_jurusan ?? '-';
                $m2  = $lastTes->minatJurusan2?->nama_jurusan ?? '-';
                $sesuai1 = $lastTes->rekomendasiTeratas && $lastTes->rekomendasiTeratas->jurusan_id === $lastTes->minat_jurusan_1_id;
                $sesuai2 = $lastTes->rekomendasiTeratas && $lastTes->rekomendasiTeratas->jurusan_id === $lastTes->minat_jurusan_2_id;
            @endphp

            <div style="display:flex;align-items:center;gap:10px;padding:10px 14px;background:var(--surface2);border-radius:9px;margin-bottom:8px;">
                <div style="flex:1;font-size:12px;">
                    <div style="font-size:10px;color:var(--text-dim);margin-bottom:2px;">Minat Pertama</div>
                    <strong>{{ $m1 }}</strong>
                </div>
                <div style="color:var(--text-dim);">→</div>
                <div style="flex:1;font-size:12px;">
                    <div style="font-size:10px;color:var(--text-dim);margin-bottom:2px;">Rekomendasi SAW</div>
                    <strong>{{ $rek }}</strong>
                </div>
                <span class="badge {{ $sesuai1 ? 'badge-green' : 'badge-red' }}">
                    {{ $sesuai1 ? '✅ Sesuai' : 'Beda' }}
                </span>
            </div>

            <div style="display:flex;align-items:center;gap:10px;padding:10px 14px;background:var(--surface2);border-radius:9px;margin-bottom:12px;">
                <div style="flex:1;font-size:12px;">
                    <div style="font-size:10px;color:var(--text-dim);margin-bottom:2px;">Minat Kedua</div>
                    <strong>{{ $m2 }}</strong>
                </div>
                <div style="color:var(--text-dim);">→</div>
                <div style="flex:1;font-size:12px;">
                    <div style="font-size:10px;color:var(--text-dim);margin-bottom:2px;">Rekomendasi SAW</div>
                    <strong>{{ $rek }}</strong>
                </div>
                <span class="badge {{ $sesuai2 ? 'badge-green' : 'badge-red' }}">
                    {{ $sesuai2 ? '✅ Sesuai' : 'Beda' }}
                </span>
            </div>

            <div style="background:var(--yellow-bg);border:1px solid var(--yellow-border);border-radius:9px;padding:10px 14px;font-size:11.5px;color:var(--yellow);">
                💡 Minat awal tidak mempengaruhi SAW, hanya referensi konseling.
            </div>
        @else
            <div style="text-align:center;padding:24px;color:var(--text-dim);font-size:13px;">
                Siswa belum mengerjakan tes.
            </div>
        @endif
    </div>

</div>

{{-- ═══ RIWAYAT TES ═══ --}}
<div class="card">
    <div class="card-head">
        <div class="card-title">📋 Riwayat Tes ({{ $riwayatTes->count() }} kali)</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Rekomendasi</th>
                <th>Minat 1</th>
                <th>Minat 2</th>
                <th>Skor Minat</th>
                <th>Buta Warna</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayatTes as $i => $tes)
            @php
                $rekTes = $tes->rekomendasiTeratas?->jurusan?->nama_jurusan ?? '-';
                $m1Tes  = $tes->minatJurusan1?->nama_jurusan ?? '-';
                $m2Tes  = $tes->minatJurusan2?->nama_jurusan ?? '-';
            @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td style="font-size:12px;">{{ $tes->created_at->format('d M Y H:i') }}</td>
                <td>
                    @if($rekTes !== '-')
                        <span class="badge badge-blue">{{ $rekTes }}</span>
                    @else
                        <span class="badge badge-gray">-</span>
                    @endif
                </td>
                <td><span class="badge badge-gray">{{ $m1Tes }}</span></td>
                <td><span class="badge badge-gray">{{ $m2Tes }}</span></td>
                <td>{{ $tes->skor_minat_bakat ?? '-' }}/10</td>
                <td>{{ $tes->buta_warna ? 'Ya' : 'Tidak' }}</td>
              <td>
            <div style="display:flex;gap:6px;">
                <a href="{{ route('bk.siswa.hasil', [$siswa->id, $tes->id]) }}"
                target="_blank"
                class="btn btn-outline btn-sm">
                📊 Lihat Hasil
        </a>
            <a href="{{ route('bk.siswa.pdf', [$siswa->id, $tes->id]) }}"
                class="btn btn-primary btn-sm"
                style="text-decoration:none;">
                 📄 Download PDF
             </a>
    </div>
</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align:center;color:var(--text-dim);padding:24px;">
                    Siswa belum mengerjakan tes.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection