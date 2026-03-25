@extends('layouts.bk')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('page-sub','Selamat datang, pantau perkembangan siswa')
@push('styles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
@endpush

@section('content')
@php
    $bulanLabel = $trenTes->map(fn($t) => \Carbon\Carbon::create($t->tahun, $t->bulan)->translatedFormat('M'));
    $bulanData  = $trenTes->pluck('total');
    $maxRekap   = $rekapJurusan->max('total') ?: 1;
@endphp

<div style="background:linear-gradient(135deg,#0f2548 0%,#1a3c6e 60%,#2a5298 100%);border-radius:12px;padding:24px 28px;margin-bottom:22px;color:#fff;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-40px;right:-40px;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,.04);"></div>
    <div style="display:inline-flex;align-items:center;gap:6px;background:rgba(232,160,32,.2);border:1px solid rgba(232,160,32,.4);color:#f5c55a;font-size:11px;font-weight:700;padding:4px 12px;border-radius:100px;margin-bottom:10px;">👩‍🏫 Guru Bimbingan Konseling</div>
    {{-- Gunakan Auth::user()->nama --}}
    <div style="font-family:'Playfair Display',serif;font-size:20px;font-weight:700;margin-bottom:4px;">Selamat Datang, {{ Auth::user()->nama }}!</div>
    <div style="font-size:13px;color:rgba(255,255,255,.7);">Pantau perkembangan siswa dan kelola konten jurusan dari sini.</div>
</div>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:22px;">
    @foreach([
        ['🎓',$totalSiswa,'Total Siswa','Terdaftar di sistem','#2563eb'],
        ['✅',$sudahTes,'Sudah Tes','Sudah mengerjakan','#16a34a'],
        ['⏳',$belumTes,'Belum Tes','Perlu tindak lanjut','#d97706'],
        ['⚠️',$minatBeda,'Minat ≠ Hasil','Perlu konseling','#dc2626'],
    ] as [$icon,$num,$label,$sub,$color])
    <div class="card" style="padding:18px 20px;position:relative;overflow:hidden;">
        <div style="position:absolute;bottom:0;left:0;right:0;height:3px;background:{{ $color }};opacity:.8;"></div>
        <div style="font-size:22px;margin-bottom:12px;">{{ $icon }}</div>
        <div style="font-family:'Playfair Display',serif;font-size:28px;font-weight:800;color:var(--primary-dark);line-height:1;">{{ $num }}</div>
        <div style="font-size:12px;font-weight:700;color:var(--text-mid);margin-top:4px;">{{ $label }}</div>
        <div style="font-size:11px;color:var(--text-dim);margin-top:3px;">{{ $sub }}</div>
    </div>
    @endforeach
</div>

<div style="display:grid;grid-template-columns:1.5fr 1fr;gap:16px;margin-bottom:22px;">
    <div class="card" style="padding:20px;">
        <div style="font-size:13.5px;font-weight:700;color:var(--primary-dark);margin-bottom:4px;">📈 Tren Tes Siswa</div>
        <div style="font-size:11px;color:var(--text-dim);margin-bottom:16px;">7 bulan terakhir</div>
        <canvas id="trendChart"></canvas>
    </div>
    <div class="card" style="padding:20px;">
        <div style="font-size:13.5px;font-weight:700;color:var(--primary-dark);margin-bottom:14px;">🏆 Rekap Peminat Jurusan</div>
        <div style="display:flex;flex-direction:column;gap:11px;">
            @foreach($rekapJurusan as $r)
            <div>
                <div style="display:flex;justify-content:space-between;font-size:12px;font-weight:700;color:var(--primary-dark);margin-bottom:4px;">
                    <span>{{ $r->jurusan->nama ?? '?' }}</span>
                    <span style="color:var(--text-mid);">{{ $r->total }}</span>
                </div>
                <div style="height:7px;background:var(--bg);border-radius:100px;overflow:hidden;">
                    <div style="height:100%;width:{{ round($r->total/$maxRekap*100) }}%;background:var(--primary);border-radius:100px;"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card">
    <div class="card-head">
        <div class="card-title">📋 Tes Terbaru</div>
        <a href="{{ route('bk.siswa.index') }}" class="btn btn-outline btn-sm">Lihat Semua →</a>
    </div>
    <table>
        <thead><tr><th>Nama Siswa</th><th>Sekolah Asal</th><th>Rekomendasi</th><th>Minat Awal</th><th>Sesuai?</th><th>Tanggal</th></tr></thead>
        <tbody>
            @forelse($tesTerbaru as $tes)
            @php
                $rek    = $tes->rekomendasiTeratas?->jurusan?->nama ?? '-';
                $minat1 = $tes->minatJurusan1?->nama ?? '-';
                $sesuai = $tes->rekomendasiTeratas && $tes->rekomendasiTeratas->jurusan_id === $tes->minat_jurusan_1_id;
            @endphp
            <tr>
                {{-- Gunakan $tes->siswa->user->nama --}}
                <td style="font-weight:700;color:var(--primary-dark);">{{ $tes->siswa->user->nama ?? '-' }}</td>
                <td style="font-size:11.5px;color:var(--text-dim);">{{ $tes->siswa->sekolah_asal ?? '-' }}</td>
                <td><span class="badge badge-blue">{{ $rek }}</span></td>
                <td><span class="badge badge-gray">{{ $minat1 }}</span></td>
                <td>
                    @if($tes->rekomendasiTeratas)
                        <span class="badge {{ $sesuai ? 'badge-green':'badge-red' }}">{{ $sesuai ? '✅ Sesuai':'⚠ Berbeda' }}</span>
                    @else —
                    @endif
                </td>
                <td style="font-size:11.5px;color:var(--text-dim);">{{ $tes->created_at->translatedFormat('d M Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-dim);padding:24px;">Belum ada data tes.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
new Chart(document.getElementById('trendChart'),{
    type:'line',
    data:{
        labels:{!! json_encode($bulanLabel) !!},
        datasets:[{label:'Tes',data:{!! json_encode($bulanData) !!},borderColor:'#1a3c6e',borderWidth:2.5,fill:true,backgroundColor:'rgba(26,60,110,.07)',tension:.4,pointBackgroundColor:'#1a3c6e',pointRadius:4}]
    },
    options:{responsive:true,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true},x:{grid:{display:false}}}}
});
</script>
@endpush