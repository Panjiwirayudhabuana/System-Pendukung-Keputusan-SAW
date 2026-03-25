<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login · SPK Jurusan SMKN 2 Jember</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --navy: #0d1b3e; --blue: #2563eb; --gold: #f59e0b;
    --gold2: #fbbf24; --white: #ffffff; --gray: #94a3b8;
}
body {
    min-height: 100vh; font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--navy); display: flex; overflow-x: hidden;
}
body::before {
    content: ''; position: fixed; inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 28px 28px; pointer-events: none; z-index: 0;
}
.left {
    flex: 1; display: flex; flex-direction: column;
    justify-content: center; padding: 60px 64px;
    position: relative; z-index: 1;
}
.deco { position: absolute; border-radius: 50%; pointer-events: none; }
.deco-1 { width: 320px; height: 320px; background: radial-gradient(circle, rgba(37,99,235,.22) 0%, transparent 70%); bottom: -80px; left: -80px; }
.deco-2 { width: 200px; height: 200px; background: radial-gradient(circle, rgba(245,158,11,.13) 0%, transparent 70%); top: 60px; right: 20px; }
.brand { display: flex; align-items: center; gap: 14px; margin-bottom: 56px; animation: fadeUp .6s ease both; }
.brand-logo {
    width: 48px; height: 48px;
    background: linear-gradient(135deg, var(--blue), var(--gold));
    border-radius: 12px; display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif; font-weight: 800; font-size: 16px; color: #fff;
    box-shadow: 0 4px 16px rgba(37,99,235,.4); flex-shrink: 0;
}
.brand-text .name { font-family: 'Playfair Display', serif; font-weight: 800; font-size: 13px; color: var(--white); line-height: 1.3; }
.brand-text .sub { font-size: 11px; color: var(--gray); }
.hero-label {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(245,158,11,.12); border: 1px solid rgba(245,158,11,.3);
    border-radius: 100px; padding: 6px 14px;
    font-size: 12px; font-weight: 600; color: var(--gold2);
    margin-bottom: 22px; animation: fadeUp .6s .1s ease both;
}
.hero-label span { width: 6px; height: 6px; border-radius: 50%; background: var(--gold); display: block; }
.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(30px, 3.5vw, 46px); font-weight: 800; line-height: 1.2;
    color: var(--white); margin-bottom: 16px; animation: fadeUp .6s .2s ease both;
}
.hero-title em { font-style: italic; color: var(--gold); }
.hero-desc {
    font-size: 14px; color: var(--gray); line-height: 1.8;
    max-width: 380px; margin-bottom: 40px; animation: fadeUp .6s .3s ease both;
}

.vline {
    width: 1px;
    background: linear-gradient(to bottom, transparent, rgba(255,255,255,.1) 30%, rgba(255,255,255,.1) 70%, transparent);
    align-self: stretch; margin: 40px 0; flex-shrink: 0; z-index: 1;
}
.right {
    width: 520px; flex-shrink: 0; display: flex; align-items: center;
    justify-content: center; padding: 40px 60px; position: relative; z-index: 1;
}
.card {
    width: 100%; max-width: 380px; margin: auto; background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1); border-radius: 20px;
    padding: 40px 36px; backdrop-filter: blur(20px);
    animation: fadeIn .7s .2s ease both;
    box-shadow: 0 24px 64px rgba(0,0,0,.4), inset 0 1px 0 rgba(255,255,255,.08);
    position: relative;
}
.card::before {
    content: ''; position: absolute; top: 0; left: 36px; right: 36px; height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent); border-radius: 100px;
}
.card-top { margin-bottom: 28px; }
.card-top h2 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 800; color: var(--white); margin-bottom: 6px; }
.card-top p { font-size: 13px; color: var(--gray); }
.form-group { margin-bottom: 16px; }
label { display: block; font-size: 11.5px; font-weight: 600; color: rgba(255,255,255,.55); text-transform: uppercase; letter-spacing: .07em; margin-bottom: 7px; }
input[type="email"], input[type="password"] {
    width: 100%; background: rgba(255,255,255,.06);
    border: 1.5px solid rgba(255,255,255,.1); border-radius: 10px;
    padding: 12px 14px; font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px; color: var(--white); outline: none;
    transition: border-color .2s, background .2s;
}
input::placeholder { color: rgba(255,255,255,.22); }
input:focus { border-color: var(--blue); background: rgba(37,99,235,.08); }
.forgot { display: block; text-align: right; font-size: 12px; color: var(--gold); text-decoration: none; margin-top: -8px; margin-bottom: 20px; }
.forgot:hover { text-decoration: underline; }
.btn-login {
    width: 100%; padding: 13px; border-radius: 10px; border: none;
    background: linear-gradient(135deg, var(--blue), #1d4ed8);
    color: #fff; font-family: 'Playfair Display', serif;
    font-size: 15px; font-weight: 700; cursor: pointer;
    box-shadow: 0 6px 20px rgba(37,99,235,.4);
    transition: transform .15s, box-shadow .15s; position: relative; overflow: hidden;
}
.btn-login::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,.12), transparent); }
.btn-login:hover { transform: translateY(-1px); box-shadow: 0 10px 28px rgba(37,99,235,.5); }
.divider { display: flex; align-items: center; gap: 10px; margin: 18px 0; }
.divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: rgba(255,255,255,.08); }
.divider span { font-size: 11px; color: rgba(255,255,255,.28); }
.register-link { text-align: center; font-size: 13px; color: var(--gray); }
.register-link a { color: var(--gold); text-decoration: none; font-weight: 600; }
.register-link a:hover { text-decoration: underline; }
.error-box { background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.3); border-radius: 10px; padding: 12px 14px; font-size: 13px; color: #fca5a5; margin-bottom: 16px; }
@keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
@keyframes fadeIn { from { opacity: 0; transform: scale(.97); } to { opacity: 1; transform: scale(1); } }
@media (max-width: 900px) {
    body { flex-direction: column; }
    .left { padding: 36px 24px 24px; }
    .vline { display: none; }
    .right { width: 100%; padding: 0 20px 48px; }
    .stats { gap: 20px; }
    .hero-desc { display: none; }
}
</style>
</head>
<body>
<div class="left">
    <div class="deco deco-1"></div>
    <div class="deco deco-2"></div>
    <div class="brand">
        <div class="brand-logo">S2J</div>
        <div class="brand-text">
            <div class="name">SMK NEGERI 2 JEMBER</div>
            <div class="sub">Sistem Pendukung Keputusan Pemilihan Jurusan</div>
        </div>
    </div>
    <div class="hero-label"><span></span> Tahun Ajaran 2025/2026</div>
    <h1 class="hero-title">Temukan Jurusan<br><em>Terbaik Untukmu</em></h1>
    <p class="hero-desc">Gunakan Sistem Pendukung Keputusan berbasis <strong style="color:#fff;">Metode SAW</strong> untuk menemukan jurusan yang paling sesuai dengan minat, bakat, dan kemampuan kamu di SMK Negeri 2 Jember.</p>
    
</div>
<div class="vline"></div>
<div class="right">
    <div class="card">
        <div class="card-top">
            <h2>Selamat Datang 👋</h2>
            <p>Silakan masuk menggunakan akun kamu</p>
        </div>
        @if ($errors->any())
        <div class="error-box">
            @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@smkn2jember.sch.id" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot">Lupa password?</a>
            @endif
            <button type="submit" class="btn-login">Masuk →</button>
            <div class="divider"><span>atau</span></div>
            <div class="register-link">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></div>
        </form>
    </div>
</div>
</body>
</html>