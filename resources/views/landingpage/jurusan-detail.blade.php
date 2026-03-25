<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $jurusan->nama_jurusan }} · SMKN 2 Jember</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --navy:  #0d1b3e;
    --navy2: #162347;
    --blue:  #2563eb;
    --gold:  #f59e0b;
    --gold2: #fbbf24;
    --white: #ffffff;
    --gray:  #94a3b8;
    --light: #f8fafc;
    --border:#e2e8f0;
    --text:  #1e293b;
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--light);
    color: var(--text);
    min-height: 100vh;
}

/* ── NAVBAR ── */
.navbar {
    background: var(--navy);
    padding: 0 48px;
    display: flex; align-items: center; justify-content: space-between;
    height: 64px;
    position: sticky; top: 0; z-index: 100;
    box-shadow: 0 2px 20px rgba(0,0,0,.3);
}
.navbar::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 24px 24px; pointer-events: none;
}
.nav-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; }
.nav-logo {
    width: 38px; height: 38px;
    background: linear-gradient(135deg, var(--blue), var(--gold));
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif; font-weight: 800; font-size: 14px; color: #fff;
}
.nav-name { font-family: 'Playfair Display', serif; font-weight: 800; font-size: 13px; color: #fff; line-height: 1.3; }
.nav-sub  { font-size: 10px; color: var(--gray); }
.nav-back {
    display: flex; align-items: center; gap: 6px;
    color: rgba(255,255,255,.7); text-decoration: none;
    font-size: 13px; font-weight: 500;
    transition: color .2s;
}
.nav-back:hover { color: var(--gold); }

/* ── HERO ── */
.hero {
    background: linear-gradient(135deg, var(--navy) 0%, #1a2d6b 100%);
    position: relative; overflow: hidden;
    padding: 64px 0 80px;
}
.hero::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.05) 1px, transparent 1px);
    background-size: 28px 28px; pointer-events: none;
}
.hero-deco {
    position: absolute; border-radius: 50%; pointer-events: none;
}
.hero-deco-1 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(37,99,235,.2) 0%, transparent 70%);
    bottom: -100px; right: -100px;
}
.hero-deco-2 {
    width: 250px; height: 250px;
    background: radial-gradient(circle, rgba(245,158,11,.12) 0%, transparent 70%);
    top: -40px; left: 30%;
}

.container { max-width: 1080px; margin: 0 auto; padding: 0 32px; }

.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(245,158,11,.15); border: 1px solid rgba(245,158,11,.35);
    border-radius: 100px; padding: 5px 14px;
    font-size: 11.5px; font-weight: 600; color: var(--gold2);
    margin-bottom: 18px;
    animation: fadeUp .5s ease both;
}
.hero-badge span { width: 5px; height: 5px; border-radius: 50%; background: var(--gold); display: block; }

.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 4vw, 48px);
    font-weight: 800; line-height: 1.2;
    color: #fff; margin-bottom: 16px;
    animation: fadeUp .5s .1s ease both;
}
.hero-title em { font-style: italic; color: var(--gold); }

.hero-desc {
    font-size: 15px; color: rgba(255,255,255,.65);
    line-height: 1.75; max-width: 560px;
    margin-bottom: 32px;
    animation: fadeUp .5s .2s ease both;
}

.hero-cta {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--gold), #d97706);
    color: var(--navy); font-weight: 700; font-size: 14px;
    padding: 12px 24px; border-radius: 10px; text-decoration: none;
    box-shadow: 0 6px 20px rgba(245,158,11,.35);
    transition: transform .15s, box-shadow .15s;
    animation: fadeUp .5s .3s ease both;
}
.hero-cta:hover { transform: translateY(-1px); box-shadow: 0 10px 28px rgba(245,158,11,.45); }

/* ── TABS ── */
.tabs-wrap {
    background: #fff;
    border-bottom: 1px solid var(--border);
    position: sticky; top: 64px; z-index: 50;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
}
.tabs {
    max-width: 1080px; margin: 0 auto; padding: 0 32px;
    display: flex; gap: 0;
}
.tab {
    padding: 16px 20px;
    font-size: 13px; font-weight: 600;
    color: var(--gray); text-decoration: none;
    border-bottom: 2px solid transparent;
    transition: color .2s, border-color .2s;
    cursor: pointer; white-space: nowrap;
}
.tab:hover { color: var(--blue); }
.tab.active { color: var(--blue); border-bottom-color: var(--blue); }

