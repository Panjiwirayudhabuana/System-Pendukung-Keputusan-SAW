@extends('layouts.landing')

@section('title', 'Tes SPK - SMK Negeri 2 Jember')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
<style>
    :root {
        --bg:#0d0f14; --surface:#161921; --surface2:#1e2330; --border:#2a2f3e;
        --accent:#f4b942; --accent2:#e07b54; --text:#e8eaf0; --text-dim:#8892aa;
        --green:#5cb85c; --danger:#e05454; --radius:16px;
    }
    *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
    header, nav, .main-header, .top-bar, #mobile-menu, footer,
    .footer, [class*="navbar"], [class*="nav-bar"] { display:none !important; }
    main { padding-top:0 !important; margin-top:0 !important; }
    body { padding-top:0 !important; margin-top:0 !important; }

    .spk-wrapper { background:var(--bg); color:var(--text); font-family:'DM Sans',sans-serif; min-height:100vh; position:relative; overflow-x:hidden; }
    .bg-grain { position:fixed; inset:0; z-index:0; pointer-events:none; background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E"); opacity:0.5; }
    .bg-glow  { position:fixed; top:-200px; left:-200px; width:700px; height:700px; background:radial-gradient(ellipse,rgba(244,185,66,.08) 0%,transparent 70%); pointer-events:none; z-index:0; }
    .bg-glow2 { position:fixed; bottom:-150px; right:-150px; width:500px; height:500px; background:radial-gradient(ellipse,rgba(224,123,84,.07) 0%,transparent 70%); pointer-events:none; z-index:0; }

    .spk-container { position:relative; z-index:1; max-width:860px; margin:0 auto; padding:48px 20px 80px; }

    .page-header { text-align:center; margin-bottom:44px; animation:fadeDown .7s ease both; }
    .header-badge { display:inline-flex; align-items:center; gap:8px; background:rgba(244,185,66,.12); border:1px solid rgba(244,185,66,.25); color:var(--accent); font-size:11px; font-weight:600; letter-spacing:.1em; text-transform:uppercase; padding:6px 16px; border-radius:100px; margin-bottom:18px; }
    .page-title { font-family:'Playfair Display',serif; font-size:clamp(1.9rem,5vw,3rem); font-weight:900; line-height:1.15; background:linear-gradient(135deg,#f4b942,#e8eaf0 60%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:10px; }
    .page-sub { color:var(--text-dim); font-size:14px; max-width:480px; margin:0 auto; line-height:1.6; }

    .progress-bar-wrap { background:var(--surface2); border-radius:100px; height:6px; margin-bottom:10px; overflow:hidden; }
    .progress-bar-fill { height:100%; border-radius:100px; background:linear-gradient(90deg,var(--accent),var(--accent2)); transition:width .5s cubic-bezier(.4,0,.2,1); }
    .progress-label { display:flex; justify-content:space-between; font-size:12px; color:var(--text-dim); margin-bottom:28px; }

    .stepper { display:flex; align-items:flex-start; margin-bottom:32px; animation:fadeIn .5s ease both .1s; }
    .step-item-nav { display:flex; flex-direction:column; align-items:center; gap:7px; flex:1; position:relative; }
    .step-item-nav::after { content:''; position:absolute; top:17px; left:calc(50% + 18px); right:calc(-50% + 18px); height:2px; background:var(--border); z-index:0; transition:background .4s; }
    .step-item-nav:last-child::after { display:none; }
    .step-item-nav.done::after   { background:var(--green); }
    .step-item-nav.active::after { background:linear-gradient(90deg,var(--green),var(--border)); }
    .step-circle { width:34px; height:34px; border-radius:50%; border:2px solid var(--border); background:var(--surface); display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:800; color:var(--text-dim); position:relative; z-index:1; transition:all .3s cubic-bezier(.4,0,.2,1); box-shadow:0 2px 8px rgba(0,0,0,.3); }
    .step-item-nav.active .step-circle { border-color:var(--accent); background:var(--accent); color:#111; box-shadow:0 0 0 4px rgba(244,185,66,.2),0 2px 8px rgba(0,0,0,.3); transform:scale(1.1); }
    .step-item-nav.done .step-circle { border-color:var(--green); background:var(--green); color:white; box-shadow:0 0 0 4px rgba(92,184,92,.15),0 2px 8px rgba(0,0,0,.3); }
    .step-label { font-size:10px; font-weight:600; color:var(--text-dim); text-align:center; line-height:1.3; max-width:64px; transition:color .3s; }
    .step-item-nav.active .step-label { color:var(--accent); }
    .step-item-nav.done .step-label { color:var(--green); }

    .step-panel { display:none; }
    .step-panel.active { display:block; animation:slideIn .35s ease both; }

    .card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius); overflow:hidden; margin-bottom:20px; box-shadow:0 4px 40px rgba(0,0,0,.35); }
    .card-header { background:linear-gradient(135deg,#0f1520,#1a2540); border-bottom:1px solid var(--border); padding:24px 30px; position:relative; overflow:hidden; }
    .card-header::before { content:''; position:absolute; top:-40px; right:-40px; width:160px; height:160px; border-radius:50%; background:rgba(244,185,66,.04); }
    .card-header::after  { content:''; position:absolute; bottom:0; left:0; right:0; height:2px; background:linear-gradient(90deg,var(--accent),var(--accent2),var(--accent)); }
    .card-step-label { font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:rgba(244,185,66,.7); margin-bottom:5px; }
    .card-title { font-family:'Playfair Display',serif; font-size:clamp(1.1rem,3vw,1.35rem); font-weight:700; color:var(--text); line-height:1.3; }
    .card-sub { font-size:12px; color:var(--text-dim); margin-top:4px; line-height:1.5; }
    .card-body { padding:28px 30px; }

    .section-label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:.12em; color:var(--accent); margin:22px 0 14px; display:flex; align-items:center; gap:10px; }
    .section-label::after { content:''; flex:1; height:1px; background:var(--border); }
    .section-label:first-child { margin-top:0; }

    .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px; }
    .field label { display:block; font-size:11px; font-weight:700; color:var(--text-dim); text-transform:uppercase; letter-spacing:.06em; margin-bottom:7px; }
    .field label .req { color:var(--danger); }
    .field input, .field select { width:100%; background:var(--surface2); border:1.5px solid var(--border); border-radius:10px; color:var(--text); font-family:'DM Sans',sans-serif; font-size:13px; padding:11px 14px; transition:border-color .2s,box-shadow .2s; outline:none; -webkit-appearance:none; }
    .field input:focus, .field select:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(244,185,66,.1); background:#21263a; }
    .field select option { background:var(--surface2); }
    .field input.has-unit { padding-right:42px; }
    .input-wrap { position:relative; }
    .input-unit { position:absolute; right:12px; top:50%; transform:translateY(-50%); font-size:10px; font-weight:700; color:var(--text-dim); background:var(--border); padding:2px 6px; border-radius:4px; pointer-events:none; }
    .field-hint { font-size:11px; color:var(--text-dim); margin-top:5px; }

    .alert-box { border-radius:10px; padding:13px 16px; margin-bottom:20px; font-size:12px; line-height:1.6; display:flex; align-items:flex-start; gap:10px; }
    .alert-warn { background:rgba(244,185,66,.07); border:1px solid rgba(244,185,66,.2); border-left:3px solid var(--accent); color:#c8a060; }
    .alert-warn strong { color:var(--accent); }
    .alert-error { background:rgba(224,84,84,.08); border:1px solid rgba(224,84,84,.25); border-left:3px solid var(--danger); color:#f08080; border-radius:10px; padding:13px 16px; margin-bottom:20px; font-size:12px; line-height:1.7; }
    .alert-error ul { padding-left:16px; margin-top:6px; }
    .alert-info { background:rgba(92,184,92,.07); border:1px solid rgba(92,184,92,.2); border-left:3px solid var(--green); color:#7dcc7d; }

    .toggle-group { display:flex; gap:10px; }
    .toggle-btn { flex:1; padding:11px 14px; border:1.5px solid var(--border); border-radius:10px; font-size:12px; font-weight:600; cursor:pointer; text-align:center; transition:all .2s; background:var(--surface2); color:var(--text-dim); font-family:'DM Sans',sans-serif; user-select:none; }
    .toggle-btn.sel-ya { border-color:var(--danger); background:rgba(224,84,84,.1); color:#f08080; }
    .toggle-btn.sel-tidak { border-color:var(--green); background:rgba(92,184,92,.1); color:#7dcc7d; }

    #bmiCard { display:none; background:linear-gradient(135deg,#161d2a,#1a2135); border:1.5px solid var(--border); border-radius:10px; padding:16px 20px; margin-bottom:18px; animation:fadeIn .4s ease; }
    .bmi-label { font-size:10px; color:var(--text-dim); font-weight:700; text-transform:uppercase; letter-spacing:.07em; margin-bottom:8px; }
    .bmi-row   { display:flex; align-items:center; gap:14px; }
    .bmi-num   { font-size:2.2rem; font-weight:900; color:var(--text); line-height:1; font-family:'Playfair Display',serif; }
    .bmi-cat   { font-size:13px; font-weight:700; }
    .bmi-sub   { font-size:11px; color:var(--text-dim); margin-top:2px; }

    .nilai-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; }
    .nilai-card { background:var(--surface2); border:1.5px solid var(--border); border-radius:10px; padding:14px 16px; transition:all .2s; }
    .nilai-card:focus-within { border-color:var(--accent); background:#21263a; box-shadow:0 0 0 3px rgba(244,185,66,.1); }
    .nilai-label { font-size:10px; font-weight:700; color:var(--text-dim); text-transform:uppercase; letter-spacing:.06em; margin-bottom:8px; }
    .nilai-input { width:100%; background:transparent; border:none; border-bottom:2px solid var(--border); color:var(--text); font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700; outline:none; padding:4px 0; transition:border-color .2s; }
    .nilai-input:focus { border-color:var(--accent); }
    .nilai-scale { font-size:10px; color:var(--text-dim); margin-top:5px; }

    .bakat-question { background:var(--surface2); border:1.5px solid var(--border); border-radius:12px; padding:18px 20px; margin-bottom:12px; transition:all .2s; }
    .bakat-question.answered { border-color:rgba(92,184,92,.3); background:rgba(92,184,92,.04); }
    .bakat-q-num  { font-size:10px; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:.05em; margin-bottom:5px; }
    .bakat-q-text { font-size:13px; font-weight:500; color:var(--text); margin-bottom:14px; line-height:1.55; }
    .bakat-options { display:flex; gap:7px; flex-wrap:wrap; }
    .bakat-opt { flex:1; min-width:100px; padding:9px 8px; border:1.5px solid var(--border); border-radius:8px; font-size:11px; font-weight:600; cursor:pointer; text-align:center; transition:all .2s; background:var(--bg); color:var(--text-dim); font-family:'DM Sans',sans-serif; user-select:none; }
    .bakat-opt.selected { border-color:var(--accent); background:rgba(244,185,66,.12); color:var(--accent); font-weight:700; }
    .bakat-opt input { display:none; }

    .setuju-box { background:rgba(244,185,66,.06); border:1.5px solid rgba(244,185,66,.2); border-radius:12px; padding:18px 20px; display:flex; align-items:flex-start; gap:14px; cursor:pointer; transition:all .2s; margin-top:20px; }
    .setuju-box.active { border-color:rgba(244,185,66,.45); background:rgba(244,185,66,.10); box-shadow:0 0 0 3px rgba(244,185,66,.08); }
    .setuju-box input[type="checkbox"] { accent-color:var(--accent); width:18px; height:18px; flex-shrink:0; margin-top:2px; cursor:pointer; }
    .setuju-box-text { font-size:13px; color:var(--text-dim); line-height:1.6; }
    .setuju-box-text strong { color:var(--accent); }

    .review-section { margin-bottom:20px; }
    .review-title { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--text-dim); margin-bottom:10px; display:flex; align-items:center; gap:8px; }
    .review-title::after { content:''; flex:1; height:1px; background:var(--border); }
    .review-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; }
    .review-item { background:var(--surface2); border:1px solid var(--border); border-radius:8px; padding:10px 14px; }
    .review-item-label { font-size:10px; color:var(--text-dim); margin-bottom:3px; font-weight:600; }
    .review-item-value { font-size:13px; font-weight:700; color:var(--text); }

    .btn-nav { display:flex; gap:12px; justify-content:space-between; margin-top:24px; padding-top:20px; border-top:1px solid var(--border); flex-wrap:wrap; }
    .btn-prev { padding:11px 22px; border:1.5px solid var(--border); border-radius:10px; font-size:13px; font-weight:600; color:var(--text-dim); background:transparent; cursor:pointer; transition:all .2s; font-family:'DM Sans',sans-serif; text-decoration:none; display:inline-flex; align-items:center; }
    .btn-prev:hover { border-color:var(--accent); color:var(--accent); }
    .btn-next { padding:11px 26px; border:none; border-radius:10px; font-size:13px; font-weight:700; color:#111; background:linear-gradient(135deg,var(--accent),var(--accent2)); cursor:pointer; transition:all .22s; margin-left:auto; font-family:'DM Sans',sans-serif; box-shadow:0 4px 18px rgba(244,185,66,.25); }
    .btn-next:hover { transform:translateY(-2px); box-shadow:0 8px 26px rgba(244,185,66,.4); }
    .btn-submit { padding:13px 30px; border:none; border-radius:10px; font-size:14px; font-weight:700; color:white; background:linear-gradient(135deg,#1a3c6e,#0f2548); cursor:pointer; transition:all .3s; margin-left:auto; font-family:'DM Sans',sans-serif; box-shadow:0 4px 18px rgba(15,37,72,.4); }
    .btn-submit:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(15,37,72,.5); }
    .btn-submit:disabled { opacity:.65; cursor:not-allowed; transform:none; }

    .toast { position:fixed; top:20px; right:20px; z-index:9999; background:var(--accent2); color:white; font-size:13px; font-weight:600; padding:12px 20px; border-radius:10px; box-shadow:0 4px 20px rgba(0,0,0,.4); display:none; font-family:'DM Sans',sans-serif; }

    @keyframes fadeIn   { from{opacity:0;transform:translateY(10px)}  to{opacity:1;transform:translateY(0)} }
    @keyframes fadeDown { from{opacity:0;transform:translateY(-14px)} to{opacity:1;transform:translateY(0)} }
    @keyframes slideIn  { from{opacity:0;transform:translateX(16px)}  to{opacity:1;transform:translateX(0)} }

    @media(max-width:768px) {
        .nilai-grid { grid-template-columns:1fr 1fr; }
    }
    @media(max-width:640px) {
        .spk-container { padding:28px 14px 60px; }
        .card-body, .card-header { padding:20px 18px; }
        .form-grid { grid-template-columns:1fr; }
        .nilai-grid { grid-template-columns:1fr 1fr; }
        .review-grid { grid-template-columns:1fr; }
        .step-label { display:none; }
        .step-circle { width:28px; height:28px; font-size:10px; }
        .step-item-nav::after { top:14px; left:calc(50% + 15px); right:calc(-50% + 15px); }
        .bakat-options, .toggle-group { flex-direction:column; }
        .bakat-opt { min-width:100%; }
        .btn-nav { flex-direction:column; }
        .btn-next, .btn-submit { margin-left:0; width:100%; justify-content:center; }
        .btn-prev { width:100%; text-align:center; justify-content:center; }
    }
    @media(max-width:400px) {
        .nilai-grid { grid-template-columns:1fr; }
    }
</style>
@endpush

@section('content')
<div class="spk-wrapper">
    <div class="bg-grain"></div>
    <div class="bg-glow"></div>
    <div class="bg-glow2"></div>
    <div class="toast" id="toast"></div>

    <div class="spk-container">
        <div class="page-header">
            <div class="header-badge">🎯 Sistem Pendukung Keputusan</div>
            <h1 class="page-title">Tes Minat &amp; Bakat<br/>Siswa</h1>
            <p class="page-sub">Temukan jurusan terbaik untukmu melalui analisis terukur menggunakan metode SAW.</p>
        </div>

        @if($errors->any())
        <div class="alert-error">
            <strong>⚠ Harap perbaiki kesalahan berikut:</strong>
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('info'))
        <div class="alert-box alert-info">ℹ️ {{ session('info') }}</div>
        @endif

        <div class="progress-bar-wrap">
            <div class="progress-bar-fill" id="progressFill" style="width:20%"></div>
        </div>
        <div class="progress-label">
            <span id="progressLabel">Langkah 1 dari 5 — Pilih Jurusan</span>
            <span id="progressPct">20%</span>
        </div>

        <div class="stepper">
            <div class="step-item-nav active" id="nav-0"><div class="step-circle">1</div><div class="step-label">Pilih Jurusan</div></div>
            <div class="step-item-nav" id="nav-1"><div class="step-circle">2</div><div class="step-label">Data Fisik</div></div>
            <div class="step-item-nav" id="nav-2"><div class="step-circle">3</div><div class="step-label">Nilai</div></div>
            <div class="step-item-nav" id="nav-3"><div class="step-circle">4</div><div class="step-label">Minat Bakat</div></div>
            <div class="step-item-nav" id="nav-4"><div class="step-circle">5</div><div class="step-label">Review</div></div>
        </div>

        <form id="spkForm" method="POST" action="{{ route('siswa.tes.simpan') }}" novalidate>
            @csrf

            {{-- STEP 0: PILIH JURUSAN --}}
            <div class="step-panel active" id="step-0">
                <div class="card">
                    <div class="card-header">
                        <div class="card-step-label">Langkah 1 dari 5</div>
                        <div class="card-title">🎓 Pilih 2 Jurusan untuk Dibandingkan</div>
                        <div class="card-sub">Pilih tepat 2 jurusan yang ingin kamu bandingkan.</div>
                    </div>
                    <div class="card-body">
                        <div class="alert-box alert-warn">
                            <span>💡</span>
                            <div><strong>Tips:</strong> Pilih jurusan yang benar-benar kamu minati. SAW akan membandingkan kesesuaian profilmu secara objektif.</div>
                        </div>

                        <div class="section-label">Jurusan Pilihan 1</div>
                        <div class="field" style="margin-bottom:20px">
                            <label>Jurusan Pertama <span class="req">*</span></label>
                            <select name="jurusan_pilihan_1" id="jurusan_pilihan_1" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusan as $j)
                                    <option value="{{ $j->id }}" {{ old('jurusan_pilihan_1') == $j->id ? 'selected' : '' }}>
                                        {{ $j->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="field-hint">Pilih jurusan pertama yang kamu minati</div>
                        </div>

                        <div class="section-label">Jurusan Pilihan 2</div>
                        <div class="field" style="margin-bottom:20px">
                            <label>Jurusan Kedua <span class="req">*</span></label>
                            <select name="jurusan_pilihan_2" id="jurusan_pilihan_2" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusan as $j)
                                    <option value="{{ $j->id }}" {{ old('jurusan_pilihan_2') == $j->id ? 'selected' : '' }}>
                                        {{ $j->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="field-hint">Pilih jurusan kedua yang berbeda dari pilihan pertama</div>
                        </div>

                        <div id="jurusanPreview" style="display:none; margin-top:8px">
                            <div class="section-label">Kamu akan membandingkan</div>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                                <div style="background:rgba(244,185,66,.08);border:1.5px solid rgba(244,185,66,.3);border-radius:12px;padding:16px;text-align:center">
                                    <div style="font-size:28px;margin-bottom:8px">🏫</div>
                                    <div style="font-size:10px;color:var(--text-dim);font-weight:700;text-transform:uppercase;margin-bottom:4px">Jurusan 1</div>
                                    <div id="previewJ1" style="font-size:14px;font-weight:700;color:var(--accent)">—</div>
                                </div>
                                <div style="background:rgba(224,123,84,.08);border:1.5px solid rgba(224,123,84,.3);border-radius:12px;padding:16px;text-align:center">
                                    <div style="font-size:28px;margin-bottom:8px">🏫</div>
                                    <div style="font-size:10px;color:var(--text-dim);font-weight:700;text-transform:uppercase;margin-bottom:4px">Jurusan 2</div>
                                    <div id="previewJ2" style="font-size:14px;font-weight:700;color:var(--accent2)">—</div>
                                </div>
                            </div>
                            <div style="text-align:center;margin-top:12px;font-size:12px;color:var(--text-dim)">⚖️ SAW akan menghitung dan membandingkan kesesuaian profilmu dengan kedua jurusan ini</div>
                        </div>
                    </div>
                </div>
                <div class="btn-nav">
                    <a href="{{ url('/') }}" class="btn-prev">🏠 Kembali ke Home</a>
                    <button type="button" class="btn-next" onclick="nextStep(0)">Selanjutnya: Data Fisik →</button>
                </div>
            </div>

            {{-- STEP 1: DATA FISIK --}}
            <div class="step-panel" id="step-1">
                <div class="card">
                    <div class="card-header">
                        <div class="card-step-label">Langkah 2 dari 5</div>
                        <div class="card-title">📏 Data Fisik &amp; Kesehatan</div>
                        <div class="card-sub">Isi data fisik kamu dengan jujur dan akurat</div>
                    </div>
                    <div class="card-body">
                        <div class="alert-box alert-warn">
                            <span>⚠️</span>
                            <div><strong>Catatan:</strong> Beberapa jurusan memiliki persyaratan fisik tertentu. Isi data yang sebenarnya.</div>
                        </div>

                        <div class="form-grid">
                            <div class="field">
                                <label>Tinggi Badan <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <input type="number" name="tinggi_badan" id="tinggi_badan" class="has-unit" placeholder="165" min="100" max="220" value="{{ old('tinggi_badan') }}" />
                                    <span class="input-unit">cm</span>
                                </div>
                                <div class="field-hint">Dalam satuan sentimeter</div>
                            </div>
                            <div class="field">
                                <label>Berat Badan <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <input type="number" name="berat_badan" id="berat_badan" class="has-unit" placeholder="55" min="20" max="200" value="{{ old('berat_badan') }}" />
                                    <span class="input-unit">kg</span>
                                </div>
                                <div class="field-hint">Dalam satuan kilogram</div>
                            </div>
                        </div>

                        <div id="bmiCard">
                            <div class="bmi-label">Indeks Massa Tubuh (BMI)</div>
                            <div class="bmi-row">
                                <div id="bmiValue" class="bmi-num">—</div>
                                <div>
                                    <div id="bmiCategory" class="bmi-cat">—</div>
                                    <div class="bmi-sub">Kategori BMI kamu</div>
                                </div>
                            </div>
                        </div>

                        <div class="section-label">Kondisi Kesehatan</div>
                        <div class="field" style="margin-bottom:18px">
                            <label>Apakah kamu mengalami buta warna? <span class="req">*</span></label>
                            <div class="toggle-group">
                                <div class="toggle-btn" id="btnButaYa" onclick="setButaWarna('ya')">🔴 Ya, Buta Warna</div>
                                <div class="toggle-btn" id="btnButaTidak" onclick="setButaWarna('tidak')">🟢 Tidak, Normal</div>
                            </div>
                            <input type="hidden" name="buta_warna" id="buta_warna" value="{{ old('buta_warna') }}" />
                        </div>
                    </div>
                </div>
                <div class="btn-nav">
                    <button type="button" class="btn-prev" onclick="prevStep(1)">← Kembali</button>
                    <button type="button" class="btn-next" onclick="nextStep(1)">Selanjutnya: Nilai Akademik →</button>
                </div>
            </div>

            {{-- STEP 2: NILAI AKADEMIK --}}
            <div class="step-panel" id="step-2">
                <div class="card">
                    <div class="card-header">
                        <div class="card-step-label">Langkah 3 dari 5</div>
                        <div class="card-title">📚 Nilai Akademik</div>
                        <div class="card-sub">Masukkan nilai mata pelajaran utama (skala 0 – 100)</div>
                    </div>
                    <div class="card-body">
                        <div class="section-label">Mata Pelajaran</div>
                        <div class="nilai-grid">
                            <div class="nilai-card">
                                <div class="nilai-label">Matematika</div>
                                <input type="number" name="nilai_matematika" class="nilai-input" placeholder="85" min="0" max="100" value="{{ old('nilai_matematika') }}" />
                                <div class="nilai-scale">0 – 100</div>
                            </div>
                            <div class="nilai-card">
                                <div class="nilai-label">Bahasa Indonesia</div>
                                <input type="number" name="nilai_bahasa_indonesia" class="nilai-input" placeholder="85" min="0" max="100" value="{{ old('nilai_bahasa_indonesia') }}" />
                                <div class="nilai-scale">0 – 100</div>
                            </div>
                            <div class="nilai-card">
                                <div class="nilai-label">Bahasa Inggris</div>
                                <input type="number" name="nilai_bahasa_inggris" class="nilai-input" placeholder="85" min="0" max="100" value="{{ old('nilai_bahasa_inggris') }}" />
                                <div class="nilai-scale">0 – 100</div>
                            </div>
                            <div class="nilai-card">
                                <div class="nilai-label">IPA</div>
                                <input type="number" name="nilai_ipa" class="nilai-input" placeholder="85" min="0" max="100" value="{{ old('nilai_ipa') }}" />
                                <div class="nilai-scale">0 – 100</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-nav">
                    <button type="button" class="btn-prev" onclick="prevStep(2)">← Kembali</button>
                    <button type="button" class="btn-next" onclick="nextStep(2)">Selanjutnya: Minat Bakat →</button>
                </div>
            </div>

            {{-- STEP 3: MINAT BAKAT --}}
            <div class="step-panel" id="step-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-step-label">Langkah 4 dari 5</div>
                        <div class="card-title">🧠 Tes Minat &amp; Bakat</div>
                        <div class="card-sub">Pilih jawaban yang paling menggambarkan dirimu</div>
                    </div>

                    <div class="card-body">
                        @php
                            $opsiJawaban = [
                                1 => 'Sangat Tidak Setuju',
                                2 => 'Tidak Setuju',
                                3 => 'Setuju',
                                4 => 'Sangat Setuju'
                            ];
                        @endphp

                        @if($soal->count() > 0)
                            @foreach($soal as $i => $s)
                                <div class="bakat-question {{ old('bakat_q'.($i+1)) ? 'answered' : '' }}" id="bq_{{ $i+1 }}">
                                    <div class="bakat-q-num">Pertanyaan {{ $i+1 }}</div>
                                    <div class="bakat-q-text">{{ $s->pertanyaan }}</div>

                                    <div class="bakat-options">
                                        @foreach($opsiJawaban as $val => $lbl)
                                            <label class="bakat-opt {{ old('bakat_q'.($i+1)) == $val ? 'selected' : '' }}" onclick="pilihBakat(this, {{ $i+1 }})">
                                                <input
                                                    type="radio"
                                                    name="bakat_q{{ $i+1 }}"
                                                    value="{{ $val }}"
                                                    {{ old('bakat_q'.($i+1)) == $val ? 'checked' : '' }}
                                                />
                                                {{ $lbl }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert-box alert-warn">
                                ⚠ Soal minat belum tersedia. Hubungi admin.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="btn-nav">
                    <button type="button" class="btn-prev" onclick="prevStep(3)">← Kembali</button>
                    <button type="button" class="btn-next" onclick="nextStep(3)">Review &amp; Kirim →</button>
                </div>
            </div>

            {{-- STEP 4: REVIEW --}}
            <div class="step-panel" id="step-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-step-label">Langkah 5 dari 5</div>
                        <div class="card-title">✅ Review &amp; Kirim</div>
                        <div class="card-sub">Periksa kembali semua data sebelum dikirim</div>
                    </div>
                    <div class="card-body">
                        <div class="review-section">
                            <div class="review-title">🎓 Jurusan Pilihan</div>
                            <div class="review-grid">
                                <div class="review-item"><div class="review-item-label">Jurusan Pilihan 1</div><div class="review-item-value" id="rev-jurusan1">—</div></div>
                                <div class="review-item"><div class="review-item-label">Jurusan Pilihan 2</div><div class="review-item-value" id="rev-jurusan2">—</div></div>
                            </div>
                        </div>

                        <div class="review-section">
                            <div class="review-title">📏 Data Fisik</div>
                            <div class="review-grid">
                                <div class="review-item"><div class="review-item-label">Tinggi Badan</div><div class="review-item-value" id="rev-tinggi">—</div></div>
                                <div class="review-item"><div class="review-item-label">Berat Badan</div><div class="review-item-value" id="rev-berat">—</div></div>
                                <div class="review-item"><div class="review-item-label">BMI</div><div class="review-item-value" id="rev-bmi">—</div></div>
                                <div class="review-item"><div class="review-item-label">Buta Warna</div><div class="review-item-value" id="rev-buta">—</div></div>
                            </div>
                        </div>

                        <div class="review-section">
                            <div class="review-title">Nilai Akademik</div>
                            <div class="review-grid">
                                <div class="review-item"><div class="review-item-label">Matematika</div><div class="review-item-value" id="rev-mtk">—</div></div>
                                <div class="review-item"><div class="review-item-label">Bahasa Indonesia</div><div class="review-item-value" id="rev-bind">—</div></div>
                                <div class="review-item"><div class="review-item-label">Bahasa Inggris</div><div class="review-item-value" id="rev-bing">—</div></div>
                                <div class="review-item"><div class="review-item-label">IPA</div><div class="review-item-value" id="rev-ipa">—</div></div>
                            </div>
                        </div>

                        <div class="review-section">
                            <div class="review-title">Minat Bakat</div>
                            <div class="review-grid" id="rev-bakat-grid"></div>
                        </div>

                        <label class="setuju-box" id="setujuBox">
                            <input type="checkbox" name="setuju" id="setujuCheck" value="1" onchange="toggleSetuju(this)" {{ old('setuju') == '1' ? 'checked' : '' }} />
                            <div class="setuju-box-text">
                                Saya menyatakan bahwa data yang saya isi adalah <strong>benar dan akurat</strong>.
                                Saya bersedia menerima rekomendasi jurusan berdasarkan hasil analisis SAW.
                            </div>
                        </label>
                    </div>
                </div>
                <div class="btn-nav">
                    <button type="button" class="btn-prev" onclick="prevStep(4)">← Kembali</button>
                    <button type="submit" class="btn-submit" id="btnSubmit" disabled>⚡ Kirim &amp; Hitung SAW</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentStep = 0;
    const pct = [20, 40, 60, 80, 100];
    const labels = [
        'Langkah 1 dari 5 — Pilih Jurusan',
        'Langkah 2 dari 5 — Data Fisik',
        'Langkah 3 dari 5 — Nilai Akademik',
        'Langkah 4 dari 5 — Minat Bakat',
        'Langkah 5 dari 5 — Review & Kirim'
    ];

    const jumlahSoal = {{ $soal->count() }};
    const oldSetuju = @json(old('setuju'));
    const oldButaWarna = @json(old('buta_warna'));

    function updateStepper(step) {
        for (let i = 0; i < 5; i++) {
            const nav = document.getElementById('nav-' + i);
            const circle = nav.querySelector('.step-circle');
            nav.classList.remove('active', 'done');

            if (i < step) {
                nav.classList.add('done');
                circle.innerHTML = '✓';
            } else if (i === step) {
                nav.classList.add('active');
                circle.innerHTML = i + 1;
            } else {
                circle.innerHTML = i + 1;
            }
        }

        document.getElementById('progressFill').style.width = pct[step] + '%';
        document.getElementById('progressLabel').textContent = labels[step];
        document.getElementById('progressPct').textContent = pct[step] + '%';
    }

    function showStep(step) {
        document.querySelectorAll('.step-panel').forEach(p => p.classList.remove('active'));
        document.getElementById('step-' + step).classList.add('active');
        updateStepper(step);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function nextStep(from) {
        if (!validateStep(from)) return;
        if (from === 3) buildReview();
        currentStep = from + 1;
        showStep(currentStep);
    }

    function prevStep(from) {
        currentStep = from - 1;
        showStep(currentStep);
    }

    function validateStep(step) {
        if (step === 0) {
            const j1 = document.getElementById('jurusan_pilihan_1').value;
            const j2 = document.getElementById('jurusan_pilihan_2').value;

            if (!j1 || !j2) {
                showToast('⚠ Harap pilih 2 jurusan terlebih dahulu!');
                return false;
            }

            if (j1 === j2) {
                showToast('⚠ Pilih 2 jurusan yang BERBEDA!');
                return false;
            }
        }

        if (step === 1) {
            const t = document.getElementById('tinggi_badan').value;
            const b = document.getElementById('berat_badan').value;
            const w = document.getElementById('buta_warna').value;

            if (!t || !b) {
                showToast('⚠ Harap isi tinggi dan berat badan!');
                return false;
            }

            if (!w) {
                showToast('⚠ Harap pilih status buta warna!');
                return false;
            }
        }

        if (step === 2) {
            const fields = [
                'nilai_matematika',
                'nilai_bahasa_indonesia',
                'nilai_bahasa_inggris',
                'nilai_ipa'
            ];

            for (const f of fields) {
                const el = document.querySelector(`[name="${f}"]`);
                if (!el || el.value.trim() === '') {
                    showToast('⚠ Harap isi semua nilai akademik!');
                    if (el) el.focus();
                    return false;
                }

                const value = parseFloat(el.value);
                if (isNaN(value) || value < 0 || value > 100) {
                    showToast('⚠ Nilai harus antara 0 sampai 100!');
                    el.focus();
                    return false;
                }
            }
        }

        if (step === 3) {
            if (jumlahSoal < 1) {
                showToast('⚠ Soal minat belum tersedia.');
                return false;
            }

            for (let i = 1; i <= jumlahSoal; i++) {
                const checked = document.querySelector(`input[name="bakat_q${i}"]:checked`);
                if (!checked) {
                    showToast(`⚠ Harap jawab pertanyaan minat nomor ${i}!`);
                    const box = document.getElementById(`bq_${i}`);
                    if (box) box.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return false;
                }
            }
        }

        return true;
    }

    function showToast(msg) {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.style.display = 'block';
        clearTimeout(window.__toastTimer);
        window.__toastTimer = setTimeout(() => {
            toast.style.display = 'none';
        }, 2500);
    }

    function setButaWarna(value) {
        document.getElementById('buta_warna').value = value;

        const btnYa = document.getElementById('btnButaYa');
        const btnTidak = document.getElementById('btnButaTidak');

        btnYa.classList.remove('sel-ya');
        btnTidak.classList.remove('sel-tidak');

        if (value === 'ya') {
            btnYa.classList.add('sel-ya');
        } else if (value === 'tidak') {
            btnTidak.classList.add('sel-tidak');
        }
    }

    function hitungBmi() {
        const tinggi = parseFloat(document.getElementById('tinggi_badan').value);
        const berat = parseFloat(document.getElementById('berat_badan').value);
        const card = document.getElementById('bmiCard');
        const bmiValue = document.getElementById('bmiValue');
        const bmiCategory = document.getElementById('bmiCategory');

        if (!tinggi || !berat || tinggi <= 0 || berat <= 0) {
            card.style.display = 'none';
            return null;
        }

        const bmi = berat / Math.pow((tinggi / 100), 2);
        const bmiRounded = bmi.toFixed(1);

        let kategori = '—';
        if (bmi < 18.5) {
            kategori = 'Berat Badan Kurang';
        } else if (bmi < 25) {
            kategori = 'Normal / Ideal';
        } else if (bmi < 30) {
            kategori = 'Berat Badan Lebih';
        } else {
            kategori = 'Obesitas';
        }

        bmiValue.textContent = bmiRounded;
        bmiCategory.textContent = kategori;
        card.style.display = 'block';

        return {
            nilai: bmiRounded,
            kategori: kategori
        };
    }

    function pilihBakat(labelEl, no) {
        const wrapper = document.getElementById(`bq_${no}`);
        if (!wrapper) return;

        wrapper.querySelectorAll('.bakat-opt').forEach(opt => opt.classList.remove('selected'));
        labelEl.classList.add('selected');

        const radio = labelEl.querySelector('input[type="radio"]');
        if (radio) {
            radio.checked = true;
        }

        wrapper.classList.add('answered');
    }

    function updateJurusanPreview() {
        const j1 = document.getElementById('jurusan_pilihan_1');
        const j2 = document.getElementById('jurusan_pilihan_2');
        const preview = document.getElementById('jurusanPreview');
        const p1 = document.getElementById('previewJ1');
        const p2 = document.getElementById('previewJ2');

        const text1 = j1.options[j1.selectedIndex]?.text || '—';
        const text2 = j2.options[j2.selectedIndex]?.text || '—';

        p1.textContent = j1.value ? text1 : '—';
        p2.textContent = j2.value ? text2 : '—';

        preview.style.display = (j1.value || j2.value) ? 'block' : 'none';
    }

    function toggleSetuju(el) {
        const submitBtn = document.getElementById('btnSubmit');
        const setujuBox = document.getElementById('setujuBox');

        submitBtn.disabled = !el.checked;

        if (el.checked) {
            setujuBox.classList.add('active');
        } else {
            setujuBox.classList.remove('active');
        }
    }

    function buildReview() {
        const s = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.textContent = val;
        };

        const getSelectText = (id) => {
            const el = document.getElementById(id);
            if (!el || !el.value) return '—';
            return el.options[el.selectedIndex]?.text || '—';
        };

        s('rev-jurusan1', getSelectText('jurusan_pilihan_1'));
        s('rev-jurusan2', getSelectText('jurusan_pilihan_2'));

        const tinggi = document.getElementById('tinggi_badan')?.value || '';
        const berat = document.getElementById('berat_badan')?.value || '';
        s('rev-tinggi', tinggi ? `${tinggi} cm` : '—');
        s('rev-berat', berat ? `${berat} kg` : '—');

        const bmi = hitungBmi();
        s('rev-bmi', bmi ? `${bmi.nilai} (${bmi.kategori})` : '—');

        const butaWarna = document.getElementById('buta_warna')?.value || '';
        s('rev-buta', butaWarna === 'ya' ? 'Ya, Buta Warna' : (butaWarna === 'tidak' ? 'Tidak' : '—'));

        s('rev-mtk', document.querySelector('[name="nilai_matematika"]')?.value || '—');
        s('rev-bind', document.querySelector('[name="nilai_bahasa_indonesia"]')?.value || '—');
        s('rev-bing', document.querySelector('[name="nilai_bahasa_inggris"]')?.value || '—');
        s('rev-ipa', document.querySelector('[name="nilai_ipa"]')?.value || '—');

        const jawabanMap = {
            1: 'Sangat Tidak Setuju',
            2: 'Tidak Setuju',
            3: 'Setuju',
            4: 'Sangat Setuju'
        };

        const grid = document.getElementById('rev-bakat-grid');
        grid.innerHTML = '';

        for (let i = 1; i <= jumlahSoal; i++) {
            const checked = document.querySelector(`input[name="bakat_q${i}"]:checked`);
            const value = checked ? jawabanMap[checked.value] : '—';

            const item = document.createElement('div');
            item.className = 'review-item';
            item.innerHTML = `
                <div class="review-item-label">Pertanyaan ${i}</div>
                <div class="review-item-value">${value}</div>
            `;
            grid.appendChild(item);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateStepper(0);
        updateJurusanPreview();
        hitungBmi();

        document.getElementById('jurusan_pilihan_1')?.addEventListener('change', updateJurusanPreview);
        document.getElementById('jurusan_pilihan_2')?.addEventListener('change', updateJurusanPreview);
        document.getElementById('tinggi_badan')?.addEventListener('input', hitungBmi);
        document.getElementById('berat_badan')?.addEventListener('input', hitungBmi);

        if (oldButaWarna === 'ya' || oldButaWarna === 'tidak') {
            setButaWarna(oldButaWarna);
        }

        const setujuCheck = document.getElementById('setujuCheck');
        if (setujuCheck && oldSetuju === '1') {
            setujuCheck.checked = true;
            toggleSetuju(setujuCheck);
        }

        @if($errors->any())
            const oldInputs = {
                jurusan1: @json(old('jurusan_pilihan_1')),
                jurusan2: @json(old('jurusan_pilihan_2')),
                tinggi: @json(old('tinggi_badan')),
                berat: @json(old('berat_badan')),
                buta: @json(old('buta_warna')),
                mtk: @json(old('nilai_matematika')),
                bind: @json(old('nilai_bahasa_indonesia')),
                bing: @json(old('nilai_bahasa_inggris')),
                ipa: @json(old('nilai_ipa'))
            };

            if (oldInputs.mtk || oldInputs.bind || oldInputs.bing || oldInputs.ipa) {
                currentStep = 2;
            }
            if (oldInputs.tinggi || oldInputs.berat || oldInputs.buta) {
                currentStep = 1;
            }
            if (oldInputs.jurusan1 || oldInputs.jurusan2) {
                currentStep = Math.max(currentStep, 0);
            }

            let adaJawabanMinat = false;
            for (let i = 1; i <= jumlahSoal; i++) {
                if (@json(old())[`bakat_q${i}`]) {
                    adaJawabanMinat = true;
                    break;
                }
            }

            if (adaJawabanMinat) {
                currentStep = 3;
            }

            showStep(currentStep);
        @endif
    });
</script>
@endpush