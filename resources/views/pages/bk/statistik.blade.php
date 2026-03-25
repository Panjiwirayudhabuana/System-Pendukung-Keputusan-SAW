@extends('layouts.bk')
@section('title','Statistik Jurusan')
@section('page-title','Statistik Jurusan')
@section('page-sub','FR-BK-06 · Rekap & grafik peminat jurusan')
@push('styles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
@endpush

@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
    <div class="card" style="padding:20px;">
        <div style="font-size:13.5px;font-weight:700;margin-bottom:14px;">📊 Peminat per Jurusan</div>
        <canvas id="barChart"></canvas>
    </div>
    <div class="card" style="padding:20px;">
        <div style="font-size:13.5px;font-weight:700;margin-bottom:14px;">🥧 Distribusi Jurusan</div>
        <canvas id="pieChart"></canvas>
    </div>
</div>
<div class="card" style="padding:20px;">
    <div style="font-size:13.5px;font-weight:700;margin-bottom:14px;">⚖️ Kesesuaian Minat vs Rekomendasi</div>
    <canvas id="matchChart" height="100"></canvas>
</div>
@endsection

@push('scripts')
<script>
const jLabel = {!! json_encode($peminatJurusan->map(fn($r) => $r->jurusan->nama ?? '?')) !!};
const jData  = {!! json_encode($peminatJurusan->pluck('total')) !!};
const colors = ['#1a3c6e','#7c3aed','#db2777','#16a34a','#d97706','#ea580c'];

new Chart(document.getElementById('barChart'),{type:'bar',data:{labels:jLabel,datasets:[{label:'Siswa',data:jData,backgroundColor:colors.map(c=>c+'cc'),borderRadius:6,borderSkipped:false}]},options:{responsive:true,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true},x:{grid:{display:false}}}}});
new Chart(document.getElementById('pieChart'),{type:'doughnut',data:{labels:jLabel,datasets:[{data:jData,backgroundColor:colors,borderWidth:3,borderColor:'#fff'}]},options:{responsive:true,plugins:{legend:{position:'right'}},cutout:'60%'}});

const klabel = {!! json_encode($kesesuaian->pluck('nama_jurusan')) !!};
const sesuai = {!! json_encode($kesesuaian->pluck('sesuai')) !!};
const beda   = {!! json_encode($kesesuaian->pluck('berbeda')) !!};
new Chart(document.getElementById('matchChart'),{type:'bar',data:{labels:klabel,datasets:[{label:'Sesuai Minat',data:sesuai,backgroundColor:'#16a34acc',borderRadius:4},{label:'Berbeda dari Minat',data:beda,backgroundColor:'#dc2626aa',borderRadius:4}]},options:{responsive:true,plugins:{legend:{position:'top'}},scales:{x:{grid:{display:false}},y:{beginAtZero:true}}}});
</script>
@endpush