/* ── MAIN CONTENT ── */
.main { padding: 48px 0 80px; }

.section { margin-bottom: 56px; scroll-margin-top: 130px; }

.section-header {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 24px;
}
.section-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; flex-shrink: 0;
}
.section-icon.blue  { background: #eff6ff; }
.section-icon.gold  { background: #fffbeb; }
.section-icon.green { background: #f0fdf4; }
.section-icon.purple{ background: #faf5ff; }

.section-title {
    font-family: 'Playfair Display', serif;
    font-size: 20px; font-weight: 800; color: var(--navy);
}
.section-sub { font-size: 12px; color: var(--gray); margin-top: 2px; }

/* FASILITAS */
.fasilitas-box {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 28px 32px;
    font-size: 14px; color: #374151; line-height: 1.85;
    white-space: pre-line;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
    border-left: 3px solid var(--blue);
}

/* PROSPEK */
.prospek-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

.prospek-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
}
.prospek-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 14px; font-weight: 800; color: var(--navy);
    margin-bottom: 14px;
    display: flex; align-items: center; gap: 8px;
}
.prospek-list { display: flex; flex-wrap: wrap; gap: 8px; }
.prospek-tag {
    padding: 5px 13px; border-radius: 100px;
    font-size: 12px; font-weight: 600;
}
.prospek-tag.umum   { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
.prospek-tag.alumni { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }

.empty-state {
    background: var(--light);
    border: 1.5px dashed var(--border);
    border-radius: 12px;
    padding: 28px;
    text-align: center;
    font-size: 13px; color: var(--gray);
}

/* ARTIKEL */
.artikel-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }

.artikel-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px; overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
    transition: transform .2s, box-shadow .2s;
    text-decoration: none; color: inherit;
}
.artikel-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1); }

