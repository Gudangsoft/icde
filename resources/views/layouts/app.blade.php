<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', ($settings['site_name'] ?? 'PT ICDE') . ' - ' . ($settings['site_tagline'] ?? 'Konsultan Profesional'))</title>
    <meta name="description" content="@yield('meta_description', $settings['site_description'] ?? 'PT ICDE adalah konsultan profesional di bidang perencanaan, evaluasi pembangunan, penelitian dan kajian berbasis data.')">
    @if(!empty($settings['site_keywords']))
    <meta name="keywords" content="{{ $settings['site_keywords'] }}">
    @endif
    @if(!empty($settings['meta_author']))
    <meta name="author" content="{{ $settings['meta_author'] }}">
    @endif
    @if(!empty($settings['site_favicon']))
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings['site_favicon']) }}">
    @endif

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- AOS Animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Oswald:wght@600;700&display=swap" rel="stylesheet">

    <!-- Google Fonts Premium -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* === ICDE BRAND COLORS (Green & Dark Green Theme) === */
            --icde-navy: #0B4A2F;          /* Hijau Tua Utama (menggantikan navy) */
            --icde-navy-dark: #06311E;      /* Hijau Sangat Tua */
            --icde-navy-mid: #126642;       /* Hijau Tengah */
            --icde-navy-light: #1D915E;     /* Hijau Terang */
            --icde-gold: #84CC16;           /* Hijau Muda/Lime Aksent (menggantikan gold) */
            --icde-gold-light: #A3E635;     /* Lime Terang */
            --icde-gold-dark: #4D7C0F;      /* Lime Gelap */
            --icde-sky: #10B981;            /* Emerald aksen */

            /* === UI COLORS === */
            --icde-dark: #000000;
            --icde-dark-card: #0A291A;
            --icde-gray: #334155;
            --icde-gray-light: #64748b;
            --icde-light-bg: #ECFDF5;
            --icde-white: #FFFFFF;
            --icde-surface: #F0FDF4;

            /* Backwards compat */
            --icde-primary: var(--icde-navy-mid);
            --icde-primary-dark: var(--icde-navy);
            --icde-primary-light: var(--icde-navy-light);
            --icde-secondary: var(--icde-gold);
            --icde-teal: #047857;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            font-size: 1.05rem;
            color: #0f172a;
            font-weight: 500;
            overflow-x: hidden;
            background: #fff;
            line-height: 1.6;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: linear-gradient(90deg, var(--icde-navy-dark) 0%, var(--icde-navy) 60%, var(--icde-navy-mid) 100%);
            color: #fff;
            font-size: 0.78rem;
            padding: 7px 0;
            border-bottom: 2px solid var(--icde-gold);
        }
        .topbar a { color: #b8d4f5; text-decoration: none; transition: color 0.2s; }
        .topbar a:hover { color: var(--icde-gold-light); }

        /* ===== NAVBAR ===== */
        .navbar-main {
            background: #fff;
            box-shadow: 0 2px 24px rgba(11,44,95,0.10);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1050;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }
        .navbar-main.scrolled {
            box-shadow: 0 4px 30px rgba(11,44,95,0.15);
            border-bottom-color: var(--icde-gold);
        }
        .navbar-brand { display:flex; align-items:center; gap:14px; text-decoration:none; padding: 6px 0; }
        .navbar-brand img { height: 60px; object-fit: contain; }
        .navbar-brand-text { display:flex; flex-direction:column; justify-content:center; line-height:1.1; }
        .navbar-brand-name {
            font-family: 'Oswald', 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.75rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            white-space: nowrap;
            background: linear-gradient(135deg, var(--icde-navy) 0%, var(--icde-navy-mid) 60%, var(--icde-sky) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .navbar-brand-tagline {
            font-family: 'Inter', sans-serif;
            font-size: 0.48rem;
            font-weight: 700;
            color: var(--icde-gold-dark);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            white-space: normal;
            line-height: 1.5;
            margin-top: 3px;
            max-width: 220px;
        }
        .navbar-main .nav-link {
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            color: #0f172a !important;
            padding: 24px 14px !important;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            position: relative;
            transition: color 0.3s;
        }
        .navbar-main .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--icde-gold), var(--icde-gold-light));
            border-radius: 3px 3px 0 0;
            transition: width 0.3s ease;
        }
        .navbar-main .nav-link:hover,
        .navbar-main .nav-link.active {
            color: var(--icde-navy) !important;
        }
        .navbar-main .nav-link:hover::after,
        .navbar-main .nav-link.active::after {
            width: 80%;
        }
        .navbar-toggler { border: none; }
        .navbar-toggler:focus { box-shadow: none; }

        /* ===== PAGE HEADER (Hidden globally) ===== */
        .page-header { display: none !important; }

        /* ===== SECTION ===== */
        .section { padding: 90px 0; }
        .section-alt { background: var(--icde-light-bg); }

        /* AOS fallback */
        [data-aos]:not(.aos-animate) {
            opacity: 1 !important;
            transform: none !important;
        }

        /* ===== SECTION TITLE ===== */
        .section-title {
            font-family: 'Poppins', 'Inter', sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--icde-navy-dark);
            position: relative;
            margin-bottom: 20px;
            line-height: 1.25;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 55px;
            height: 4px;
            background: linear-gradient(90deg, var(--icde-gold), var(--icde-gold-light));
            border-radius: 3px;
            margin-top: 14px;
        }
        .section-title.text-center::after { margin: 14px auto 0; }
        .section-subtitle { color: #334155; font-size: 1.15rem; font-weight: 500; max-width: 700px; line-height: 1.8; }

        /* ===== CARDS ===== */
        .card-icde {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(11,44,95,0.08);
            transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.35s ease;
            overflow: hidden;
            background: #fff;
        }
        .card-icde:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(11,44,95,0.15);
        }

        /* ===== BUTTONS ===== */
        .btn-icde-primary {
            background: linear-gradient(135deg, var(--icde-navy-mid), var(--icde-navy));
            color: #fff;
            border: none;
            padding: 13px 30px;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 0.88rem;
            letter-spacing: 0.03em;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-icde-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--icde-sky), var(--icde-navy-mid));
            opacity: 0;
            transition: opacity 0.3s;
        }
        .btn-icde-primary:hover {
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(11,44,95,0.35);
        }
        .btn-icde-primary:hover::before { opacity: 1; }
        .btn-icde-primary span, .btn-icde-primary i { position: relative; z-index: 1; }

        .btn-icde-secondary {
            background: linear-gradient(135deg, var(--icde-gold), var(--icde-gold-dark));
            color: #0B2C5F;
            border: none;
            padding: 13px 30px;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 0.88rem;
            letter-spacing: 0.03em;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .btn-icde-secondary:hover {
            background: linear-gradient(135deg, var(--icde-gold-light), var(--icde-gold));
            color: #0B2C5F;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(232,169,0,0.4);
        }
        .btn-outline-icde {
            border: 2px solid var(--icde-navy-mid);
            color: var(--icde-navy-mid);
            padding: 11px 28px;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
            display: inline-block;
            background: transparent;
            transition: all 0.3s ease;
        }
        .btn-outline-icde:hover {
            background: var(--icde-navy-mid);
            color: #fff;
            transform: translateY(-2px);
        }

        /* ===== FOOTER ===== */
        .footer-main {
            background: linear-gradient(160deg, var(--icde-navy-dark) 0%, var(--icde-navy) 50%, #0F2244 100%);
            color: #c8d8f0;
            padding: 70px 0 0;
            position: relative;
        }
        .footer-main::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--icde-gold-dark), var(--icde-gold), var(--icde-gold-light), var(--icde-gold));
        }
        .footer-main h5 {
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 22px;
            font-size: 0.95rem;
            letter-spacing: 0.03em;
        }
        .footer-main h5::after {
            content: '';
            display: block;
            width: 35px;
            height: 3px;
            background: linear-gradient(90deg, var(--icde-gold), var(--icde-gold-light));
            margin-top: 10px;
            border-radius: 2px;
        }
        .footer-main a {
            color: #97b3d8;
            text-decoration: none;
            font-size: 0.87rem;
            transition: color 0.25s, padding-left 0.25s;
        }
        .footer-main a:hover { color: var(--icde-gold-light); }
        .footer-main ul { list-style: none; padding: 0; }
        .footer-main ul li { margin-bottom: 10px; }
        .footer-bottom {
            background: rgba(0,0,0,0.4);
            padding: 16px 0;
            margin-top: 50px;
            font-size: 0.82rem;
            color: #6b8cba;
            border-top: 1px solid rgba(232,169,0,0.15);
        }
        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 0.875rem;
            color: #a8c2e0;
        }
        .footer-contact-item i {
            color: var(--icde-gold);
            margin-top: 2px;
            flex-shrink: 0;
            font-size: 1rem;
        }
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            color: #a8c2e0;
            margin-right: 8px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        .social-links a:hover {
            background: var(--icde-gold);
            border-color: var(--icde-gold);
            color: var(--icde-navy);
            transform: translateY(-3px);
        }
        .footer-quicklink {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 18px 10px;
            text-decoration: none;
            color: #a8c2e0;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
            text-align: center;
        }
        .footer-quicklink:hover {
            background: linear-gradient(135deg, var(--icde-navy-mid), var(--icde-sky));
            border-color: var(--icde-sky);
            color: #fff;
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(30,144,212,0.3);
        }
        .footer-quicklink i {
            font-size: 1.5rem;
            color: var(--icde-gold);
        }
        .footer-quicklink:hover i { color: var(--icde-gold-light); }
        .footer-map-wrap {
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid rgba(232,169,0,0.2);
            height: 100%;
            min-height: 180px;
        }
        .footer-map-wrap iframe { display: block; }

        /* ===== SCROLL TOP ===== */
        #scrollTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--icde-navy-mid), var(--icde-navy));
            color: #fff;
            border: 2px solid var(--icde-gold);
            border-radius: 12px;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 9999;
            box-shadow: 0 6px 20px rgba(11,44,95,0.35);
            transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
            font-size: 1.1rem;
        }
        #scrollTop:hover {
            background: linear-gradient(135deg, var(--icde-gold), var(--icde-gold-dark));
            color: var(--icde-navy);
            border-color: var(--icde-gold);
            transform: translateY(-4px);
        }
        #scrollTop.show { display: flex; }

        /* ===== BADGE ===== */
        .badge-icde {
            background: linear-gradient(135deg, var(--icde-navy-mid), var(--icde-navy));
            color: #fff;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        /* ===== ICON BOX ===== */
        .icon-box {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .icon-box:hover { transform: scale(1.08) rotate(-3deg); }
        .icon-box-primary {
            background: linear-gradient(135deg, rgba(11,44,95,0.08), rgba(44,95,160,0.12));
            color: var(--icde-navy-mid);
        }
        .icon-box-secondary {
            background: linear-gradient(135deg, rgba(232,169,0,0.1), rgba(245,200,66,0.15));
            color: var(--icde-gold-dark);
        }

        /* ===== SECTION BADGE PILL ===== */
        .section-badge {
            display: inline-block;
            background: linear-gradient(135deg, rgba(11,44,95,0.08), rgba(30,144,212,0.1));
            border: 1px solid rgba(11,44,95,0.15);
            color: var(--icde-navy);
            padding: 6px 20px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        /* ===== GLASSMORPHISM CARD ===== */
        .glass-card {
            background: rgba(255,255,255,0.65);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.4);
            border-radius: 16px;
        }

        /* ===== DIVIDER ===== */
        .ornament-divider {
            text-align: center;
            margin: 8px 0 20px;
        }
        .ornament-divider span {
            display: inline-block;
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--icde-gold);
            margin: 0 4px;
            vertical-align: middle;
        }
        .ornament-divider span:nth-child(2) {
            width: 40px; height: 4px; border-radius: 3px;
        }

        @media (max-width: 991px) {
            .navbar-main .nav-link { padding: 12px 16px !important; }
            .navbar-main .nav-link::after { display: none; }
            .section { padding: 70px 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Topbar -->
    <div class="topbar d-none d-lg-block">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    @php $phone = $settings['site_phone'] ?? '+62-24-6705577'; @endphp
                    <i class="bi bi-telephone-fill me-1"></i>
                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}">{{ $phone }}</a>
                    @if(!empty($settings['site_email']))
                    <span class="mx-2">|</span>
                    <i class="bi bi-envelope-fill me-1"></i>
                    <a href="mailto:{{ $settings['site_email'] }}">{{ $settings['site_email'] }}</a>
                    @endif
                </div>
                <div style="display:flex;align-items:center;gap:12px;">
                    @php
                        $waNumber = preg_replace('/[^+\d]/', '', $settings['site_whatsapp'] ?? $settings['site_phone'] ?? '');
                    @endphp
                    @if($waNumber)
                    <a href="https://wa.me/{{ ltrim($waNumber, '+') }}" target="_blank" rel="noopener"
                       style="color:#fff;text-decoration:none;display:inline-flex;align-items:center;gap:5px;font-size:0.82rem;">
                        <i class="bi bi-whatsapp" style="font-size:1rem;color:#25D366;"></i>WhatsApp
                    </a>
                    @endif
                    @php
                        $topSocials = array_filter([
                            'bi-instagram'  => $settings['social_instagram'] ?? '',
                            'bi-facebook'   => $settings['social_facebook']  ?? '',
                            'bi-linkedin'   => $settings['social_linkedin']  ?? '',
                            'bi-youtube'    => $settings['social_youtube']   ?? '',
                            'bi-twitter-x'  => $settings['social_twitter']   ?? '',
                            'bi-tiktok'     => $settings['social_tiktok']    ?? '',
                        ]);
                    @endphp
                    @foreach($topSocials as $icon => $url)
                    <a href="{{ $url }}" target="_blank" rel="noopener"
                       style="color:rgba(255,255,255,0.8);font-size:1rem;transition:color .2s;"
                       onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">
                        <i class="bi {{ $icon }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('beranda') }}">
                @php $siteName = $settings['site_name'] ?? 'PT ICDE'; @endphp
                @if(!empty($settings['site_logo']))
                <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $siteName }}">
                @else
                <img src="{{ asset('images/logo-icde.png') }}" alt="{{ $siteName }}"
                     onerror="this.onerror=null;this.style.display='none'">
                @endif
                <div class="navbar-brand-text">
                    <div class="navbar-brand-name">{{ $siteName }}</div>
                    <div class="navbar-brand-tagline">Mitra Cerdas untuk Pembangunan<br>Berkualitas &amp; Berkelanjutan</div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <i class="bi bi-list" style="font-size:1.6rem;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tentang-kami') ? 'active' : '' }}" href="{{ route('tentang-kami') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}" href="{{ route('layanan') }}">Lingkup Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('sdm') ? 'active' : '' }}" href="{{ route('sdm') }}">SDM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pengalaman') ? 'active' : '' }}" href="{{ route('pengalaman') }}">Pengalaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('klien') ? 'active' : '' }}" href="{{ route('klien') }}">Klien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('testimoni') ? 'active' : '' }}" href="{{ route('testimoni') }}">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-main">
        <div class="container">
            <div class="row g-4 align-items-stretch">

                {{-- Kolom 1: Identitas + Alamat --}}
                <div class="col-lg-4 col-md-12">
                    @if(!empty($settings['site_logo']))
                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'PT ICDE' }}"
                         style="height:48px;object-fit:contain;margin-bottom:14px;filter:brightness(0) invert(1);">
                    @else
                    <h5 style="font-size:1.05rem;">{{ $settings['site_name'] ?? 'PT ICDE' }}</h5>
                    @endif

                    <p style="font-size:0.83rem;color:#aaa;line-height:1.6;margin-bottom:14px;">
                        {{ $settings['site_tagline'] ?? 'Konsultan Profesional Perencanaan & Evaluasi Pembangunan' }}
                    </p>

                    <div style="font-size:0.83rem;color:#bbb;line-height:1.8;">
                        <p style="color:#ddd;font-weight:600;margin-bottom:6px;">Alamat {{ $settings['site_name'] ?? 'PT ICDE' }}:</p>
                        @if(!empty($settings['site_address']))
                        <div class="footer-contact-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>{{ $settings['site_address'] }}</span>
                        </div>
                        @endif
                        @if(!empty($settings['site_phone']))
                        <div class="footer-contact-item">
                            <i class="bi bi-telephone-fill"></i>
                            <span>
                                Telp : {{ $settings['site_phone'] }}
                                @if(!empty($settings['site_phone2'])) / Fax : {{ $settings['site_phone2'] }} @endif
                            </span>
                        </div>
                        @endif
                        @if(!empty($settings['site_email']))
                        <div class="footer-contact-item">
                            <i class="bi bi-envelope-fill"></i>
                            <a href="mailto:{{ $settings['site_email'] }}" style="color:#bbb;">e-mail : {{ $settings['site_email'] }}</a>
                        </div>
                        @endif
                        @if(!empty($settings['site_working_hours']))
                        <div class="footer-contact-item">
                            <i class="bi bi-clock-fill"></i>
                            <span>{{ $settings['site_working_hours'] }}</span>
                        </div>
                        @endif
                    </div>

                    {{-- Sosial media --}}
                    @php
                        $socials = array_filter([
                            'bi-facebook'   => $settings['social_facebook']  ?? '',
                            'bi-instagram'  => $settings['social_instagram'] ?? '',
                            'bi-linkedin'   => $settings['social_linkedin']  ?? '',
                            'bi-youtube'    => $settings['social_youtube']   ?? '',
                            'bi-twitter-x'  => $settings['social_twitter']   ?? '',
                        ]);
                    @endphp
                    @if(count($socials))
                    <div class="social-links mt-3">
                        @foreach($socials as $icon => $url)
                        <a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ $icon }}"><i class="bi {{ $icon }}"></i></a>
                        @endforeach
                    </div>
                    @endif

                    {{-- Visitor Counter --}}
                    @if(isset($visitor_count))
                    <div class="mt-4">
                        <div style="background: rgba(0,0,0,0.25); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; padding: 12px 18px; display: inline-flex; align-items: center; gap: 14px; box-shadow: inset 0 2px 10px rgba(0,0,0,0.1);">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(132,204,22,0.15); display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-bar-chart-line-fill" style="font-size: 1.25rem; color: var(--icde-gold);"></i>
                            </div>
                            <div style="line-height: 1.3;">
                                <div style="font-size: 0.72rem; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em; color: #97b3d8;">Total Pengunjung</div>
                                <div style="font-weight: 800; color: #fff; font-size: 1.15rem; font-family: 'Oswald', sans-serif; letter-spacing: 0.02em;">{{ number_format($visitor_count, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Kolom 2: Peta (Diperlebar) --}}
                <div class="col-lg-8 col-md-12">
                    <div class="footer-map-wrap" style="height:100%;min-height:200px;">
                        @if(!empty($settings['site_maps_embed']))
                        <iframe src="{{ $settings['site_maps_embed'] }}"
                                width="100%" height="100%" style="min-height:200px;border:0;"
                                allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        @else
                        <div style="background:#1e293b;height:200px;display:flex;align-items:center;justify-content:center;color:#475569;">
                            <div class="text-center"><i class="bi bi-map" style="font-size:2rem;"></i><br>
                            <small>Peta belum dikonfigurasi</small></div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                    <span>{{ $settings['footer_copyright'] ?? ('© ' . date('Y') . ' ' . ($settings['site_name'] ?? 'PT ICDE') . '. All Rights Reserved.') }}</span>
                    <span style="font-size:0.78rem;color:#666;">{{ $settings['site_tagline'] ?? '' }}</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll To Top -->
    <button id="scrollTop" aria-label="Scroll to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        // AOS init — wrapped in guard so content stays visible if CDN fails
        if (typeof AOS !== 'undefined') {
            AOS.init({ duration: 800, once: true, offset: 60, easing: 'ease-out-cubic' });
        } else {
            document.querySelectorAll('[data-aos]').forEach(function(el) {
                el.style.opacity = '1';
                el.style.transform = 'none';
            });
        }

        // Navbar scroll effect
        const navbar = document.querySelector('.navbar-main');
        const scrollBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            const scrolled = window.scrollY > 60;
            navbar && navbar.classList.toggle('scrolled', scrolled);
            scrollBtn && scrollBtn.classList.toggle('show', window.scrollY > 300);
        });
        scrollBtn && scrollBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        // Active nav link highlight based on current page
        document.querySelectorAll('.navbar-main .nav-link').forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });
    </script>

    @stack('scripts')
    @if(!empty($settings['google_analytics']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['google_analytics'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $settings['google_analytics'] }}');
    </script>
    @endif
</body>
</html>
