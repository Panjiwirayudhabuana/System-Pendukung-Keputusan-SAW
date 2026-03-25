@extends('layouts.landing')

@section('title', 'SPK Pemilihan Jurusan - SMK Negeri 2 Jember')

@section('styles')
<style>
    /* HERO */
    .hero-section {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 60%, #2a5298 100%);
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .hero-badge {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.25);
    }
    .hero-cta-primary {
        background: var(--accent);
        color: var(--primary-dark);
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .hero-cta-primary:hover {
        background: var(--accent-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(232,160,32,0.4);
    }
    .hero-cta-secondary {
        border: 2px solid rgba(255,255,255,0.7);
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .hero-cta-secondary:hover {
        background: rgba(255,255,255,0.15);
        transform: translateY(-2px);
    }

    /* CAROUSEL */
    .carousel-container { overflow: hidden; position: relative; }
    .carousel-slide { display: none; }
    .carousel-slide.active { display: block; }
    .carousel-dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        cursor: pointer;
        transition: all 0.2s;
    }
    .carousel-dot.active {
        background: var(--accent);
        width: 28px;
        border-radius: 5px;
    }

    /* SECTION HEADINGS */
    .section-heading { position: relative; display: inline-block; }
    .section-heading::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--accent);
        border-radius: 2px;
    }

    /* CARDS */
    .jurusan-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        border-top: 4px solid transparent;
    }
    .jurusan-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(26, 60, 110, 0.15);
        border-top-color: var(--accent);
    }
    .jurusan-icon {
        width: 60px; height: 60px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
    }
</style>
@endsection

@section('content')

@php
    $isSiswa = auth()->check() && auth()->user()->role_id == 3;
@endphp

{{-- HERO / CAROUSEL --}}
<section class="hero-section">
    <div class="carousel-container">

        {{-- SLIDE 1 --}}
        <div class="carousel-slide active">
            <div class="max-w-7xl mx-auto px-6 py-14 md:py-20 flex flex-col md:flex-row items-center gap-10 relative z-10">
                <div class="flex-1 text-white">
                    <div class="hero-badge inline-flex items-center gap-2 text-xs font-semibold text-amber-300 px-4 py-1.5 rounded-full mb-5">
                        🎓 Tahun Ajaran 2025/2026
                    </div>

                    <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-4">
                        Temukan Jurusan<br>
                        <span class="text-amber-300">Terbaik Untukmu</span>
                    </h1>

                    <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-7 max-w-lg">
                        Gunakan Sistem Pendukung Keputusan berbasis <strong class="text-white">Metode SAW</strong> untuk menemukan jurusan yang paling sesuai dengan minat, bakat, dan kemampuan kamu di SMK Negeri 2 Jember.
                    </p>

                    <div class="flex flex-wrap gap-3">
                        @guest
                            <a href="{{ route('login') }}" class="hero-cta-primary px-7 py-3 rounded-xl text-sm inline-block">
                                Login untuk Mulai →
                            </a>
                            <a href="{{ route('register') }}" class="hero-cta-secondary px-7 py-3 rounded-xl text-sm inline-block">
                                Daftar Akun
                            </a>
                        @endguest

                        @if($isSiswa)
                            <a href="{{ route('siswa.tes.index') }}" class="hero-cta-primary px-7 py-3 rounded-xl text-sm inline-block">
                                Mulai Seleksi Jurusan →
                            </a>
                        @endif
                    </div>
                </div>

                <div class="flex-shrink-0 hidden md:block">
                    <div class="relative w-72 h-64 rounded-2xl overflow-hidden shadow-2xl bg-blue-800/50 backdrop-blur flex items-center justify-center border border-white/20">
                        <div class="text-center text-white">
                            <div class="text-6xl mb-3">🏫</div>
                            <div class="font-bold text-sm">SMK Negeri 2 Jember</div>
                            <div class="text-xs text-blue-200 mt-1">Berprestasi & Berkarakter</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SLIDE 2 --}}
        <div class="carousel-slide">
            <div class="max-w-7xl mx-auto px-6 py-14 md:py-20 flex flex-col md:flex-row items-center gap-10 relative z-10">
                <div class="flex-1 text-white">
                    <div class="hero-badge inline-flex items-center gap-2 text-xs font-semibold text-amber-300 px-4 py-1.5 rounded-full mb-5">
                        🏆 Program Unggulan
                    </div>
                    <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-4">
                        12 Program Keahlian<br>
                        <span class="text-amber-300">Siap Masa Depan</span>
                    </h1>
                    <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-7 max-w-lg">
                        Pilih dari TKJ, DKV, TKR, TSM, TITL, dan lainnya. Semua dirancang untuk mencetak lulusan kompeten dan siap kerja.
                    </p>
                    <a href="#program-keahlian" class="hero-cta-primary px-7 py-3 rounded-xl text-sm inline-block">
                        Lihat Semua Jurusan →
                    </a>
                </div>
            </div>
        </div>

        {{-- SLIDE 3 --}}
        <div class="carousel-slide">
            <div class="max-w-7xl mx-auto px-6 py-14 md:py-20 text-center relative z-10">
                <div class="hero-badge inline-flex items-center gap-2 text-xs font-semibold text-amber-300 px-4 py-1.5 rounded-full mb-5 mx-auto">
                    📅 Sistem Rekomendasi Jurusan
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-4">
                    SMK Negeri 2 Jember<br>
                    <span class="text-amber-300">TA 2026/2027</span>
                </h1>
                <p class="text-blue-100 text-sm md:text-base mb-8 max-w-2xl mx-auto">
                    Cek jurusanmu sekarang dan gunakan fitur SPK untuk mendapatkan rekomendasi jurusan terbaik.
                </p>

                @guest
                    <a href="{{ route('register') }}" class="hero-cta-primary px-8 py-3.5 rounded-xl text-sm inline-block font-bold">
                        Registrasi Sekarang !
                    </a>
                @endguest
            </div>
        </div>

    </div>

    {{-- dots --}}
    <div class="flex justify-center gap-2 pb-6 pt-2 relative z-10">
        <button class="carousel-dot active" onclick="goToSlide(0)"></button>
        <button class="carousel-dot" onclick="goToSlide(1)"></button>
        <button class="carousel-dot" onclick="goToSlide(2)"></button>
    </div>
