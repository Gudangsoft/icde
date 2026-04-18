<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - {{ $settings['site_name'] ?? 'PT ICDE' }}</title>
    @if(!empty($settings['site_favicon'] ?? ''))
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings['site_favicon']) }}">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --topbar-height: 60px;
            --icde-primary: #126642;       /* Hijau Tengah */
            --icde-primary-dark: #0B4A2F;  /* Hijau Tua Utama */
            --icde-secondary: #84CC16;     /* Lime / Hijau Muda */
            --sidebar-bg: #06311E;         /* Hijau Sangat Tua untuk sidebar */
            --sidebar-hover: rgba(255,255,255,0.07);
        }
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; display: flex; min-height: 100vh; overflow-x: hidden; }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        .sidebar-brand {
            padding: 20px 20px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .sidebar-brand .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-icon {
            width: 40px; height: 40px;
            background: var(--icde-primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 1.3rem; flex-shrink: 0;
        }
        .brand-text { color: #fff; font-weight: 800; font-size: 0.95rem; line-height: 1.2; }
        .brand-sub { color: rgba(255,255,255,0.4); font-size: 0.7rem; font-weight: 400; }

        .sidebar-nav { padding: 15px 12px; flex: 1; min-height: 0; overflow-y: auto; scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.15) transparent; }
        .nav-section-label {
            color: rgba(255,255,255,0.3);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 10px 8px 5px;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 2px;
            transition: all 0.2s;
            position: relative;
        }
        .sidebar-link i { font-size: 1.05rem; width: 20px; text-align: center; flex-shrink: 0; }
        .sidebar-link:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }
        .sidebar-link.active {
            background: var(--icde-primary);
            color: #fff;
        }
        .sidebar-link .badge-notif {
            margin-left: auto;
            background: var(--icde-secondary);
            color: #fff;
            font-size: 0.7rem;
            padding: 2px 7px;
            border-radius: 10px;
            font-weight: 700;
        }

        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
        }
        .user-avatar {
            width: 36px; height: 36px;
            background: var(--icde-primary);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 0.9rem; flex-shrink: 0;
        }
        .user-name { color: #fff; font-size: 0.82rem; font-weight: 600; }
        .user-role { color: rgba(255,255,255,0.4); font-size: 0.7rem; }

        /* MAIN CONTENT */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            height: var(--topbar-height);
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            padding: 0 24px;
            position: sticky;
            top: 0; z-index: 900;
            gap: 15px;
        }
        .topbar-title { font-weight: 700; font-size: 1rem; color: #1e293b; flex: 1; }
        .btn-menu-toggle { display: none; background: none; border: none; font-size: 1.3rem; color: #64748b; }

        .page-content { padding: 28px 28px; flex: 1; }

        /* CARDS */
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            transition: all 0.3s;
            border: 1px solid #f1f5f9;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }
        .stat-num { font-size: 1.8rem; font-weight: 800; color: #1e293b; }
        .stat-label { font-size: 0.82rem; color: #64748b; font-weight: 500; }

        /* TABLES */
        .admin-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            border: 1px solid #f1f5f9;
            overflow: hidden;
        }
        .admin-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .admin-card-header h5 { font-weight: 700; margin: 0; font-size: 0.95rem; color: #1e293b; }
        .admin-card-body { padding: 0; }

        .table-admin { margin: 0; }
        .table-admin th {
            background: #f8fafc;
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 16px;
        }
        .table-admin td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.87rem;
            vertical-align: middle;
            color: #374151;
        }
        .table-admin tr:last-child td { border-bottom: none; }
        .table-admin tr:hover td { background: #f8fafc; }

        /* FORMS - extended */
        .form-group-admin { margin-bottom: 0; }
        .form-group-admin label {
            display: block;
            font-weight: 600;
            font-size: 0.83rem;
            color: #374151;
            margin-bottom: 6px;
        }
        .form-control-admin {
            display: block;
            width: 100%;
            padding: 10px 14px;
            font-size: 0.88rem;
            color: #374151;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: 'Inter', sans-serif;
        }
        .form-control-admin:focus {
            outline: none;
            border-color: var(--icde-primary);
            box-shadow: 0 0 0 3px rgba(27,108,168,0.12);
        }
        .form-control-admin.is-invalid { border-color: #ef4444; }
        .invalid-feedback { color: #ef4444; font-size: 0.78rem; margin-top: 4px; }
        textarea.form-control-admin { resize: vertical; }
        select.form-control-admin {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 38px;
            cursor: pointer;
        }
        input[type=file].form-control-admin {
            padding: 8px 12px;
            background: #f8fafc;
            cursor: pointer;
        }
        input[type=file].form-control-admin::file-selector-button {
            padding: 5px 14px;
            border: none;
            border-right: 1.5px solid #e2e8f0;
            background: #e2e8f0;
            color: #374151;
            font-size: 0.80rem;
            font-weight: 600;
            cursor: pointer;
            margin-right: 12px;
            font-family: 'Inter', sans-serif;
            transition: background 0.15s;
        }
        input[type=file].form-control-admin:hover::file-selector-button { background: #cbd5e1; }
        .img-preview-admin {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-top: 10px;
            padding: 10px 14px;
            background: #f8fafc;
            border: 1.5px dashed #cbd5e1;
            border-radius: 8px;
            font-size: 0.78rem;
            color: #64748b;
        }
        .form-actions-admin {
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1.5px solid #f1f5f9;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .field-hint { font-size: 0.76rem; color: #94a3b8; margin-top: 4px; }

        /* BUTTONS - extended */
        .btn-admin {
            display: inline-flex;
            align-items: center;
            padding: 9px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
        }
        .btn-light-admin {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }
        .btn-light-admin:hover { background: #e2e8f0; color: #1e293b; }
        .btn-primary-admin {
            background: var(--icde-primary);
            color: #fff;
        }
        .btn-primary-admin:hover { background: var(--icde-primary-dark); color: #fff; }
        .btn-sm-admin {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .btn-edit { background: rgba(27,108,168,0.1); color: var(--icde-primary); }
        .btn-edit:hover { background: var(--icde-primary); color: #fff; }
        .btn-delete { background: rgba(239,68,68,0.1); color: #ef4444; }
        .btn-delete:hover { background: #ef4444; color: #fff; }
        .btn-view { background: rgba(16,185,129,0.1); color: #10b981; }
        .btn-view:hover { background: #10b981; color: #fff; }

        /* ALERT */
        .alert-success-admin {
            background: rgba(16,185,129,0.1);
            border: 1px solid rgba(16,185,129,0.25);
            border-radius: 10px;
            color: #065f46;
            padding: 14px 18px;
            font-size: 0.88rem;
        }
        .alert-danger-admin {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 10px;
            color: #991b1b;
            padding: 14px 18px;
            font-size: 0.88rem;
        }

        /* STATUS BADGE */
        .badge-aktif { background: rgba(16,185,129,0.12); color: #10b981; padding: 3px 10px; border-radius: 12px; font-size: 0.72rem; font-weight: 700; }
        .badge-nonaktif { background: rgba(156,163,175,0.2); color: #9ca3af; padding: 3px 10px; border-radius: 12px; font-size: 0.72rem; font-weight: 700; }

        /* IMAGE PREVIEW */
        .img-preview { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0; }

        /* PAGINATION */
        .pagination .page-link { font-size: 0.82rem; border-radius: 6px; margin: 0 2px; border-color: #e2e8f0; color: var(--icde-primary); }
        .pagination .page-item.active .page-link { background: var(--icde-primary); border-color: var(--icde-primary); }

        /* OVERLAY for mobile */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; }

        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }
            .main-wrapper { margin-left: 0; }
            .btn-menu-toggle { display: flex; align-items: center; justify-content: center; }
            .page-content { padding: 20px 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            @if(!empty($settings['site_logo'] ?? ''))
            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'PT ICDE' }}" style="height:38px;max-width:140px;object-fit:contain;filter:brightness(0) invert(1);">
            @else
            <div class="brand-icon"><i class="bi bi-building"></i></div>
            @endif
            <div>
                <div class="brand-text">{{ $settings['site_name'] ?? 'PT ICDE' }}</div>
                <div class="brand-sub">Admin Panel</div>
            </div>
        </a>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section-label mt-2">Konten Website</div>
        <a href="{{ route('admin.beranda.index') }}" class="sidebar-link {{ request()->routeIs('admin.beranda*') ? 'active' : '' }}">
            <i class="bi bi-house-fill"></i> Beranda
        </a>
        <a href="{{ route('admin.seksi.index') }}" class="sidebar-link {{ request()->routeIs('admin.seksi*') ? 'active' : '' }}">
            <i class="bi bi-layout-text-window-reverse"></i> Judul Seksi
        </a>
        <a href="{{ route('admin.slider.index') }}" class="sidebar-link {{ request()->routeIs('admin.slider*') ? 'active' : '' }}">
            <i class="bi bi-collection-play-fill"></i> Slider / Banner
        </a>
        <a href="{{ route('admin.tentang.edit') }}" class="sidebar-link {{ request()->routeIs('admin.tentang*') ? 'active' : '' }}">
            <i class="bi bi-info-circle-fill"></i> Tentang Kami
        </a>
        <a href="{{ route('admin.struktur.index') }}" class="sidebar-link {{ request()->routeIs('admin.struktur*') ? 'active' : '' }}">
            <i class="bi bi-diagram-3-fill"></i> Struktur Organisasi
        </a>
        <a href="{{ route('admin.layanan.index') }}" class="sidebar-link {{ request()->routeIs('admin.layanan*') ? 'active' : '' }}">
            <i class="bi bi-briefcase-fill"></i> Lingkup Layanan
        </a>
        <a href="{{ route('admin.sdm.index') }}" class="sidebar-link {{ request()->routeIs('admin.sdm*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> SDM
        </a>
        <a href="{{ route('admin.pengalaman.index') }}" class="sidebar-link {{ request()->routeIs('admin.pengalaman*') ? 'active' : '' }}">
            <i class="bi bi-folder-fill"></i> Pengalaman
        </a>
        <a href="{{ route('admin.klien.index') }}" class="sidebar-link {{ request()->routeIs('admin.klien*') ? 'active' : '' }}">
            <i class="bi bi-building-fill"></i> Klien
        </a>
        <a href="{{ route('admin.galeri.index') }}" class="sidebar-link {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Galeri
        </a>
        <a href="{{ route('admin.testimoni.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimoni*') ? 'active' : '' }}">
            <i class="bi bi-chat-quote-fill"></i> Testimoni
        </a>
        <a href="{{ route('admin.berita.index') }}" class="sidebar-link {{ request()->routeIs('admin.berita*') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i> Berita / News
        </a>

        <div class="nav-section-label mt-2">Pesan Masuk</div>
        <a href="{{ route('admin.kontak.index') }}" class="sidebar-link {{ request()->routeIs('admin.kontak*') ? 'active' : '' }}">
            <i class="bi bi-envelope-fill"></i> Kontak Pesan
            @php $pesanBaru = \App\Models\KontakPesan::where('sudah_dibaca', false)->count(); @endphp
            @if($pesanBaru > 0)
            <span class="badge-notif">{{ $pesanBaru }}</span>
            @endif
        </a>

        <div class="nav-section-label mt-2">Lainnya</div>
        <a href="{{ route('admin.setting.index') }}#maintenance" class="sidebar-link {{ request()->routeIs('admin.setting*') ? 'active' : '' }}">
            <i class="bi bi-tools"></i> Mode Maintenance
        </a>
        <a href="{{ route('admin.setting.index') }}" class="sidebar-link {{ request()->routeIs('admin.setting*') ? 'active' : '' }}">
            <i class="bi bi-gear-fill"></i> Setting Web
        </a>
        <a href="{{ route('beranda') }}" target="_blank" class="sidebar-link">
            <i class="bi bi-box-arrow-up-right"></i> Lihat Website
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="user-avatar"><i class="bi bi-person-fill"></i></div>
            <div class="flex-grow-1 overflow-hidden">
                <div class="user-name text-truncate">{{ Auth::user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}" class="mb-0">
                @csrf
                <button type="submit" title="Logout" style="background:none;border:none;color:rgba(255,255,255,0.4);font-size:1rem;cursor:pointer;padding:4px;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
<div class="sidebar-overlay d-none" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Topbar -->
    <div class="topbar">
        <button class="btn-menu-toggle" id="menuToggle" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        <div class="topbar-title">@yield('page_title', 'Dashboard')</div>
        <div class="d-flex align-items-center gap-3">
            <span style="font-size:0.8rem;color:#94a3b8;">{{ date('d M Y') }}</span>
            @php $pb = \App\Models\KontakPesan::where('sudah_dibaca', false)->count(); @endphp
            @if($pb > 0)
            <a href="{{ route('admin.kontak.index') }}" class="position-relative" style="color:#64748b;font-size:1.2rem;">
                <i class="bi bi-bell-fill"></i>
                <span style="position:absolute;top:-4px;right:-6px;background:var(--icde-secondary);color:#fff;font-size:0.6rem;width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;">{{ $pb }}</span>
            </a>
            @endif
        </div>
    </div>

    <!-- Page Content -->
    <main class="page-content">
        @if(session('sukses') || session('success'))
        <div class="alert-success-admin mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill"></i> {{ session('sukses') ?? session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert-danger-admin mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        height: 400,
        promotion: false,
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media table emoticons',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        menubar: false,
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('d-none');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.add('d-none');
    }

    // Delete confirmation
    document.querySelectorAll('.btn-delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Yakin ingin menghapus data ini?')) e.preventDefault();
        });
    });
</script>
@stack('scripts')
</body>
</html>
