@extends('layouts.landing')

@php $title = 'Profil Saya - SMK Negeri 2 Jember'; @endphp

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<style>
header, .main-header, #mobile-menu, footer, .footer { display:none !important; }
main { padding-top:0 !important; margin-top:0 !important; }
body { padding-top:0 !important; background:#0d0f14 !important; color:#e8eaf0 !important; }

:root {
    --bg:#0d0f14; --surface:#161921; --surface2:#1e2330; --border:#2a2f3e;
    --accent:#f4b942; --accent2:#e07b54; --text:#e8eaf0; --text-dim:#8892aa;
    --green:#5cb85c; --danger:#e05454; --radius:16px;
}

.pw { font-family:'DM Sans',sans-serif; min-height:100vh; position:relative; overflow-x:hidden; }
.bg-glow  { position:fixed; top:-200px; left:-200px; width:700px; height:700px; background:radial-gradient(ellipse,rgba(244,185,66,.08) 0%,transparent 70%); pointer-events:none; z-index:0; }
.bg-glow2 { position:fixed; bottom:-150px; right:-150px; width:500px; height:500px; background:radial-gradient(ellipse,rgba(224,123,84,.07) 0%,transparent 70%); pointer-events:none; z-index:0; }

/* BACK BAR */
.back-bar { position:sticky; top:0; z-index:100; background:rgba(13,15,20,.92); backdrop-filter:blur(12px); border-bottom:1px solid rgba(255,255,255,.06); padding:10px 20px; display:flex; align-items:center; justify-content:space-between; }
.back-btn-top { display:inline-flex; align-items:center; gap:7px; background:rgba(244,185,66,.1); border:1.5px solid rgba(244,185,66,.25); color:var(--accent); font-size:12px; font-weight:700; padding:7px 16px; border-radius:9px; text-decoration:none; transition:all .2s; }
.back-btn-top:hover { background:rgba(244,185,66,.18); transform:translateX(-2px); }
.back-bar-title { font-family:'Playfair Display',serif; font-size:13px; font-weight:700; color:rgba(255,255,255,.5); }

.pc { position:relative; z-index:1; max-width:820px; margin:0 auto; padding:36px 20px 80px; }

.pg-head  { text-align:center; margin-bottom:38px; animation:fadeDown .6s ease both; }
.hd-badge { display:inline-flex; align-items:center; gap:7px; background:rgba(244,185,66,.11); border:1px solid rgba(244,185,66,.25); color:var(--accent); font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; padding:5px 16px; border-radius:100px; margin-bottom:14px; }
.pg-title { font-family:'Playfair Display',serif; font-size:clamp(1.9rem,5vw,2.8rem); font-weight:900; background:linear-gradient(135deg,#f4b942 20%,#e8eaf0 65%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:6px; line-height:1.2; }
.pg-sub   { color:var(--text-dim); font-size:13px; }

.alert-ok  { background:rgba(92,184,92,.08); border:1px solid rgba(92,184,92,.3); border-left:3px solid var(--green); border-radius:10px; padding:12px 16px; font-size:13px; color:#7dcc7d; margin-bottom:18px; display:flex; align-items:center; gap:9px; }
.alert-err { background:rgba(224,84,84,.08); border:1px solid rgba(224,84,84,.3); border-left:3px solid var(--danger); border-radius:10px; padding:12px 16px; font-size:12px; color:#f08080; margin-bottom:18px; line-height:1.7; }
.alert-err ul { padding-left:16px; margin-top:5px; }

.hero-card { background:linear-gradient(145deg,#0f1825,#152038); border:1px solid var(--border); border-radius:var(--radius); padding:28px 30px; margin-bottom:20px; position:relative; overflow:hidden; animation:fadeIn .5s ease both; box-shadow:0 8px 36px rgba(0,0,0,.4); }
/* .hero-card::before { content:''; position:absolute; top:-60px; right:-60px; width:200px; height:200px; border-radius:50%; background:rgba(244,185,66,.04); } */
.hero-card::after  { content:''; position:absolute; bottom:0; left:0; right:0; height:2px; background:linear-gradient(90deg,var(--accent),var(--accent2),var(--accent)); }
.hero-inner  { display:flex; align-items:center; gap:22px; flex-wrap:wrap; }
.avatar      { width:76px; height:76px; border-radius:50%; flex-shrink:0; background:linear-gradient(135deg,var(--accent),var(--accent2)); display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-size:32px; font-weight:900; color:#111; box-shadow:0 0 0 4px rgba(244,185,66,.18),0 8px 24px rgba(244,185,66,.2); }
.hero-info   { flex:1; min-width:0; }
.hero-name   { font-family:'Playfair Display',serif; font-size:clamp(1.15rem,3vw,1.5rem); font-weight:900; color:var(--text); margin-bottom:3px; }
.hero-email  { font-size:12px; color:var(--text-dim); margin-bottom:9px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.hero-badges { display:flex; gap:7px; flex-wrap:wrap; }
.hbadge  { display:inline-flex; align-items:center; gap:5px; font-size:11px; font-weight:700; padding:3px 11px; border-radius:100px; }
.hb-grn  { background:rgba(92,184,92,.1);  border:1px solid rgba(92,184,92,.25);  color:var(--green); }
.hb-gld  { background:rgba(244,185,66,.1); border:1px solid rgba(244,185,66,.25); color:var(--accent); }
.hb-blu  { background:rgba(99,179,237,.1); border:1px solid rgba(99,179,237,.25); color:#63b3ed; }
.tab-btns{ display:flex; gap:8px; flex-wrap:wrap; flex-shrink:0; }
.tab-btn { padding:8px 16px; border-radius:9px; font-size:12px; font-weight:700; cursor:pointer; transition:all .2s; font-family:'DM Sans',sans-serif; border:1.5px solid var(--border); background:transparent; color:var(--text-dim); }
.tab-btn:hover  { border-color:rgba(244,185,66,.5); color:var(--accent); }
.tab-btn.active { border-color:var(--accent); background:rgba(244,185,66,.1); color:var(--accent); }

.data-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:13px; margin-bottom:20px; }
.data-item { background:var(--surface); border:1px solid var(--border); border-radius:13px; padding:18px 20px; display:flex; align-items:center; gap:14px; transition:all .2s; }
.data-item:hover { border-color:rgba(244,185,66,.2); transform:translateY(-2px); }
.data-item.full { grid-column:1/-1; }
.d-icon   { width:42px; height:42px; border-radius:11px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:19px; }
.ic-gld { background:rgba(244,185,66,.12); } .ic-blu { background:rgba(99,179,237,.12); }
.ic-grn { background:rgba(92,184,92,.12);  } .ic-org { background:rgba(224,123,84,.12); }
.ic-pur { background:rgba(167,139,250,.12); }
.d-lbl { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--text-dim); margin-bottom:4px; }
.d-val { font-size:14px; font-weight:700; color:var(--text); }
.d-val.na { color:var(--text-dim); font-style:italic; font-weight:400; font-size:13px; }

.card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius); overflow:hidden; box-shadow:0 4px 30px rgba(0,0,0,.3); }
.card-head { background:linear-gradient(135deg,#0f1520,#162038); border-bottom:1px solid var(--border); padding:20px 26px; position:relative; overflow:hidden; }
.card-head::before { content:''; position:absolute; top:-30px; right:-30px; width:120px; height:120px; border-radius:50%; background:rgba(244,185,66,.04); }
.card-head::after  { content:''; position:absolute; bottom:0; left:0; right:0; height:2px; background:linear-gradient(90deg,var(--accent),var(--accent2),var(--accent)); }
.card-title { font-family:'Playfair Display',serif; font-size:1.05rem; font-weight:800; color:var(--text); }
.card-sub   { font-size:12px; color:var(--text-dim); margin-top:3px; }
.card-body  { padding:26px; }

.sec-lbl { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:.12em; color:var(--accent); margin:18px 0 12px; display:flex; align-items:center; gap:10px; }
.sec-lbl::after { content:''; flex:1; height:1px; background:var(--border); }
.sec-lbl:first-child { margin-top:0; }

.fgrid { display:grid; grid-template-columns:1fr 1fr; gap:13px; margin-bottom:13px; }
.fgrid.full { grid-template-columns:1fr; }
.field label { display:block; font-size:11px; font-weight:700; color:var(--text-dim); text-transform:uppercase; letter-spacing:.05em; margin-bottom:7px; }
.field label .req { color:var(--danger); }
.field input { width:100%; background:var(--surface2); border:1.5px solid var(--border); border-radius:10px; color:var(--text); font-family:'DM Sans',sans-serif; font-size:13px; padding:11px 14px; transition:border-color .2s,box-shadow .2s; outline:none; }
.field input:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(244,185,66,.1); background:#21263a; }
.fhint { font-size:11px; color:var(--text-dim); margin-top:5px; }

.radio-grp  { display:flex; gap:10px; }
.radio-card { flex:1; border:1.5px solid var(--border); border-radius:10px; padding:12px 14px; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:10px; background:var(--surface2); user-select:none; }
.radio-card:hover { border-color:rgba(244,185,66,.4); background:rgba(244,185,66,.04); }
.radio-card input { accent-color:var(--accent); width:15px; height:15px; flex-shrink:0; }
.radio-card.sel { border-color:var(--accent); background:rgba(244,185,66,.08); box-shadow:0 0 0 3px rgba(244,185,66,.1); }
.radio-card span { font-size:13px; font-weight:600; color:var(--text); }

.pwd-wrap { position:relative; }
.pwd-wrap input { padding-right:44px; }
.pwd-eye { position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; color:var(--text-dim); font-size:15px; background:none; border:none; transition:color .2s; }
.pwd-eye:hover { color:var(--accent); }
.pwd-bar-wrap { height:5px; background:var(--border); border-radius:100px; overflow:hidden; margin:9px 0 5px; }
.pwd-bar { height:100%; border-radius:100px; transition:width .4s,background .4s; width:0; }
.pwd-hint { font-size:11px; color:var(--text-dim); }

.btn-grp  { display:flex; gap:10px; justify-content:flex-end; flex-wrap:wrap; margin-top:22px; padding-top:18px; border-top:1px solid var(--border); }
.btn-save { padding:11px 28px; border:none; border-radius:10px; font-size:13px; font-weight:700; color:#111; background:linear-gradient(135deg,var(--accent),var(--accent2)); cursor:pointer; transition:all .22s; font-family:'DM Sans',sans-serif; box-shadow:0 4px 16px rgba(244,185,66,.25); }
.btn-save:hover { transform:translateY(-2px); box-shadow:0 8px 26px rgba(244,185,66,.4); }
.btn-save:disabled { opacity:.6; cursor:not-allowed; transform:none; }
.btn-back { padding:11px 20px; border:1.5px solid var(--border); border-radius:10px; font-size:13px; font-weight:600; color:var(--text-dim); background:transparent; cursor:pointer; transition:all .2s; font-family:'DM Sans',sans-serif; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
.btn-back:hover { border-color:var(--accent); color:var(--accent); }

.tab-panel { display:none; }
.tab-panel.active { display:block; animation:slideIn .3s ease both; }

@keyframes fadeIn  { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
@keyframes fadeDown{ from{opacity:0;transform:translateY(-12px)} to{opacity:1;transform:translateY(0)} }
@keyframes slideIn { from{opacity:0;transform:translateX(12px)} to{opacity:1;transform:translateX(0)} }

@media(max-width:640px){
    .pc { padding:28px 14px 60px; }
    .card-body,.card-head { padding:18px 16px; }
    .hero-card { padding:20px 18px; }
    .fgrid, .data-grid { grid-template-columns:1fr; }
    .data-item.full { grid-column:auto; }
    .hero-inner { gap:16px; }
    .avatar { width:62px; height:62px; font-size:26px; }
    .tab-btns { width:100%; }
    .tab-btn  { flex:1; text-align:center; padding:7px 8px; font-size:11px; }
    .btn-grp  { flex-direction:column; }
    .btn-save,.btn-back { width:100%; text-align:center; justify-content:center; }
    .radio-grp { flex-direction:column; }
}
</style>
@endpush

@section('content')
@php
    $namaUser    = Auth::user()->nama ?? 'Siswa';
    $emailUser   = Auth::user()->email ?? '';
    $inisial     = strtoupper(substr($namaUser, 0, 1));
    $gender      = $siswa->jenis_kelamin ?? null;
    $genderLabel = $gender === 'L' ? '👦 Laki-laki' : ($gender === 'P' ? '👧 Perempuan' : null);
    $sekolah     = $siswa->sekolah_asal ?? null;
@endphp

<div class="pw">
<div class="bg-glow"></div>
<div class="bg-glow2"></div>

{{-- ═══ BACK BAR ═══ --}}
<div class="back-bar">
    <a href="{{ route('landing.home') }}" class="back-btn-top">
        ← Kembali ke Beranda
    </a>
    <div class="back-bar-title">Profil Saya</div>
    <div style="width:160px;"></div>{{-- spacer biar title center --}}
</div>

<div class="pc">

    {{-- PAGE HEADER --}}
    <div class="pg-head">
        <div class="hd-badge">👤 Akun Saya</div>
        <h1 class="pg-title">Profil Siswa</h1>
        <p class="pg-sub">Lihat dan kelola informasi akun serta data dirimu.</p>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert-ok">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-err">
            <strong>⚠ Perbaiki kesalahan berikut:</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    {{-- HERO CARD --}}
    <div class="hero-card">
        <div class="hero-inner">
            <div class="avatar">{{ $inisial }}</div>
            <div class="hero-info">
                <div class="hero-name">{{ $namaUser }}</div>
                <div class="hero-email">{{ $emailUser }}</div>
                <div class="hero-badges">
                    <span class="hbadge hb-grn">🎓 Siswa Aktif</span>
                    @if($genderLabel)
                        <span class="hbadge hb-gld">{{ $genderLabel }}</span>
                    @endif
                    @if($sekolah)
                        <span class="hbadge hb-blu">🏫 {{ $sekolah }}</span>
                    @endif
                </div>
            </div>
            <div class="tab-btns">
                <button class="tab-btn active" onclick="goTab('lihat',this)">👁 Lihat</button>
                <button class="tab-btn" onclick="goTab('edit',this)">✏️ Edit</button>
                <button class="tab-btn" onclick="goTab('pass',this)">🔒 Password</button>
            </div>
        </div>
    </div>

    {{-- ══ TAB: LIHAT DATA ══ --}}
    <div class="tab-panel active" id="tab-lihat">
        <div class="data-grid">
            <div class="data-item">
                <div class="d-icon ic-gld">👤</div>
                <div><div class="d-lbl">Nama Lengkap</div><div class="d-val">{{ Auth::user()->nama ?? '-' }}</div></div>
            </div>
            <div class="data-item">
                <div class="d-icon ic-blu">✉️</div>
                <div><div class="d-lbl">Email</div><div class="d-val">{{ Auth::user()->email ?? '-' }}</div></div>
            </div>
            <div class="data-item">
                <div class="d-icon ic-grn">📞</div>
                <div><div class="d-lbl">No. Telepon</div><div class="d-val {{ !$siswa->no_telepon ? 'na' : '' }}">{{ $siswa->no_telepon ?? 'Belum diisi' }}</div></div>
            </div>
            <div class="data-item">
                <div class="d-icon ic-org">🏫</div>
                <div><div class="d-lbl">Sekolah Asal</div><div class="d-val {{ !$siswa->sekolah_asal ? 'na' : '' }}">{{ $siswa->sekolah_asal ?? 'Belum diisi' }}</div></div>
            </div>
            <div class="data-item full">
                <div class="d-icon ic-pur">⚧️</div>
                <div><div class="d-lbl">Jenis Kelamin</div>
                <div class="d-val {{ !$siswa->jenis_kelamin ? 'na' : '' }}">
                    @if($siswa->jenis_kelamin === 'L') 👦 Laki-laki
                    @elseif($siswa->jenis_kelamin === 'P') 👧 Perempuan
                    @else Belum diisi
                    @endif
                </div></div>
            </div>
        </div>
        <div style="display:flex;gap:10px;justify-content:flex-end;">
            <a href="{{ route('landing.home') }}" class="btn-back">🏠 Kembali ke Beranda</a>
            <button class="btn-save" onclick="goTab('edit',document.querySelectorAll('.tab-btn')[1])">✏️ Edit Profil Saya</button>
        </div>
    </div>

    {{-- ══ TAB: EDIT PROFIL ══ --}}
    <div class="tab-panel" id="tab-edit">
        <div class="card">
            <div class="card-head">
                <div class="card-title">✏️ Edit Data Pribadi</div>
                <div class="card-sub">Perbarui informasi profil kamu</div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('siswa.profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="sec-lbl">Akun</div>
                    <div class="fgrid">
                        <div class="field">
                            <label>Nama Lengkap <span class="req">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama', Auth::user()->nama) }}" placeholder="Nama lengkap kamu" required/>
                        </div>
                        <div class="field">
                            <label>Email <span class="req">*</span></label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="email@contoh.com" required/>
                        </div>
                    </div>
                    <div class="sec-lbl">Data Diri</div>
                    <div class="fgrid">
                        <div class="field">
                            <label>No. Telepon</label>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon', $siswa->no_telepon ?? '') }}" placeholder="08xxxxxxxxxx"/>
                        </div>
                        <div class="field">
                            <label>Sekolah Asal</label>
                            <input type="text" name="sekolah_asal" value="{{ old('sekolah_asal', $siswa->sekolah_asal ?? '') }}" placeholder="Nama SMP/sekolah asal kamu"/>
                        </div>
                    </div>
                     <div class="data-item full">
                        <div class="d-icon ic-pur">⚧️</div>
                        <div><div class="d-lbl">Jenis Kelamin</div>
                        <div class="d-val {{ !$siswa->jenis_kelamin ? 'na' : '' }}">
                            @if($siswa->jenis_kelamin === 'L') 👦 Laki-laki
                            @elseif($siswa->jenis_kelamin === 'P') 👧 Perempuan
                            @else Belum diisi
                            @endif
                        </div></div>
                    </div>
                    <div class="btn-grp">
                        <a href="{{ route('landing.home') }}" class="btn-back">🏠 Kembali ke Beranda</a>
                        <button type="submit" class="btn-save">💾 Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ══ TAB: UBAH PASSWORD ══ --}}
    <div class="tab-panel" id="tab-pass">
        <div class="card">
            <div class="card-head">
                <div class="card-title">🔒 Ubah Password</div>
                <div class="card-sub">Buat password baru yang kuat</div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('siswa.profile.password') }}" id="pwdForm">
                    @csrf
                    @method('PUT')
                    <div class="sec-lbl">Password Sekarang</div>
                    <div class="fgrid full">
                        <div class="field">
                            <label>Password Lama <span class="req">*</span></label>
                            <div class="pwd-wrap">
                                <input type="password" name="current_password" id="p-lama" placeholder="Masukkan password lama" required/>
                                <button type="button" class="pwd-eye" onclick="togP('p-lama',this)">👁</button>
                            </div>
                        </div>
                    </div>
                    <div class="sec-lbl">Password Baru</div>
                    <div class="fgrid full">
                        <div class="field">
                            <label>Password Baru <span class="req">*</span></label>
                            <div class="pwd-wrap">
                                <input type="password" name="password" id="p-baru" placeholder="Minimal 8 karakter" required oninput="chkStr(this.value)"/>
                                <button type="button" class="pwd-eye" onclick="togP('p-baru',this)">👁</button>
                            </div>
                            <div class="pwd-bar-wrap"><div class="pwd-bar" id="pwdBar"></div></div>
                            <div class="pwd-hint" id="pwdHint">Masukkan password baru</div>
                        </div>
                    </div>
                    <div class="fgrid full">
                        <div class="field">
                            <label>Konfirmasi Password <span class="req">*</span></label>
                            <div class="pwd-wrap">
                                <input type="password" name="password_confirmation" id="p-conf" placeholder="Ulangi password baru" required oninput="chkMatch()"/>
                                <button type="button" class="pwd-eye" onclick="togP('p-conf',this)">👁</button>
                            </div>
                            <div class="fhint" id="matchHint">Harus sama dengan password baru</div>
                        </div>
                    </div>
                    <div class="btn-grp">
                        <a href="{{ route('landing.home') }}" class="btn-back">🏠 Kembali ke Beranda</a>
                        <button type="submit" class="btn-save" id="btnPwd">🔒 Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
@endsection

@push('scripts')
<script>
function goTab(n,btn){
    document.querySelectorAll('.tab-panel').forEach(p=>p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
    document.getElementById('tab-'+n).classList.add('active');
    btn.classList.add('active');
}
function selG(el){
    document.querySelectorAll('.radio-card').forEach(c=>c.classList.remove('sel'));
    el.classList.add('sel');
}
function togP(id,btn){
    const i=document.getElementById(id);
    i.type=i.type==='password'?'text':'password';
    btn.textContent=i.type==='password'?'👁':'🙈';
}
function chkStr(v){
    let s=0;
    if(v.length>=8)s++;if(/[A-Z]/.test(v))s++;if(/[0-9]/.test(v))s++;if(/[^A-Za-z0-9]/.test(v))s++;
    const l=[{w:'0%',c:'#2a2f3e',t:'Masukkan password baru'},{w:'25%',c:'#e05454',t:'⚠ Lemah'},{w:'50%',c:'#e07b54',t:'☑ Cukup'},{w:'75%',c:'#f4b942',t:'✅ Kuat'},{w:'100%',c:'#5cb85c',t:'💪 Sangat Kuat'}];
    const i=v.length===0?0:s;
    document.getElementById('pwdBar').style.width=l[i].w;
    document.getElementById('pwdBar').style.background=l[i].c;
    document.getElementById('pwdHint').textContent=l[i].t;
    document.getElementById('pwdHint').style.color=l[i].c;
    chkMatch();
}
function chkMatch(){
    const b=document.getElementById('p-baru').value;
    const k=document.getElementById('p-conf').value;
    const h=document.getElementById('matchHint');
    if(!k){h.textContent='Harus sama dengan password baru';h.style.color='';return;}
    h.textContent=b===k?'✅ Password cocok':'❌ Tidak cocok';
    h.style.color=b===k?'#5cb85c':'#e05454';
}
document.getElementById('pwdForm')?.addEventListener('submit',()=>{
    const b=document.getElementById('btnPwd');
    b.disabled=true;b.textContent='⏳ Menyimpan...';
});
@if($errors->has('current_password')||$errors->has('password'))
    goTab('pass',document.querySelectorAll('.tab-btn')[2]);
@endif
</script>
@endpush