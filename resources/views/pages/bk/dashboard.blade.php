@extends('layouts.bk')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('page-sub','Selamat datang, pantau perkembangan siswa')

@push('styles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<style>
.dashboard-hero{
    background:linear-gradient(135deg,var(--primary-dark) 0%,var(--primary) 60%,var(--primary-mid) 100%);
    border-radius:var(--radius);
    padding:24px 28px;
    margin-bottom:22px;
    color:#fff;
    position:relative;
    overflow:hidden;
    box-shadow:var(--shadow-soft);
}
.dashboard-hero::before{
    content:'';
    position:absolute;
    inset:0;
    background-image:url("data:image/svg+xml,%3Csvg width='160' height='160' viewBox='0 0 160 160' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='white' fill-opacity='0.04'%3E%3Ccircle cx='20' cy='20' r='2'/%3E%3Ccircle cx='80' cy='40' r='2'/%3E%3Ccircle cx='120' cy='100' r='2'/%3E%3Ccircle cx='40' cy='120' r='2'/%3E%3C/g%3E%3C/svg%3E");
    opacity:1;
    pointer-events:none;
}
.dashboard-hero::after{
    content:'';
    position:absolute;
    top:-40px;
    right:-40px;
    width:200px;
    height:200px;
    border-radius:50%;
    background:rgba(255,255,255,.06);
}
.hero-badge{
    position:relative;
    z-index:1;
    display:inline-flex;
    align-items:center;
    gap:6px;
    background:rgba(255,255,255,.15);
    border:1px solid rgba(255,255,255,.25);
    color:#fff;
    font-size:11px;
    font-weight:700;
    letter-spacing:.06em;
    padding:5px 12px;
    border-radius:999px;
    margin-bottom:10px;
    backdrop-filter:blur(8px);
}
.hero-title{
    position:relative;
    z-index:1;
    font-family:'Poppins',sans-serif;
    font-size:22px;
    font-weight:800;
    margin-bottom:4px;
}
.hero-subtitle{
    position:relative;
    z-index:1;
    font-size:13px;
    color:rgba(255,255,255,.75);
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
    margin-bottom:22px;
}
.stat-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:18px 20px;
    position:relative;
    overflow:hidden;
    box-shadow:var(--shadow-soft);
    transition:all var(--transition-normal);
}
.stat-card:hover{
    transform:translateY(-4px);
    box-shadow:var(--shadow-deep);
}
.stat-card::after{
    content:'';
    position:absolute;
    left:0;
    right:0;
    bottom:0;
    height:4px;
    opacity:.9;
}
.stat-card.blue::after{ background:#2563eb; }
.stat-card.green::after{ background:#16a34a; }
.stat-card.gold::after{ background:#d97706; }
.stat-card.red::after{ background:#dc2626; }

.stat-icon{
    width:42px;
    height:42px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    margin-bottom:12px;
}
.stat-icon.blue{
    background:var(--blue-bg);
    border:1px solid var(--blue-border);
}
.stat-icon.green{
    background:var(--green-bg);
    border:1px solid var(--green-border);
}
.stat-icon.gold{
    background:var(--yellow-bg);
    border:1px solid var(--yellow-border);
}
.stat-icon.red{
    background:var(--red-bg);
    border:1px solid var(--red-border);
}
.stat-value{
    font-family:'Poppins',sans-serif;
    font-size:28px;
    font-weight:800;
    color:var(--primary-dark);
    line-height:1;
}
.stat-label{
    font-size:12px;
    font-weight:700;
    color:var(--text-mid);
    margin-top:6px;
}
.stat-sub{
    font-size:11px;
    color:var(--text-dim);
    margin-top:3px;
}

.dashboard-grid{
    display:grid;
    grid-template-columns:1.5fr 1fr;
    gap:16px;
    margin-bottom:22px;
}
.panel-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:var(--radius);
    box-shadow:var(--shadow-soft);
    transition:all var(--transition-normal);
}
.panel-card:hover{
    box-shadow:var(--shadow-deep);
}
.panel-body{
    padding:20px;
}
.panel-title{
    font-size:13.5px;
    font-weight:700;
    color:var(--primary-dark);
    margin-bottom:4px;
}
.panel-subtitle{
    font-size:11px;
    color:var(--text-dim);
    margin-bottom:16px;
}

.rekap-list{
    display:flex;
    flex-direction:column;
    gap:11px;
}
.rekap-item-title{
    display:flex;
    justify-content:space-between;
    font-size:12px;
    font-weight:700;
    color:var(--primary-dark);
    margin-bottom:4px;
    gap:8px;
}
.rekap-track{
    height:8px;
    background:var(--bg);
    border-radius:999px;
    overflow:hidden;
}
.rekap-bar{
    height:100%;
    background:var(--primary);
    border-radius:999px;
}

.table-empty{
    text-align:center;
    color:var(--text-dim);
    padding:24px;
    font-size:12.5px;
}

@media (max-width: 1100px){
    .stats-grid{
        grid-template-columns:repeat(2,1fr);
    }
    .dashboard-grid{
        grid-template-columns:1fr;
    }
}
@media (max-width: 640px){
    .dashboard-hero{
        padding:20px;
    }
    .hero-title{
        font-size:20px;
    }
    .stats-grid{
        grid-template-columns:1fr;
    }
}
</style>
@endpush

@section('content')
@php
    $bulanLabel = $trenTes->map(fn($t) => \Carbon\Carbon::create($t->tahun, $t->bulan)->translatedFormat('M'));
    $bulanData  = $trenTes->pluck('total');
    $maxRekap   = $rekapJurusan->max('total') ?: 1;
@endphp

<div class="dashboard-hero">
    <div class="hero-badge">👩‍🏫 Guru Bimbingan Konseling</div>
    <div class="hero-title">Selamat Datang, {{ Auth::user()->nama }}!</div>
    <div class="hero-subtitle">Pantau perkembangan siswa dan kelola konten jurusan dari sini.</div>
</div>

<div class="stats-grid">
    @foreach([
        ['🎓',$totalSiswa,'Total Siswa','Terdaftar di sistem','blue'],
        ['✅',$sudahTes,'Sudah Tes','Sudah mengerjakan','green'],
        ['⏳',$belumTes,'Belum Tes','Perlu tindak lanjut','gold'],
        ['⚠️',$minatBeda,'Minat ≠ Hasil','Perlu konseling','red'],
    ] as [$icon,$num,$label,$sub,$tone])
    <div class="stat-card {{ $tone }}">
        <div class="stat-icon {{ $tone }}">{{ $icon }}</div>
        <div class="stat-value">{{ $num }}</div>
        <div class="stat-label">{{ $label }}</div>
        <div class="stat-sub">{{ $sub }}</div>
    </div>
    @endforeach
</div>

<div class="dashboard-grid">
    <div class="panel-card">
        <div class="panel-body">
            <div class="panel-title">📈 Tren Tes Siswa</div>
            <div class="panel-subtitle">7 bulan terakhir</div>
            <canvas id="trendChart"></canvas>
        </div>
    </div>

    <div class="panel-card">
        <div class="panel-body">
            <div class="panel-title" style="margin-bottom:14px;">🏆 Rekap Peminat Jurusan</div>
            <div class="rekap-list">
                @foreach($rekapJurusan as $r)
                <div>
                    <div class="rekap-item-title">
                        <span>{{ $r->jurusan->nama ?? '?' }}</span>
                        <span style="color:var(--text-mid);">{{ $r->total }}</span>
                    </div>
                    <div class="rekap-track">
                        <div class="rekap-bar" style="width:{{ round($r->total/$maxRekap*100) }}%;"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-head">
        <div class="card-title">📋 Tes Terbaru</div>
        <a href="{{ route('bk.siswa.index') }}" class="btn btn-outline btn-sm">Lihat Semua →</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Sekolah Asal</th>
                <th>Rekomendasi</th>
                <th>Minat Awal</th>
                <th>Sesuai?</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tesTerbaru as $tes)
            @php
                $rek    = $tes->rekomendasiTeratas?->jurusan?->nama ?? '-';
                $minat1 = $tes->minatJurusan1?->nama ?? '-';
                $sesuai = $tes->rekomendasiTeratas && $tes->rekomendasiTeratas->jurusan_id === $tes->minat_jurusan_1_id;
            @endphp
            <tr>
                <td style="font-weight:700;color:var(--primary-dark);">{{ $tes->siswa->user->nama ?? '-' }}</td>
                <td style="font-size:11.5px;color:var(--text-dim);">{{ $tes->siswa->sekolah_asal ?? '-' }}</td>
                <td><span class="badge badge-blue">{{ $rek }}</span></td>
                <td><span class="badge badge-gray">{{ $minat1 }}</span></td>
                <td>
                    @if($tes->rekomendasiTeratas)
                        <span class="badge {{ $sesuai ? 'badge-green':'badge-red' }}">
                            {{ $sesuai ? '✅ Sesuai':'⚠ Berbeda' }}
                        </span>
                    @else
                        —
                    @endif
                </td>
                <td style="font-size:11.5px;color:var(--text-dim);">{{ $tes->created_at->translatedFormat('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="table-empty">Belum ada data tes.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
new Chart(document.getElementById('trendChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($bulanLabel) !!},
        datasets: [{
            label: 'Tes',
            data: {!! json_encode($bulanData) !!},
            borderColor: '#1a3c6e',
            borderWidth: 2.5,
            fill: true,
            backgroundColor: 'rgba(26,60,110,.07)',
            tension: .4,
            pointBackgroundColor: '#1a3c6e',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 5
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#6b7a8d',
                    precision: 0
                },
                grid: {
                    color: 'rgba(226,232,240,.9)'
                }
            },
            x: {
                ticks: {
                    color: '#6b7a8d'
                },
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>
@endpush