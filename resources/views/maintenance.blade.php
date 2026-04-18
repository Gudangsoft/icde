<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $maintenanceTitle ?? 'Website Sedang Maintenance' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --icde-primary: #1B6CA8;
            --icde-secondary: #F5A623;
            --icde-dark: #0f172a;
        }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: radial-gradient(circle at 20% 10%, #e0f2fe 0%, #f8fafc 45%, #e2e8f0 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--icde-dark);
        }
        .card-maintenance {
            width: min(720px, 92vw);
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.12);
            padding: 40px 34px;
            text-align: center;
        }
        .icon-wrap {
            width: 78px;
            height: 78px;
            border-radius: 50%;
            margin: 0 auto 18px;
            background: linear-gradient(135deg, var(--icde-primary), #0ea5e9);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 10px 24px rgba(27, 108, 168, 0.35);
        }
        .title {
            font-weight: 800;
            font-size: clamp(1.45rem, 2.7vw, 2rem);
            margin-bottom: 12px;
        }
        .message {
            color: #475569;
            font-size: 1rem;
            line-height: 1.75;
            margin-bottom: 24px;
            white-space: pre-line;
        }
        .admin-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--icde-primary);
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 600;
        }
        .admin-link:hover {
            background: #15598a;
            color: #fff;
        }
        .status-note {
            margin-top: 16px;
            font-size: 0.82rem;
            color: #64748b;
        }
        .status-note i {
            color: var(--icde-secondary);
        }
    </style>
</head>
<body>
<div class="card-maintenance">
    <div class="icon-wrap"><i class="bi bi-tools"></i></div>
    <div class="title">{{ $maintenanceTitle ?? 'Website Sedang Maintenance' }}</div>
    <div class="message">{{ $maintenanceMessage ?? 'Mohon maaf, website sedang dalam proses pemeliharaan. Silakan coba kembali beberapa saat lagi.' }}</div>
    <a href="{{ route('admin.login') }}" class="admin-link">
        <i class="bi bi-shield-lock"></i> Masuk Admin
    </a>
    <div class="status-note">
        <i class="bi bi-clock-history"></i> Status HTTP 503 - Service Unavailable
    </div>
</div>
</body>
</html>
