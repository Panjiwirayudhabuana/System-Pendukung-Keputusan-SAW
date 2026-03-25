<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'SPK Pemilihan Jurusan - SMK Negeri 2 Jember' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1a3c6e;
            --primary-dark: #0f2548;
            --accent: #e8a020;
            --accent-light: #f5c55a;
            --bg-light: #f0f4fa;
            --text-dark: #1e2a3a;
            --text-muted: #6b7a8d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4fa;
            color: var(--text-dark);
        }

        /* TOP BAR */
        .top-bar {
            background: var(--primary-dark);
            font-size: 0.72rem;
        }

        /* HEADER */
        .main-header {
            background: var(--primary);
        }

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

        /* STATS */
        .stat-card {
            background: white;
            border-left: 4px solid var(--accent);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(26, 60, 110, 0.12);
        }

        /* JURUSAN CARDS */
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
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
        }

        /* ARTIKEL CARDS */
        .artikel-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .artikel-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(26, 60, 110, 0.12);
        }
        .artikel-img {
            height: 170px;
            object-fit: cover;
            width: 100%;
            background: linear-gradient(135deg, #1a3c6e, #2a5298);
        }
        .artikel-badge {
            font-size: 0.68rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* INFO KEGIATAN */
        .kegiatan-item {
            border-left: 3px solid var(--accent);
            background: white;
            transition: all 0.2s ease;
        }
        .kegiatan-item:hover {
            border-left-color: var(--primary);
            background: #f8fbff;
        }

        /* SECTION HEADINGS */
        .section-heading {
            position: relative;
            display: inline-block;
        }
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

        /* NAV LINKS */
        .nav-link-custom {
            color: rgba(255,255,255,0.85);
            font-size: 0.82rem;
            font-weight: 500;
            padding: 0.4rem 0.75rem;
            border-radius: 4px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        /* FOOTER */
        .footer {
            background: var(--primary-dark);
        }

        /* MOBILE NAV */
        #mobile-menu { display: none; }
        #mobile-menu.open { display: block; }

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

        /* SCROLL ANIMATIONS */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    @stack('styles')
</head>
<body>

    @include('partials.navbar-landing')

    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @include('partials.footer-landing')

    <script>
        // ===== MOBILE MENU =====
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            if (menu) menu.classList.toggle('open');
        }

        // ===== CAROUSEL =====
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');

        function goToSlide(index) {
            if (!slides.length || !dots.length) return;
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            currentSlide = index;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        if (slides.length > 0) {
            setInterval(() => {
                goToSlide((currentSlide + 1) % slides.length);
            }, 5000);
        }

        // ===== SCROLL ANIMATIONS =====
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

        // ===== SMOOTH SCROLL for anchor links =====
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                // kalau href="#" biarkan default (tidak scroll)
                if (this.getAttribute('href') === '#') return;

                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    const menu = document.getElementById('mobile-menu');
                    if (menu) menu.classList.remove('open');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
