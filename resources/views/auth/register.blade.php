<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar · SPK Jurusan SMKN 2 Jember</title>
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

/* LEFT — lebih compact untuk register */
.left {
    width: 340px; flex-shrink: 0; display: flex; flex-direction: column;
    justify-content: center; padding: 60px 40px;
    position: relative; z-index: 1;
}
.deco { position: absolute; border-radius: 50%; pointer-events: none; }
.deco-1 { width: 280px; height: 280px; background: radial-gradient(circle, rgba(37,99,235,.2) 0%, transparent 70%); bottom: -60px; left: -60px; }
.deco-2 { width: 160px; height: 160px; background: radial-gradient(circle, rgba(245,158,11,.12) 0%, transparent 70%); top: 50px; right: 10px; }

.brand { display: flex; align-items: center; gap: 12px; margin-bottom: 48px; animation: fadeUp .6s ease both; }
.brand-logo {
    width: 44px; height: 44px;
    background: linear-gradient(135deg, var(--blue), var(--gold));
    border-radius: 11px; display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif; font-weight: 800; font-size: 15px; color: #fff;
    box-shadow: 0 4px 14px rgba(37,99,235,.4); flex-shrink: 0;
}
.brand-text .name { font-family: 'Playfair Display', serif; font-weight: 800; font-size: 12.5px; color: var(--white); line-height: 1.3; }
.brand-text .sub { font-size: 10.5px; color: var(--gray); }

.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(24px, 2.5vw, 34px); font-weight: 800; line-height: 1.25;
    color: var(--white); margin-bottom: 14px; animation: fadeUp .6s .15s ease both;
}
.hero-title em { font-style: italic; color: var(--gold); }

.hero-desc {
    font-size: 13px; color: var(--gray); line-height: 1.75;
    margin-bottom: 32px; animation: fadeUp .6s .25s ease both;
}

.steps { display: flex; flex-direction: column; gap: 16px; animation: fadeUp .6s .35s ease both; }
.step { display: flex; align-items: flex-start; gap: 12px; }
.step-num {
    width: 26px; height: 26px; border-radius: 50%; flex-shrink: 0;
    background: rgba(37,99,235,.2); border: 1px solid rgba(37,99,235,.4);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif; font-size: 12px; font-weight: 800; color: var(--blue);
}
.step-text .title { font-size: 12.5px; font-weight: 700; color: var(--white); }
.step-text .desc { font-size: 11px; color: var(--gray); margin-top: 1px; }

/* DIVIDER */
.vline {
    width: 1px;
    background: linear-gradient(to bottom, transparent, rgba(255,255,255,.1) 30%, rgba(255,255,255,.1) 70%, transparent);
    align-self: stretch; margin: 40px 0; flex-shrink: 0; z-index: 1;
}

/* RIGHT */
.right {
    flex: 1; display: flex; align-items: center; justify-content: center;
    padding: 40px 48px; position: relative; z-index: 1;
}

.card {
    width: 100%; max-width: 520px; background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1); border-radius: 20px;
    padding: 36px 36px; backdrop-filter: blur(20px);
    animation: fadeIn .7s .2s ease both;
    box-shadow: 0 24px 64px rgba(0,0,0,.4), inset 0 1px 0 rgba(255,255,255,.08);
    position: relative;
}
.card::before {
    content: ''; position: absolute; top: 0; left: 36px; right: 36px; height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent); border-radius: 100px;
}
.card-top { margin-bottom: 24px; }
.card-top h2 { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 800; color: var(--white); margin-bottom: 5px; }
.card-top p { font-size: 13px; color: var(--gray); }

.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.form-group { margin-bottom: 14px; }
.form-group.full { grid-column: 1 / -1; }

label { display: block; font-size: 11px; font-weight: 600; color: rgba(255,255,255,.5); text-transform: uppercase; letter-spacing: .07em; margin-bottom: 6px; }

