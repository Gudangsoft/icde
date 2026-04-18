<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - {{ $settings['site_name'] ?? 'PT ICDE' }}</title>
    @if(!empty($settings['site_favicon'] ?? ''))
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings['site_favicon']) }}">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            background: #f1f5f9;
        }

        /* ── LEFT PANEL ─────────────────────────────── */
        .left-panel {
            flex: 1 1 55%;
            background: linear-gradient(145deg, #0a1628 0%, #0f2744 40%, #1B6CA8 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 60px 64px;
            position: relative;
            overflow: hidden;
        }
        /* decorative circles */
        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            border: 1.5px solid rgba(255,255,255,0.06);
            top: -180px; right: -160px;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            width: 320px; height: 320px;
            border-radius: 50%;
            border: 1.5px solid rgba(255,255,255,0.06);
            bottom: -80px; left: -60px;
        }
        .brand-logo-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 60px;
            position: relative;
            z-index: 1;
        }
        .brand-logo-wrap img { height: 46px; filter: brightness(0) invert(1); }
        .brand-logo-icon {
            width: 46px; height: 46px;
            background: rgba(255,255,255,0.15);
            border: 1.5px solid rgba(255,255,255,0.25);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 1.4rem;
        }
        .brand-logo-text {
            color: rgba(255,255,255,0.9);
            font-weight: 700;
            font-size: 0.95rem;
            line-height: 1;
        }
        .brand-logo-sub {
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
            margin-top: 3px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.75);
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
        }
        .hero-name {
            font-family: 'Syne', 'Inter', sans-serif;
            font-weight: 800;
            font-size: clamp(2rem, 4vw, 3.2rem);
            color: #fff;
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        .hero-name span {
            background: linear-gradient(90deg, #F5A623, #ffd27a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-tagline {
            color: rgba(255,255,255,0.6);
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.7;
            max-width: 380px;
            margin-bottom: 48px;
            position: relative;
            z-index: 1;
        }
        .hero-stats {
            display: flex;
            gap: 36px;
            position: relative;
            z-index: 1;
        }
        .hero-stat-val {
            font-family: 'Syne', 'Inter', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }
        .hero-stat-label {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.45);
            font-weight: 500;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        /* ── RIGHT PANEL ────────────────────────────── */
        .right-panel {
            flex: 0 0 420px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            background: #fff;
        }
        .login-box { width: 100%; max-width: 340px; }
        .login-title {
            font-weight: 800;
            font-size: 1.55rem;
            color: #1e293b;
            margin-bottom: 4px;
        }
        .login-sub { color: #64748b; font-size: 0.85rem; margin-bottom: 32px; }
        .form-label { font-weight: 600; font-size: 0.83rem; color: #374151; margin-bottom: 6px; }
        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 11px 14px 11px 40px;
            font-size: 0.88rem;
            color: #1e293b;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
        }
        .form-control:focus {
            border-color: #1B6CA8;
            box-shadow: 0 0 0 3px rgba(27,108,168,0.12);
            outline: none;
        }
        .input-wrap { position: relative; }
        .input-wrap i {
            position: absolute; left: 13px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8; font-size: 0.95rem;
            pointer-events: none;
        }
        .btn-login {
            background: #1B6CA8;
            color: #fff;
            border: none;
            padding: 13px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.92rem;
            width: 100%;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            margin-top: 8px;
        }
        .btn-login:hover { background: #144F7F; transform: translateY(-1px); }
        .back-link { color: #94a3b8; font-size: 0.78rem; text-decoration: none; }
        .back-link:hover { color: #1B6CA8; }
        .divider { border: none; border-top: 1px solid #f1f5f9; margin: 28px 0; }

        /* Responsive */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel { flex: none; padding: 36px 28px 40px; min-height: 220px; }
            .hero-name { font-size: 1.6rem; }
            .hero-stats { gap: 24px; }
            .hero-tagline { display: none; }
            .brand-logo-wrap { margin-bottom: 20px; }
            .right-panel { flex: 1; padding: 32px 24px; }
        }
    </style>
</head>
<body>

    {{-- LEFT: Branding --}}
    <div class="left-panel">
        <div class="brand-logo-wrap">
            @if(!empty($settings['site_logo'] ?? ''))
            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'PT ICDE' }}">
            @else
            <div class="brand-logo-icon"><i class="bi bi-building"></i></div>
            @endif
            <div>
                <div class="brand-logo-text">{{ $settings['site_name'] ?? 'PT ICDE' }}</div>
                <div class="brand-logo-sub">Admin Panel</div>
            </div>
        </div>

        <div class="hero-badge">
            <i class="bi bi-award-fill" style="color:#F5A623;"></i>
            Konsultan Terpercaya
        </div>

        <div class="hero-name">
            Integrated Civil &<br><span>Development</span><br>Engineering
        </div>

        <p class="hero-tagline">
            Solusi konsultansi profesional di bidang perencanaan pembangunan, evaluasi, dan penelitian berbasis data untuk kebijakan yang tepat sasaran.
        </p>

        <div class="hero-stats">
            <div>
                <div class="hero-stat-val">500+</div>
                <div class="hero-stat-label">Proyek Selesai</div>
            </div>
            <div>
                <div class="hero-stat-val">200+</div>
                <div class="hero-stat-label">Klien Puas</div>
            </div>
            <div>
                <div class="hero-stat-val">15+</div>
                <div class="hero-stat-label">Tahun Berdiri</div>
            </div>
        </div>
    </div>

    {{-- RIGHT: Login Form --}}
    <div class="right-panel">
        <div class="login-box">
            <div class="login-title">Selamat Datang</div>
            <p class="login-sub">Masukkan email dan password untuk mengakses panel admin.</p>

            @if($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:20px;color:#991b1b;font-size:0.83rem;">
                <i class="bi bi-exclamation-circle-fill me-1"></i>{{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Alamat Email</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="admin@icde.id" required autofocus>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember" style="font-size:0.82rem;color:#64748b;">Ingat saya</label>
                    </div>
                </div>
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Admin
                </button>
            </form>

            <hr class="divider">
            <div class="text-center">
                <a href="{{ route('beranda') }}" class="back-link">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Website
                </a>
            </div>
        </div>
    </div>

</body>
</html>
