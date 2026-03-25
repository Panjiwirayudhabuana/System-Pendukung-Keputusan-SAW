<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>@yield('title','Dashboard') — BK SMK Negeri 2 Jember</title>
@vite(['resources/css/app.css','resources/js/app.js'])
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
@stack('styles')
<style>
:root{
    --primary:#1a3c6e;--primary-dark:#0f2548;--primary-mid:#1e4a85;
    --accent:#e8a020;--accent-soft:#fff8ec;
    --bg:#f0f4fa;--surface:#ffffff;--surface2:#f7f9fc;
    --border:#e2e8f0;--text:#1e2a3a;--text-mid:#4a5568;--text-dim:#8899aa;
    --green:#16a34a;--green-bg:#f0fdf4;--green-border:#bbf7d0;
    --red:#dc2626;--red-bg:#fef2f2;--red-border:#fecaca;
    --yellow:#d97706;--yellow-bg:#fffbeb;--yellow-border:#fde68a;
    --blue:#2563eb;--blue-bg:#eff6ff;--blue-border:#bfdbfe;
    --sidebar-w:240px;--header-h:60px;
    --radius:12px;--radius-sm:8px;
    --shadow:0 1px 3px rgba(0,0,0,.08),0 4px 16px rgba(0,0,0,.06);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{background:var(--bg);color:var(--text);font-family:'Plus Jakarta Sans',sans-serif;min-height:100vh;}
.bk-sidebar{position:fixed;top:0;left:0;bottom:0;width:var(--sidebar-w);background:var(--primary-dark);z-index:100;display:flex;flex-direction:column;box-shadow:4px 0 20px rgba(0,0,0,.15);}
.sb-brand{padding:18px 20px 16px;border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:12px;}
.sb-logo{width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,var(--accent),#f97316);display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-size:15px;font-weight:800;color:#fff;flex-shrink:0;}
.sb-name{font-size:11px;font-weight:700;color:#fff;}
.sb-role{font-size:10px;color:rgba(255,255,255,.45);margin-top:1px;}
.sb-nav{flex:1;padding:16px 12px;overflow-y:auto;}
.sb-section{font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,.3);padding:0 8px;margin:14px 0 5px;}
.sb-section:first-child{margin-top:0;}
.sb-item{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:var(--radius-sm);font-size:12.5px;font-weight:500;color:rgba(255,255,255,.65);text-decoration:none;transition:all .18s;margin-bottom:2px;}
.sb-item:hover{background:rgba(255,255,255,.08);color:#fff;}
.sb-item.active{background:linear-gradient(135deg,var(--accent),#f97316);color:#fff;font-weight:700;box-shadow:0 4px 12px rgba(232,160,32,.3);}
.sb-icon{font-size:16px;width:20px;text-align:center;flex-shrink:0;}
.sb-user{padding:14px 16px;border-top:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:10px;}
.sb-avatar{width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,var(--accent),#f97316);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px;color:#fff;flex-shrink:0;}
.sb-uname{font-size:11.5px;font-weight:700;color:#fff;}
.sb-unip{font-size:10px;color:rgba(255,255,255,.4);}
.sb-logout{margin-left:auto;color:rgba(255,255,255,.35);font-size:18px;background:none;border:none;cursor:pointer;}
.sb-logout:hover{color:var(--accent);}
.bk-main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column;}
.bk-topbar{height:var(--header-h);background:var(--surface);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 28px;position:sticky;top:0;z-index:50;}
.tb-title{font-family:'Playfair Display',serif;font-size:17px;font-weight:700;color:var(--primary-dark);}
.tb-sub{font-size:11px;color:var(--text-dim);margin-top:1px;}
.tb-date{font-size:11.5px;color:var(--text-mid);background:var(--surface2);border:1px solid var(--border);padding:5px 12px;border-radius:var(--radius-sm);}
.bk-content{flex:1;padding:24px 28px 40px;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);}
.card-head{padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;}
.card-title{font-size:13.5px;font-weight:700;color:var(--primary-dark);}
.btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:var(--radius-sm);font-size:12.5px;font-weight:700;cursor:pointer;transition:all .18s;border:none;font-family:'Plus Jakarta Sans',sans-serif;text-decoration:none;}
.btn-primary{background:linear-gradient(135deg,var(--primary),var(--primary-mid));color:#fff;box-shadow:0 3px 10px rgba(26,60,110,.25);}
.btn-primary:hover{transform:translateY(-1px);}
.btn-outline{background:var(--surface);border:1.5px solid var(--border);color:var(--text-mid);}
.btn-outline:hover{border-color:var(--primary);color:var(--primary);}
.btn-danger{background:var(--red-bg);border:1px solid var(--red-border);color:var(--red);}
.btn-danger:hover{background:var(--red);color:#fff;}
.btn-sm{padding:5px 12px;font-size:11.5px;}
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:100px;font-size:10.5px;font-weight:700;}
.badge-green{background:var(--green-bg);color:var(--green);border:1px solid var(--green-border);}
.badge-blue{background:var(--blue-bg);color:var(--blue);border:1px solid var(--blue-border);}
.badge-red{background:var(--red-bg);color:var(--red);border:1px solid var(--red-border);}
.badge-gray{background:var(--surface2);color:var(--text-dim);border:1px solid var(--border);}
.badge-amber{background:var(--accent-soft);color:var(--accent);border:1px solid #fde68a;}
.alert{padding:12px 16px;border-radius:var(--radius-sm);font-size:13px;display:flex;align-items:flex-start;gap:10px;margin-bottom:16px;}
.alert-success{background:var(--green-bg);border:1px solid var(--green-border);border-left:3px solid var(--green);color:var(--green);}
.alert-warning{background:var(--yellow-bg);border:1px solid var(--yellow-border);border-left:3px solid var(--yellow);color:var(--yellow);}
.alert-info{background:var(--blue-bg);border:1px solid var(--blue-border);border-left:3px solid var(--blue);color:var(--blue);}
.alert-danger{background:var(--red-bg);border:1px solid var(--red-border);border-left:3px solid var(--red);color:var(--red);}
table{width:100%;border-collapse:collapse;}
thead tr{background:var(--surface2);}
th{padding:10px 16px;text-align:left;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--text-dim);border-bottom:1px solid var(--border);}
td{padding:12px 16px;font-size:12.5px;color:var(--text);border-bottom:1px solid var(--border);}
tr:last-child td{border-bottom:none;}
tr:hover td{background:var(--surface2);}
.form-group{margin-bottom:16px;}
.form-label{display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-mid);margin-bottom:7px;}
.req{color:var(--red);}
.form-control{width:100%;background:var(--surface2);border:1.5px solid var(--border);border-radius:var(--radius-sm);color:var(--text);font-family:'Plus Jakarta Sans',sans-serif;font-size:13px;padding:10px 14px;outline:none;transition:all .2s;}
.form-control:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(26,60,110,.08);background:#fff;}
textarea.form-control{resize:vertical;min-height:90px;}
.form-hint{font-size:11px;color:var(--text-dim);margin-top:5px;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.form-actions{display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid var(--border);margin-top:20px;}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}
@media(max-width:900px){
    .bk-sidebar{transform:translateX(-100%);transition:transform .3s;}
    .bk-sidebar.open{transform:translateX(0);}
    .bk-main{margin-left:0;}
    .bk-content{padding:16px;}
    .form-row{grid-template-columns:1fr;}
}
</style>
</head>
<body>

<aside class="bk-sidebar" id="bk-sidebar">
    <div class="sb-brand">
        <div class="sb-logo">BK</div>
        <div>
            <div class="sb-name">SMK Negeri 2 Jember</div>
            <div class="sb-role">Panel Guru BK</div>
        </div>
    </div>
    <nav class="sb-nav">
        <div class="sb-section">Menu Utama</div>

        <a href="{{ route('bk.dashboard') }}" class="sb-item {{ request()->routeIs('bk.dashboard') ? 'active':'' }}">
            <span class="sb-icon">🏠</span> Dashboard
        </a>

        <a href="{{ route('landing.home') }}" class="sb-item {{ request()->routeIs('landing.home') ? 'active':'' }}">
            <span class="sb-icon">🌐</span> Landing Page
        </a>

        <a href="{{ route('bk.siswa.index') }}" class="sb-item {{ request()->routeIs('bk.siswa.*') ? 'active':'' }}">
            <span class="sb-icon">👨‍🎓</span> Data Siswa
        </a>

        <a href="{{ route('bk.statistik') }}" class="sb-item {{ request()->routeIs('bk.statistik') ? 'active':'' }}">
            <span class="sb-icon">📊</span> Statistik Jurusan
        </a>

        <div class="sb-section">Konten</div>

        <a href="{{ route('bk.artikel.index') }}" class="sb-item {{ request()->routeIs('bk.artikel.*') ? 'active':'' }}">
            <span class="sb-icon">📝</span> Artikel Jurusan
        </a>

        <a href="{{ route('bk.infojurusan.index') }}" class="sb-item {{ request()->routeIs('bk.infojurusan.*') ? 'active':'' }}">
            <span class="sb-icon">🏫</span> Info Jurusan
        </a>

        <div class="sb-section">Akun</div>

        <a href="{{ route('bk.profil') }}" class="sb-item {{ request()->routeIs('bk.profil') ? 'active':'' }}">
            <span class="sb-icon">👤</span> Profil Saya
        </a>

        <a href="{{ route('bk.password.index') }}" class="sb-item {{ request()->routeIs('bk.password.*') ? 'active':'' }}">
            <span class="sb-icon">🔒</span> Ubah Password
        </a>
    </nav>
    <div class="sb-user">
        <div class="sb-avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
        <div>
            <div class="sb-uname">{{ Auth::user()->nama }}</div>
            <div class="sb-unip">{{ Auth::user()->guruBk->nip ?? 'Guru BK' }}</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sb-logout" title="Logout">⏻</button>
        </form>
    </div>
</aside>

<div class="bk-main">
    <div class="bk-topbar">
        <div>
            <div class="tb-title">@yield('page-title','Dashboard')</div>
            <div class="tb-sub">@yield('page-sub','')</div>
        </div>
        <div class="tb-date">{{ now()->translatedFormat('l, d F Y') }}</div>
    </div>

    <div class="bk-content">
        @if($errors->any())
            <div class="alert alert-danger">
                <div><strong>⚠ Perbaiki:</strong>
                    <ul style="padding-left:16px;margin-top:4px;">
                        @foreach($errors->all() as $e)<li style="font-size:12px;">{{ $e }}</li>@endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>