input[type="text"], input[type="email"], input[type="password"], input[type="tel"], select, textarea {
    width: 100%; background: rgba(255,255,255,.06);
    border: 1.5px solid rgba(255,255,255,.1); border-radius: 10px;
    padding: 11px 13px; font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13.5px; color: var(--white); outline: none;
    transition: border-color .2s, background .2s;
}
input::placeholder, textarea::placeholder { color: rgba(255,255,255,.2); }
input:focus, select:focus, textarea:focus { border-color: var(--blue); background: rgba(37,99,235,.08); }
select { appearance: none; cursor: pointer; }
select option { background: #1e2d5a; color: #fff; }
textarea { resize: vertical; min-height: 80px; }

.hint { font-size: 11px; color: rgba(255,255,255,.3); margin-top: 4px; }

.btn-register {
    width: 100%; padding: 13px; border-radius: 10px; border: none;
    background: linear-gradient(135deg, var(--gold), #d97706);
    color: #0d1b3e; font-family: 'Playfair Display', serif;
    font-size: 15px; font-weight: 800; cursor: pointer;
    box-shadow: 0 6px 20px rgba(245,158,11,.35);
    transition: transform .15s, box-shadow .15s; position: relative; overflow: hidden;
    margin-top: 6px;
}
.btn-register::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,.18), transparent); }
.btn-register:hover { transform: translateY(-1px); box-shadow: 0 10px 28px rgba(245,158,11,.45); }

.login-link { text-align: center; font-size: 13px; color: var(--gray); margin-top: 14px; }
.login-link a { color: var(--gold); text-decoration: none; font-weight: 600; }
.login-link a:hover { text-decoration: underline; }

.error-box { background: rgba(239,68,68,.1); border: 1px solid rgba(239,68,68,.3); border-radius: 10px; padding: 12px 14px; font-size: 13px; color: #fca5a5; margin-bottom: 14px; }

@keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
@keyframes fadeIn { from { opacity: 0; transform: scale(.97); } to { opacity: 1; transform: scale(1); } }

@media (max-width: 960px) {
    body { flex-direction: column; }
    .left { width: 100%; padding: 36px 24px 20px; }
    .steps { display: none; }
    .vline { display: none; }
    .right { padding: 0 20px 48px; }
    .form-row { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
    .card { padding: 28px 20px; }
}
</style>
</head>
<body>

<!-- LEFT -->
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

    <h1 class="hero-title">Mulai<br>Perjalanan<br><em>Karirmu</em></h1>

    <p class="hero-desc">Daftar sekarang dan temukan jurusan yang paling sesuai dengan potensimu.</p>

    <div class="steps">
        <div class="step">
            <div class="step-num">1</div>
            <div class="step-text">
                <div class="title">Buat Akun</div>
                <div class="desc">Isi data diri kamu dengan lengkap</div>
            </div>
        </div>
        <div class="step">
            <div class="step-num">2</div>
            <div class="step-text">
                <div class="title">Ikuti Tes SPK</div>
                <div class="desc">Jawab pertanyaan seputar minat & kemampuan</div>
            </div>
        </div>
        <div class="step">
            <div class="step-num">3</div>
            <div class="step-text">
                <div class="title">Lihat Rekomendasi</div>
                <div class="desc">Dapatkan hasil jurusan terbaik untukmu</div>
            </div>
        </div>
    </div>
</div>

<div class="vline"></div>

<!-- RIGHT -->
<div class="right">
    <div class="card">
        <div class="card-top">
            <h2>Registrasi Siswa ✍️</h2>
            <p>Silakan isi data diri dengan benar</p>
        </div>

        @if ($errors->any())
        <div class="error-box">
            @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group full">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama sesuai rapor" required autofocus>
                </div>

                <div class="form-group full">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="email@gmail.com" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Min. 8 karakter" required>
                    <div class="hint">Minimal 8 karakter (huruf & angka)</div>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                </div>

                <div class="form-group full">
                    <label>Sekolah Asal</label>
                    <input type="text" name="sekolah_asal" value="{{ old('sekolah_asal') }}" placeholder="Contoh: SMP Negeri 1 Jember">
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin">
                        <option value="" disabled selected>Pilih...</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="tel" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="08xxxxxxxxxx">
                </div>

                <div class="form-group full">
                    <label>Alamat</label>
                    <textarea name="alamat" placeholder="Alamat lengkap kamu...">{{ old('alamat') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn-register">Daftar Sekarang →</button>

            <div class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></div>
        </form>
    </div>
</div>

</body>
</html>