</section>

{{-- STATS --}}
<section class="bg-white shadow-md py-0">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-100">
            @foreach([
                ['1.200+', 'Siswa Aktif', '👨‍🎓'],
                ['12', 'Program Keahlian', '📚'],
                ['85+', 'Tenaga Pengajar', '👨‍🏫'],
                ['95%', 'Tingkat Kelulusan', '🏆']
            ] as $stat)
            <div class="py-5 px-6 text-center">
                <div class="text-2xl mb-1">{{ $stat[2] }}</div>
                <div class="text-2xl font-extrabold text-blue-900 leading-tight">{{ $stat[0] }}</div>
                <div class="text-xs text-gray-500 mt-0.5">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PROGRAM KEAHLIAN --}}
<section id="program-keahlian" class="py-14 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10 fade-in">
            <p class="text-amber-500 font-semibold text-sm mb-1">Program Unggulan</p>
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 section-heading mx-auto">Program Keahlian</h2>
            <p class="text-gray-500 text-sm mt-6 max-w-xl mx-auto">
                Pilih jurusan yang sesuai dengan passion dan tujuan karir Anda bersama SMK Negeri 2 Jember.
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
            @foreach($jurusans as $j)
            <div class="jurusan-card shadow-sm fade-in p-5">
                <div class="jurusan-icon bg-blue-100 text-blue-600 mb-4">🏫</div>
                <h3 class="font-bold text-gray-900 text-sm md:text-base leading-tight mb-2">
                    {{ $j->nama_jurusan }}
                </h3>
                <a href="{{ route('jurusan.show', $j->id) }}">Lihat Detail →</a>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            @guest
                <a href="{{ route('login') }}" class="inline-block bg-blue-800 hover:bg-blue-900 text-white font-bold px-8 py-3 rounded-xl text-sm transition-colors shadow-md">
                    Login untuk Mulai →
                </a>
            @endguest

            @if($isSiswa)
                <a href="{{ route('siswa.tes.index') }}" class="inline-block bg-blue-800 hover:bg-blue-900 text-white font-bold px-8 py-3 rounded-xl text-sm transition-colors shadow-md">
                    Mulai Seleksi Jurusan dengan SPK →
                </a>
            @endif
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');

    function goToSlide(index) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');
        currentSlide = index;
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }

    setInterval(() => {
        goToSlide((currentSlide + 1) % slides.length);
    }, 5000);
</script>
@endsection