.artikel-img {
    width: 100%; height: 140px; object-fit: cover;
    display: block;
}
.artikel-img-placeholder {
    width: 100%; height: 140px;
    background: linear-gradient(135deg, var(--navy), #1a2d6b);
    display: flex; align-items: center; justify-content: center;
    font-size: 36px;
}
.artikel-body { padding: 16px; }
.artikel-date { font-size: 11px; color: var(--gray); margin-bottom: 6px; }
.artikel-title { font-family: 'Playfair Display', serif; font-size: 14px; font-weight: 700; color: var(--navy); line-height: 1.4; margin-bottom: 8px; }
.artikel-file { font-size: 11px; color: var(--blue); display: flex; align-items: center; gap: 4px; }

.artikel-card {
    cursor: pointer;
}
/* EMPTY */
.empty-artikel {
    grid-column: 1 / -1;
    text-align: center; padding: 48px;
    color: var(--gray); font-size: 14px;
}

/* ANIMATIONS */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .navbar { padding: 0 20px; }
    .container { padding: 0 20px; }
    .tabs { gap: 0; overflow-x: auto; }
    .prospek-grid { grid-template-columns: 1fr; }
    .artikel-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 520px) {
    .artikel-grid { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="{{ route('landing.home') }}" class="nav-brand">
        <div class="nav-logo">S2J</div>
        <div>
            <div class="nav-name">SMK NEGERI 2 JEMBER</div>
            <div class="nav-sub">Sistem Pendukung Keputusan Pemilihan Jurusan</div>
        </div>
    </a>
    <a href="{{ url()->previous() }}" class="nav-back">← Kembali</a>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-deco hero-deco-1"></div>
    <div class="hero-deco hero-deco-2"></div>
    <div class="container">
        <div class="hero-badge"><span></span> Program Keahlian</div>
        <h1 class="hero-title">{{ $jurusan->nama_jurusan }}</h1>
        <p class="hero-desc">
            {{ $info->deskripsi ?? 'Temukan informasi lengkap tentang program keahlian ini — mulai dari fasilitas, prospek karir, hingga artikel terbaru dari jurusan.' }}
        </p>
        @guest
        <a href="{{ route('register') }}" class="hero-cta">
            ✨ Ikuti Tes Jurusan
        </a>
        @endguest
    </div>
</section>

{{-- TABS --}}
<div class="tabs-wrap">
    <div class="tabs">
        <a class="tab active" onclick="scrollToSection('fasilitas', this)">🏗️ Fasilitas</a>
        <a class="tab" onclick="scrollToSection('prospek', this)">💼 Prospek Kerja</a>
        <a class="tab" onclick="scrollToSection('artikel', this)">📰 Artikel</a>    
    </div>
</div>

{{-- MAIN --}}
<div class="main">
    <div class="container">

        {{-- FASILITAS --}}
        <div class="section" id="fasilitas">
            <div class="section-header">
                <div class="section-icon blue">🏗️</div>
                <div>
                    <div class="section-title">Fasilitas Jurusan</div>
                    <div class="section-sub">Sarana & prasarana yang tersedia</div>
                </div>
            </div>
            @if($info && $info->fasilitas)
                <div class="fasilitas-box">{{ $info->fasilitas }}</div>
            @else
                <div class="empty-state">Informasi fasilitas belum tersedia.</div>
            @endif
        </div>

        {{-- PROSPEK KERJA --}}
        <div class="section" id="prospek">
            <div class="section-header">
                <div class="section-icon gold">💼</div>
                <div>
                    <div class="section-title">Prospek Kerja</div>
                    <div class="section-sub">Peluang karir & pencapaian alumni</div>
                </div>
            </div>
            <div class="prospek-grid">
                <div class="prospek-card">
                    <div class="prospek-card-title">💼 Prospek Kerja Umum</div>
                    @if($prospekUmum->count())
                        <div class="prospek-list">
                            @foreach($prospekUmum as $p)
                                <span class="prospek-tag umum">{{ $p->isi }}</span>
                            @endforeach
                        </div>
                    @else
                        <div style="font-size:13px;color:#94a3b8;font-style:italic;">Belum ada data.</div>
                    @endif
                </div>
                <div class="prospek-card">
                    <div class="prospek-card-title">🎓 Prospek Alumni</div>
                    @if($prospekAlumni->count())
                        <div class="prospek-list">
                            @foreach($prospekAlumni as $p)
                                <span class="prospek-tag alumni">{{ $p->isi }}</span>
                            @endforeach
                        </div>
                    @else
                        <div style="font-size:13px;color:#94a3b8;font-style:italic;">Belum ada data.</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ARTIKEL --}}
        <div class="section" id="artikel">
            <div class="section-header">
                <div class="section-icon purple">📰</div>
                <div>
                    <div class="section-title">Artikel Jurusan</div>
                    <div class="section-sub">Informasi & konten terbaru dari jurusan ini</div>
                </div>
            </div>
            <div class="artikel-grid">
                @forelse($artikels as $a)
                <a href="{{ route('artikel.show', $a->id) }}" class="artikel-card">
                    
                    @if($a->gambarUpload)
                        <img class="artikel-img" src="{{ Storage::url($a->gambarUpload->storage_path) }}" alt="{{ $a->judul }}">
                    @else
                        <div class="artikel-img-placeholder">📄</div>
                    @endif

                    <div class="artikel-body">
                        <div class="artikel-date">📅 {{ $a->created_at->translatedFormat('d M Y') }}</div>
                        <div class="artikel-title">{{ $a->judul }}</div>

                        @if($a->fileUpload)
                            <div class="artikel-file">📎 {{ $a->fileUpload->file_name }}</div>
                        @endif
                    </div>

                </a>
                @empty
                <div class="empty-artikel">
                    Belum ada artikel untuk jurusan ini.
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script>
function scrollToSection(id, el) {
    document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
}

// Auto highlight tab on scroll
const sections = ['fasilitas', 'prospek', 'artikel'];
const tabs = document.querySelectorAll('.tab');
window.addEventListener('scroll', () => {
    let current = 'fasilitas';
    sections.forEach(id => {
        const el = document.getElementById(id);
        if (el && window.scrollY >= el.offsetTop - 160) current = id;
    });
    tabs.forEach((tab, i) => {
        tab.classList.toggle('active', sections[i] === current);
    });
});
</script>

</body>
</html>