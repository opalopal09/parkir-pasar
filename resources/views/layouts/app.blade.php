<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkir Pasar | Smart Parking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --background: #f8fafc;
            --glass: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.3);
            --shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top right, #eef2ff 0%, #f8fafc 100%);
            min-height: 100vh;
            color: #1e293b;
        }

        .navbar {
            background: var(--glass) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
            padding: 0.75rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(45deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card {
            background: var(--glass);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary), var(--primary-dark));
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: var(--shadow);
        }

        .table-custom {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .badge-status {
            padding: 0.5em 1em;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">🚗 ParkirPasar</a>
        
        @auth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <span class="text-muted small">Halo,</span>
                    <span class="fw-bold d-block">{{ auth()->user()->nama_lengkap }}</span>
                </li>
                @if(auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="/user" class="btn btn-sm btn-outline-primary me-2">Kelola User</a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="/logout" class="btn btn-sm btn-danger">Keluar</a>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>

<div class="container pb-5">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
