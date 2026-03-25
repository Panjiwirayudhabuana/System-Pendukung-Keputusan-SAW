@extends('layouts.admin')
@section('title','Monitoring')
@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush
@section('content')
<div style="margin-bottom:20px;">
    <h1 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#0d1117;">📊 Statistik & Activity Log</h1>
    <p style="font-size:12px;color:#64748b;margin-top:3px;">FR-A-11 · Monitoring pengguna, tes, dan aktivitas sistem</p>
</div>

{{-- Stat mini --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;">
    @foreach([['Siswa Aktif',$siswaAktif,'#ecfdf5','#059669'],['Siswa Nonaktif',$siswaInaktif,'#fef2f2','#dc2626'],['Guru BK Aktif',$guruBkAktif,'#eff6ff','#2563eb'],['Guru BK Nonaktif',$guruBkInaktif,'#fef2f2','#dc2626']] as [$label,$val,$bg,$c])
    <div style="background:{{ $bg }};border:1px solid #e2e8f0;border-radius:12px;padding:16px 18px;">
        <div style="font-size:11px;font-weight:700;color:#64748b;margin-bottom:4px;">{{ $label }}</div>
        <div style="font-family:'Syne',sans-serif;font-size:26px;font-weight:800;color:{{ $c }};">{{ $val }}</div>
    </div>
    @endforeach
</div>

{{-- Charts --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,.06);">
        <div style="font-family:'Syne',sans-serif;font-size:13.5px;font-weight:700;margin-bottom:16px;">📈 Tren Tes per Bulan</div>
        <canvas id="chartTren" height="160"></canvas>
    </div>
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,.06);">
        <div style="font-family:'Syne',sans-serif;font-size:13.5px;font-weight:700;margin-bottom:16px;">🏆 Peminat Jurusan</div>
        <canvas id="chartJurusan" height="160"></canvas>
    </div>
</div>

{{-- Activity Log --}}
<div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.06);">
    <div style="padding:15px 20px;border-bottom:1px solid #e2e8f0;">
        <div style="font-family:'Syne',sans-serif;font-size:13.5px;font-weight:700;">📋 Activity Log</div>
    </div>
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f8fafc;">
                <th style="padding:9px 16px;text-align:left;font-size:10px;font-weight:700;text-transform:uppercase;color:#64748b;border-bottom:1px solid #e2e8f0;">Waktu</th>
                <th style="padding:9px 16px;text-align:left;font-size:10px;font-weight:700;text-transform:uppercase;color:#64748b;border-bottom:1px solid #e2e8f0;">User</th>
                <th style="padding:9px 16px;text-align:left;font-size:10px;font-weight:700;text-transform:uppercase;color:#64748b;border-bottom:1px solid #e2e8f0;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($activityLogs as $log)
            <tr style="border-bottom:1px solid #e2e8f0;">
                <td style="padding:10px 16px;font-size:11.5px;color:#64748b;">{{ $log->created_at }}</td>
                <td style="padding:10px 16px;font-size:12.5px;font-weight:600;">{{ $log->user_nama ?? '-' }}</td>
                <td style="padding:10px 16px;font-size:12.5px;">{{ $log->aksi ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="3" style="padding:24px;text-align:center;color:#94a3b8;font-size:13px;">Belum ada log aktivitas.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding:14px 16px;border-top:1px solid #e2e8f0;">{{ $activityLogs->links() }}</div>
</div>

@push('scripts')
<script>
const trenLabels = {!! json_encode($tesPerBulan->map(fn($t) => \Carbon\Carbon::createFromDate($t->tahun, $t->bulan, 1)->translatedFormat('M Y'))) !!};
const trenData   = {!! json_encode($tesPerBulan->pluck('total')) !!};
new Chart(document.getElementById('chartTren'), {
    type: 'line',
    data: { labels: trenLabels, datasets: [{ label: 'Jumlah Tes', data: trenData, borderColor: '#2563eb', backgroundColor: 'rgba(37,99,235,.08)', tension: 0.4, fill: true, pointBackgroundColor: '#2563eb' }] },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});

const jurusanLabels = {!! json_encode($peminatJurusan->map(fn($p) => $p->jurusan->nama ?? 'N/A')) !!};
const jurusanData   = {!! json_encode($peminatJurusan->pluck('total')) !!};
new Chart(document.getElementById('chartJurusan'), {
    type: 'doughnut',
    data: { labels: jurusanLabels, datasets: [{ data: jurusanData, backgroundColor: ['#2563eb','#059669','#f0a500','#7c3aed','#dc2626','#0891b2','#d97706','#db2777'] }] },
    options: { plugins: { legend: { position: 'right', labels: { font: { size: 11 } } } } }
});
</script>
@endpush
@endsection