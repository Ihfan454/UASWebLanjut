<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Smart Campus - Sistem Pengaduan' }}</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            color: #2c3e50;
        }

        /* Top Navigation Bar */
        .navbar {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .navbar-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .nav-link:hover { background: rgba(255,255,255,0.2); }
        .nav-link.active { background: rgba(255,255,255,0.3); }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 80px auto 30px;
            padding: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-menu { display: none; }
            .container { padding: 15px; margin-top: 70px; }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('dashboard') }}" class="navbar-brand">🎓 Smart Campus</a>

            <div class="navbar-menu">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('complaints.index') }}"
                   class="nav-link {{ request()->routeIs('complaints.index') ? 'active' : '' }}">
                    Pengaduan
                </a>

                <a href="{{ route('complaints.create') }}"
                   class="nav-link {{ request()->routeIs('complaints.create') ? 'active' : '' }}">
                    Buat Pengaduan
                </a>

                <a href="#" class="nav-link">Keluar</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
