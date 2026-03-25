@extends('layouts.landing')

@section('title', 'Hasil Tes SPK - SMK Negeri 2 Jember')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
<style>
    header, nav, .main-header, .top-bar, #mobile-menu, footer,
    .footer, [class*="navbar"], [class*="nav-bar"] { display:none !important; }
    main { padding-top:0 !important; margin-top:0 !important; }
    body { padding-top:0 !important; margin-top:0 !important; }

    :root {
        --bg:#0d0f14; --surface:#161921; --surface2:#1e2330; --border:#2a2f3e;
        --accent:#f4b942; --accent2:#e07b54; --text:#e8eaf0; --text-dim:#8892aa;
        --green:#5cb85c; --radius:16px;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

    .hasil-wrapper { background:var(--bg); color:var(--text); font-family:'DM Sans',sans-serif; min-height:100vh; position:relative; overflow-x:hidden; }
    .bg-grain { position:fixed;inset:0;z-index:0;pointer-events:none;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");opacity:0.5; }
    .bg-glow  { position:fixed;top:-200px;left:-200px;width:700px;height:700px;background:radial-gradient(ellipse,rgba(244,185,66,.08) 0%,transparent 70%);pointer-events:none;z-index:0; }
    .bg-glow2 { position:fixed;bottom:-150px;right:-150px;width:500px;height:500px;background:radial-gradient(ellipse,rgba(224,123,84,.07) 0%,transparent 70%);pointer-events:none;z-index:0; }

    .hasil-container { position:relative;z-index:1;max-width:860px;margin:0 auto;padding:48px 20px 80px; }

    .page-header { text-align:center;margin-bottom:40px;animation:fadeDown .7s ease both; }
    .header-badge { display:inline-flex;align-items:center;gap:8px;background:rgba(244,185,66,.12);border:1px solid rgba(244,185,66,.25);color:var(--accent);font-size:11px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;padding:6px 16px;border-radius:100px;margin-bottom:18px; }
    .page-title { font-family:'Playfair Display',serif;font-size:clamp(1.8rem,5vw,2.8rem);font-weight:900;background:linear-gradient(135deg,#f4b942,#e8eaf0 60%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:8px; }
    .page-sub { color:var(--text-dim);font-size:14px; }

    .alert-success { background:rgba(92,184,92,.08);border:1px solid rgba(92,184,92,.25);border-left:3px solid var(--green);border-radius:10px;padding:13px 18px;font-size:13px;color:#7dcc7d;margin-bottom:24px; }

    /* HERO */
    .result-hero { background:linear-gradient(135deg,#0f1520,#1a2540);border:1px solid var(--border);border-radius:var(--radius);padding:36px 32px;margin-bottom:24px;text-align:center;position:relative;overflow:hidden;box-shadow:0 4px 40px rgba(0,0,0,.4);animation:fadeIn .6s ease both; }
    .result-hero::after { content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--accent),var(--accent2),var(--accent)); }
    .result-hero-icon  { width:90px;height:90px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-size:42px;margin:0 auto 20px;box-shadow:0 0 50px rgba(244,185,66,.35); }
    .result-hero-rank  { font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:rgba(244,185,66,.7);margin-bottom:6px; }
    .result-hero-name  { font-family:'Playfair Display',serif;font-size:clamp(1.4rem,4vw,2rem);font-weight:900;color:var(--accent);margin-bottom:8px; }
    .result-hero-score { display:inline-flex;align-items:center;gap:8px;background:rgba(244,185,66,.1);border:1px solid rgba(244,185,66,.2);border-radius:100px;padding:6px 18px;font-size:14px;font-weight:700;color:var(--accent);margin-bottom:12px; }
    .result-hero-sub   { font-size:13px;color:var(--text-dim); }

    /* COMPARISON */
    .comparison-section { margin-bottom:24px;animation:fadeIn .65s ease both .1s; }
    .comparison-header { text-align:center;margin-bottom:20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--accent);display:flex;align-items:center;gap:10px; }
    .comparison-header::before,.comparison-header::after { content:'';flex:1;height:1px;background:var(--border); }
    .compare-grid { display:grid;grid-template-columns:1fr auto 1fr;gap:14px;align-items:center; }
    .compare-card { border-radius:var(--radius);padding:28px 22px;text-align:center;position:relative;overflow:hidden;box-shadow:0 4px 30px rgba(0,0,0,.35);transition:transform .25s; }
    .compare-card:hover { transform:translateY(-3px); }
    .compare-card.j1 { background:linear-gradient(145deg,#12192e,#1c2b4a);border:1.5px solid rgba(244,185,66,.35); }
    .compare-card.j2 { background:linear-gradient(145deg,#1e1510,#2e1f15);border:1.5px solid rgba(224,123,84,.35); }
    .compare-card.winner { border-width:2px !important;box-shadow:0 6px 40px rgba(92,184,92,.25) !important; }
    .compare-card.winner::after { content:'🏆 Lebih Sesuai';position:absolute;top:12px;right:12px;background:var(--green);color:#fff;font-size:10px;font-weight:800;padding:3px 10px;border-radius:100px;letter-spacing:.05em; }
    .compare-icon  { font-size:36px;margin-bottom:12px; }
    .compare-tag   { font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px;opacity:.7; }
    .compare-name  { font-family:'Playfair Display',serif;font-size:clamp(1rem,3vw,1.2rem);font-weight:800;line-height:1.3;margin-bottom:14px; }
    .compare-card.j1 .compare-name { color:var(--accent); }
    .compare-card.j2 .compare-name { color:var(--accent2); }
    .compare-score-wrap  { display:flex;flex-direction:column;align-items:center;gap:6px;margin-bottom:14px; }
    .compare-score-num   { font-size:2.2rem;font-weight:900;font-family:'Playfair Display',serif;line-height:1; }
    .compare-card.j1 .compare-score-num { color:var(--accent); }
    .compare-card.j2 .compare-score-num { color:var(--accent2); }
    .compare-score-label { font-size:10px;color:var(--text-dim);font-weight:600; }
    .compare-bar-wrap { height:8px;background:rgba(255,255,255,.06);border-radius:100px;overflow:hidden;margin-bottom:12px; }
    .compare-bar-fill { height:100%;border-radius:100px;transition:width 1.4s cubic-bezier(.4,0,.2,1); }
    .compare-card.j1 .compare-bar-fill { background:linear-gradient(90deg,var(--accent),#f7d060); }
    .compare-card.j2 .compare-bar-fill { background:linear-gradient(90deg,var(--accent2),#f09060); }
    .compare-rank { display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:var(--text-dim);background:rgba(255,255,255,.06);padding:5px 12px;border-radius:100px; }
    .compare-vs { display:flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:50%;background:var(--surface2);border:2px solid var(--border);font-size:13px;font-weight:900;color:var(--text-dim);flex-shrink:0; }
    .verdict-box { margin-top:14px;background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:16px 20px;text-align:center; }

    /* INFO CARDS shared */
    .info-card { background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px 28px;margin-bottom:20px;box-shadow:0 4px 20px rgba(0,0,0,.2); }
    .info-card-title { font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--accent);margin-bottom:16px;display:flex;align-items:center;gap:8px; }
    .info-card-title::after { content:'';flex:1;height:1px;background:var(--border); }
    .info-item { background:var(--surface2);border-radius:8px;padding:10px 14px; }
    .info-item-label { font-size:10px;color:var(--text-dim);font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px; }
    .info-item-value { font-size:14px;font-weight:700;color:var(--text); }
    .info-item-sub   { font-size:10px;margin-top:3px; }

    /* Nilai akademik: 4 kolom x 2 baris */
    .grid-4x2 { display:grid;grid-template-columns:repeat(4,1fr);gap:12px; }

    /* Data fisik: 3 kolom (tinggi, berat, bmi) */
    .grid-3col { display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:12px; }

    /* Baris bawah data fisik: buta warna + skor minat + tanggal */
    .grid-meta { display:grid;grid-template-columns:repeat(3,1fr);gap:12px; }

    /* Warna BMI */
    .bmi-kurang { color:#60a5fa; }
    .bmi-normal { color:var(--green); }
    .bmi-lebih  { color:var(--accent); }
    .bmi-obese  { color:#e05454; }

    /* RANKING */
    .ranking-card { background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px 28px;margin-bottom:20px;box-shadow:0 4px 20px rgba(0,0,0,.2); }
    .rank-item { display:flex;align-items:center;gap:16px;background:var(--surface2);border:1.5px solid var(--border);border-radius:12px;padding:14px 18px;margin-bottom:10px;transition:border-color .2s; }
    .rank-item:last-child { margin-bottom:0; }
    .rank-item.top  { border-color:rgba(244,185,66,.4);background:rgba(244,185,66,.05); }
    .rank-item.top2 { border-color:rgba(192,192,192,.3); }
    .rank-item.top3 { border-color:rgba(205,127,50,.3); }
    .rank-item.pilihan { border-color:rgba(92,184,92,.3); }
    .rank-num { width:36px;height:36px;border-radius:50%;background:var(--border);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:800;color:var(--text-dim);flex-shrink:0; }
    .rank-item.top  .rank-num { background:linear-gradient(135deg,var(--accent),var(--accent2));color:#000; }
    .rank-item.top2 .rank-num { background:linear-gradient(135deg,#c0c0c0,#a0a0a0);color:#000; }
    .rank-item.top3 .rank-num { background:linear-gradient(135deg,#cd7f32,#a0522d);color:#fff; }
    .rank-info { flex:1;min-width:0; }
    .rank-nama { font-size:14px;font-weight:600;color:var(--text);margin-bottom:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
    .rank-badge { font-size:10px;background:rgba(92,184,92,.15);color:#7dcc7d;border:1px solid rgba(92,184,92,.3);padding:2px 8px;border-radius:100px;font-weight:700;margin-left:6px; }
    .rank-bar-wrap { height:6px;background:var(--bg);border-radius:100px;overflow:hidden; }
    .rank-bar-fill { height:100%;border-radius:100px;background:linear-gradient(90deg,var(--accent),var(--accent2));transition:width 1.2s cubic-bezier(.4,0,.2,1); }
    .rank-score { font-size:16px;font-weight:800;color:var(--accent);flex-shrink:0; }

    /* SAW TABLE */
    .saw-card { background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:24px 28px;margin-bottom:20px;box-shadow:0 4px 20px rgba(0,0,0,.2); }
    .table-wrap { overflow-x:auto;margin-top:16px; }
    .saw-table { width:100%;border-collapse:collapse;font-size:12px;min-width:500px; }
    .saw-table th { background:var(--surface2);color:var(--text-dim);font-weight:700;padding:10px 12px;text-align:left;border-bottom:1px solid var(--border);white-space:nowrap; }
    .saw-table td { padding:10px 12px;border-bottom:1px solid rgba(42,47,62,.5);color:var(--text-dim); }
    .saw-table tr.best td { color:var(--accent);font-weight:700; }
    .saw-table tr:last-child td { border-bottom:none; }
    .saw-table .score-col { font-weight:700;color:var(--text); }

    /* BUTTONS */
    .btn-group { display:flex;gap:12px;flex-wrap:wrap;justify-content:center;margin-top:28px; }
    .btn { display:inline-flex;align-items:center;gap:8px;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:700;padding:13px 26px;border-radius:10px;cursor:pointer;border:none;transition:all .22s;text-decoration:none; }
    .btn-ghost { background:transparent;color:var(--text-dim);border:1.5px solid var(--border); }
    .btn-ghost:hover { border-color:var(--accent);color:var(--accent); }
    .btn-pdf { background:linear-gradient(135deg,#1a3c6e,#0f2548);color:white;box-shadow:0 4px 18px rgba(15,37,72,.35); }
    .btn-pdf:hover { transform:translateY(-2px);box-shadow:0 8px 26px rgba(15,37,72,.5); }

    @keyframes fadeIn   { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
    @keyframes fadeDown { from{opacity:0;transform:translateY(-14px)} to{opacity:1;transform:translateY(0)} }

    @media(max-width:768px) {
        .grid-4x2  { grid-template-columns:repeat(2,1fr); }
        .grid-3col { grid-template-columns:repeat(3,1fr); }
        .grid-meta { grid-template-columns:repeat(3,1fr); }
    }
    @media(max-width:640px) {
        .hasil-container { padding:28px 14px 60px; }
        .result-hero { padding:28px 20px; }
        .rank-item { gap:10px;padding:12px 14px; }
        .btn-group { flex-direction:column; }
        .btn { width:100%;justify-content:center; }
        .compare-grid { grid-template-columns:1fr;gap:10px; }
        .compare-vs { margin:0 auto; }
        .grid-3col { grid-template-columns:1fr 1fr 1fr; }
        .grid-meta { grid-template-columns:1fr; }
    }
    @media(max-width:480px) {
        .grid-4x2  { grid-template-columns:repeat(2,1fr); }
        .grid-3col { grid-template-columns:repeat(3,1fr); }
    }
</style>
@endpush

@section('content')
<div class="hasil-wrapper">
    <div class="bg-grain"></div><div class="bg-glow"></div><div class="bg-glow2"></div>

    <div class="hasil-container">

        <div class="page-header">
            <div class="header-badge">🎯 Hasil Analisis SAW</div>
            <h1 class="page-title">Rekomendasi Jurusan</h1>
            <p class="page-sub">Hasil perhitungan Simple Additive Weighting berdasarkan nilai dan minat bakat kamu</p>
        </div>

        @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        @php
            $rekomendasi = $hasilList->first();
            $namaField   = $siswa->nama_lengkap ?? $siswa->nama ?? $siswa->nama ?? Auth::user()->nama ?? 'Siswa';

            $jurusanIkon = [
                'Alat Berat'   => '🚜', 'Otomotif'    => '🚗', 'Motor'       => '🏍️',
                'Pemesinan'    => '🔧', 'Mekatronika' => '🤖', 'Konstruksi'  => '🏗️',
                'Bangunan'     => '🏗️', 'Listrik'     => '⚡', 'Pembangkit'  => '🔋',
                'Audio'        => '📺', 'Komputer'    => '💻', 'Desain'      => '🎨',
            ];
            $ikon = '🏆';
            foreach ($jurusanIkon as $kata => $ico) {
                if (str_contains($rekomendasi->jurusan->nama_jurusan ?? '', $kata)) { 
                    $ikon = $ico; 
                    break; 
                }
            }

            // Hitung BMI
            $tinggiBadan = (float) $tesTerakhir->tinggi_badan;
            $beratBadan  = (float) $tesTerakhir->berat_badan;
            $tinggiMeter = $tinggiBadan / 100;
            $bmi         = $tinggiMeter > 0 ? round($beratBadan / ($tinggiMeter * $tinggiMeter), 1) : 0;

            if ($bmi < 18.5)   { $bmiKategori = 'Berat Badan Kurang'; $bmiClass = 'bmi-kurang'; }
            elseif ($bmi < 25) { $bmiKategori = 'Normal / Ideal';     $bmiClass = 'bmi-normal'; }
            elseif ($bmi < 30) { $bmiKategori = 'Berat Badan Lebih';  $bmiClass = 'bmi-lebih';  }
            else               { $bmiKategori = 'Obesitas';           $bmiClass = 'bmi-obese';  }
        @endphp

        {{-- HERO --}}
        <div class="result-hero">
            <div class="result-hero-icon">{{ $ikon }}</div>
            <div class="result-hero-rank">🏆 Rekomendasi #1 Untukmu</div>
            <div class="result-hero-name">{{ $rekomendasi->jurusan->nama_jurusan ?? '-' }}</div>
            <div class="result-hero-score">⭐ Skor SAW: {{ number_format($rekomendasi->nilai_preferensi * 100, 2) }}%</div>
            <p class="result-hero-sub">Halo <strong style="color:var(--text)">{{ $namaField }}</strong>, berdasarkan nilai akademik dan minat bakat kamu, jurusan ini paling sesuai untukmu.</p>
        </div>

        {{-- PERBANDINGAN 2 JURUSAN PILIHAN --}}
        @if(isset($jurusanPilihan1) && isset($jurusanPilihan2) && $jurusanPilihan1 && $jurusanPilihan2)
        @php
            $skor1   = $skorPilihan1 ? $skorPilihan1->nilai_preferensi : 0;
            $skor2   = $skorPilihan2 ? $skorPilihan2->nilai_preferensi : 0;
            $maxSkor = max($skor1, $skor2, 0.0001);
            $bar1    = number_format(($skor1 / $maxSkor) * 100, 1);
            $bar2    = number_format(($skor2 / $maxSkor) * 100, 1);
            $winner  = $skor1 > $skor2 ? 1 : ($skor2 > $skor1 ? 2 : 0);
            $ikon1   = '🏫'; $ikon2 = '🏫';
            foreach ($jurusanIkon as $kata => $ico) {
                if (str_contains($jurusanPilihan1->nama_jurusan, $kata)) $ikon1 = $ico;
                if (str_contains($jurusanPilihan2->nama_jurusan, $kata)) $ikon2 = $ico;
            }
        @endphp
        <div class="comparison-section">
            <div class="comparison-header">⚖️ Perbandingan Jurusan Pilihanmu</div>
            <div class="compare-grid">

                <div class="compare-card j1 {{ $winner===1 ? 'winner' : '' }}">
                    <div class="compare-icon">{{ $ikon1 }}</div>
                    <div class="compare-tag">Pilihan 1</div>
                    <div class="compare-name">{{ $jurusanPilihan1->nama_jurusan }}</div>
                    @if($skorPilihan1)
                    <div class="compare-score-wrap">
                        <div class="compare-score-num">{{ number_format($skor1*100,2) }}%</div>
                        <div class="compare-score-label">Skor Kesesuaian SAW</div>
                    </div>
                    <div class="compare-bar-wrap"><div class="compare-bar-fill" style="width:0%" data-target="{{ $bar1 }}%"></div></div>
                    <div class="compare-rank">🏅 Peringkat #{{ $skorPilihan1->peringkat }}</div>
                    @else
                    <div style="font-size:12px;color:var(--text-dim);margin-top:10px">ℹ️ Tidak masuk perhitungan SAW</div>
                    @endif
                </div>

                <div class="compare-vs">VS</div>

                <div class="compare-card j2 {{ $winner===2 ? 'winner' : '' }}">
                    <div class="compare-icon">{{ $ikon2 }}</div>
                    <div class="compare-tag">Pilihan 2</div>
                    <div class="compare-name">{{ $jurusanPilihan2->nama_jurusan }}</div>
                    @if($skorPilihan2)
                    <div class="compare-score-wrap">
                        <div class="compare-score-num">{{ number_format($skor2*100,2) }}%</div>
                        <div class="compare-score-label">Skor Kesesuaian SAW</div>
                    </div>
                    <div class="compare-bar-wrap"><div class="compare-bar-fill" style="width:0%" data-target="{{ $bar2 }}%"></div></div>
                    <div class="compare-rank">🏅 Peringkat #{{ $skorPilihan2->peringkat }}</div>
                    @else
                    <div style="font-size:12px;color:var(--text-dim);margin-top:10px">ℹ️ Tidak masuk perhitungan SAW</div>
                    @endif
                </div>

            </div>
            <div class="verdict-box">
                @if($winner===1)
                <div style="font-size:14px;font-weight:700;color:var(--green)">
                    ✅ <strong style="color:var(--accent)">{{ $jurusanPilihan1->nama_jurusan }}</strong> lebih sesuai dengan profil kamu
                    <span style="color:var(--text-dim);font-weight:400">(selisih {{ number_format(abs($skor1-$skor2)*100,2) }}%)</span>
                </div>
                @elseif($winner===2)
                <div style="font-size:14px;font-weight:700;color:var(--green)">
                    ✅ <strong style="color:var(--accent2)">{{ $jurusanPilihan2->nama_jurusan }}</strong> lebih sesuai dengan profil kamu
                    <span style="color:var(--text-dim);font-weight:400">(selisih {{ number_format(abs($skor1-$skor2)*100,2) }}%)</span>
                </div>
                @else
                <div style="font-size:14px;font-weight:700;color:var(--text-dim)">⚖️ Kedua jurusan memiliki tingkat kesesuaian yang sama</div>
                @endif
                <div style="font-size:12px;color:var(--text-dim);margin-top:6px">Berdasarkan analisis SAW dari nilai akademik dan tes minat bakat kamu</div>
            </div>
        </div>
        @endif

        {{-- ===== CARD: NILAI AKADEMIK (8 mapel, grid 4 kolom x 2 baris) ===== --}}
        <div class="info-card">
            <div class="info-card-title">📚 Nilai Akademik</div>
            <div class="grid-4x2">
                <div class="info-item">
                    <div class="info-item-label">Matematika</div>
                    <div class="info-item-value">{{ $tesTerakhir->nilai_matematika }}</div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">Bhs. Indonesia</div>
                    <div class="info-item-value">{{ $tesTerakhir->nilai_bahasa_indonesia }}</div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">Bhs. Inggris</div>
                    <div class="info-item-value">{{ $tesTerakhir->nilai_bahasa_inggris }}</div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">IPA</div>
                    <div class="info-item-value">{{ $tesTerakhir->nilai_ipa }}</div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">IPS</div>
                    <div class="info-item-value">{{ $tesTerakhir->nilai_ips }}</div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">Fisika</div>
                    <div class="info-item-value">{{ $tesTerakhir->nilai_fisika }}</div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">Biologi</div>
                    <div class="info-item-value">{{ $tesTerakhir->nilai_biologi }}</div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">PPKN</div>
                    <div class="info-item-value">{{ $tesTerakhir->nilai_ppkn }}</div>
                </div>
            </div>
        </div>

        {{-- ===== CARD: DATA FISIK (tinggi, berat, bmi — masing-masing kotak terpisah) ===== --}}
        <div class="info-card">
            <div class="info-card-title">📏 Data Fisik &amp; Kesehatan</div>

            {{-- Baris 1: Tinggi | Berat | BMI --}}
            <div class="grid-3col">
                <div class="info-item">
                    <div class="info-item-label">Tinggi Badan</div>
                    <div class="info-item-value">
                        {{ $tesTerakhir->tinggi_badan }}
                        <span style="font-size:11px;font-weight:400;color:var(--text-dim)">cm</span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">Berat Badan</div>
                    <div class="info-item-value">
                        {{ $tesTerakhir->berat_badan }}
                        <span style="font-size:11px;font-weight:400;color:var(--text-dim)">kg</span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">BMI</div>
                    <div class="info-item-value {{ $bmiClass }}">{{ $bmi }}</div>
                    <div class="info-item-sub {{ $bmiClass }}">{{ $bmiKategori }}</div>
                </div>
            </div>

            {{-- Baris 2: Buta Warna | Skor Minat | Tanggal Tes --}}
            <div class="grid-meta">
                <div class="info-item">
                    <div class="info-item-label">Buta Warna</div>
                    <div class="info-item-value" style="color:{{ $tesTerakhir->buta_warna ? '#e05454' : 'var(--green)' }}">
                        {{ $tesTerakhir->buta_warna ? '🔴 Ya' : '🟢 Tidak' }}
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">Skor Minat Bakat</div>
                    <div class="info-item-value" style="color:var(--accent)">
                        {{ $tesTerakhir->skor_minat_bakat }}%
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">Tanggal Tes</div>
                    <div class="info-item-value">{{ $tesTerakhir->created_at->format('d M Y') }}</div>
                </div>
            </div>
        </div>

        {{-- RANKING --}}
        <div class="ranking-card">
            <div class="info-card-title">🏅 Ranking Semua Jurusan</div>
            @php
                $idPilihan1 = $tesTerakhir->minat_jurusan_1_id ?? null;
                $idPilihan2 = $tesTerakhir->minat_jurusan_2_id ?? null;
                $topScore   = $hasilList->first()->nilai_preferensi;
            @endphp
            @foreach($hasilList as $i => $hasil)
            @php
                $rankClass = $i===0 ? 'top' : ($i===1 ? 'top2' : ($i===2 ? 'top3' : ''));
                $isPilihan = ($hasil->jurusan_id == $idPilihan1 || $hasil->jurusan_id == $idPilihan2);
                $pct       = number_format($hasil->nilai_preferensi * 100, 2);
                $barWidth  = $topScore > 0
                    ? number_format(($hasil->nilai_preferensi / $topScore) * 100, 1)
                    : '0';
            @endphp
            <div class="rank-item {{ $rankClass }} {{ (!$rankClass && $isPilihan) ? 'pilihan' : '' }}">
                <div class="rank-num">{{ $hasil->peringkat }}</div>
                <div class="rank-info">
                    <div class="rank-nama">
                        {{ $hasil->jurusan->nama_jurusan ?? '-' }}
                        @if($isPilihan)<span class="rank-badge">✓ Pilihanmu</span>@endif
                    </div>
                    <div class="rank-bar-wrap">
                        <div class="rank-bar-fill" style="width:0%" data-target="{{ $barWidth }}%"></div>
                    </div>
                </div>
                <div class="rank-score">{{ $pct }}%</div>
            </div>
            @endforeach
        </div>

        {{-- TABEL SAW --}}
        <div class="saw-card">
            <div class="info-card-title">📊 Detail Nilai Preferensi SAW</div>
            <div class="table-wrap">
                <table class="saw-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Jurusan</th>
                            <th>Nilai Preferensi (V)</th>
                            <th>Skor (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasilList as $i => $hasil)
                        <tr class="{{ $i===0 ? 'best' : '' }}">
                            <td>{{ $hasil->peringkat }}</td>
                            <td>{{ $hasil->jurusan->nama_jurusan ?? '-' }}</td>
                            <td class="score-col">{{ number_format($hasil->nilai_preferensi, 6) }}</td>
                            <td><strong>{{ number_format($hasil->nilai_preferensi * 100, 2) }}%</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="btn-group">
            <a href="{{ url('/') }}" class="btn btn-ghost">🏠 Kembali ke Home</a>
            <a href="{{ route('siswa.tes.index') }}" class="btn btn-ghost">🔄 Ulangi Tes</a>
            <a href="{{ route('siswa.tes.cetak') }}" class="btn btn-pdf" target="_blank">📄 Cetak / Download PDF</a>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    setTimeout(() => {
        document.querySelectorAll('.rank-bar-fill, .compare-bar-fill').forEach(el => {
            el.style.width = el.dataset.target;
        });
    }, 300);
</script>
@endpush