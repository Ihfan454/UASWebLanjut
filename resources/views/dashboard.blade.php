<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Smart Campus Complaint System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 20px 0;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 30px;
        }

        .sidebar-header h2 {
            font-size: 22px;
            font-weight: 600;
        }

        .sidebar-header p {
            font-size: 12px;
            opacity: 0.8;
            margin-top: 5px;
        }

        .menu-item {
            padding: 12px 15px;
            margin: 8px 0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.15);
            transform: translateX(5px);
        }

        .menu-item.active {
            background: rgba(255,255,255,0.25);
        }

        .menu-icon {
            font-size: 18px;
        }

        .main-content {
            margin-left: 260px;
            padding: 30px;
        }

        .header {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 28px;
            color: #2d3748;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.blue { background: #e6f2ff; color: #3b82f6; }
        .stat-icon.green { background: #e6ffe6; color: #10b981; }
        .stat-icon.yellow { background: #fff9e6; color: #f59e0b; }
        .stat-icon.red { background: #ffe6e6; color: #ef4444; }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
        }

        .stat-label {
            color: #718096;
            font-size: 14px;
            margin-top: 5px;
        }

        .content-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }

        .complaint-table {
            width: 100%;
            border-collapse: collapse;
        }

        .complaint-table th {
            background: #f7fafc;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #4a5568;
            border-bottom: 2px solid #e2e8f0;
        }

        .complaint-table td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .complaint-table tr:hover {
            background: #f7fafc;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-progress { background: #dbeafe; color: #1e40af; }
        .status-resolved { background: #d1fae5; color: #065f46; }
        .status-rejected { background: #fee2e2; color: #991b1b; }

        .priority-badge {
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
        }

        .priority-high { background: #fee; color: #c00; }
        .priority-medium { background: #ffeaa7; color: #d63031; }
        .priority-low { background: #dfe6e9; color: #636e72; }

        .chart-container {
            margin-top: 20px;
            height: 300px;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            padding: 20px;
            background: #f7fafc;
            border-radius: 8px;
        }

        .chart-bar {
            width: 60px;
            background: linear-gradient(to top, #667eea, #764ba2);
            border-radius: 8px 8px 0 0;
            position: relative;
            transition: all 0.3s;
        }

        .chart-bar:hover {
            opacity: 0.8;
        }

        .chart-label {
            text-align: center;
            margin-top: 10px;
            font-size: 12px;
            color: #4a5568;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 15px 10px;
            }

            .sidebar-header h2,
            .sidebar-header p,
            .menu-item span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
                padding: 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>🎓 Smart Campus</h2>
            <p>Sistem Pengaduan</p>
        </div>
        
        <div class="menu">
    <a href="{{ route('dashboard') }}"
       class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
       style="text-decoration:none; color:white;">
        <span class="menu-icon">📊</span>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('complaints.create') }}"
       class="menu-item {{ request()->routeIs('complaints.create') ? 'active' : '' }}"
       style="text-decoration:none; color:white;">
        <span class="menu-icon">📝</span>
        <span>Pengaduan Baru</span>
    </a>

    <a href="{{ route('complaints.index') }}"
       class="menu-item {{ request()->routeIs('complaints.*') ? 'active' : '' }}"
       style="text-decoration:none; color:white;">
        <span class="menu-icon">📋</span>
        <span>Daftar Pengaduan</span>
    </a>

    {{-- LOGOUT (Laravel Breeze) --}}
    <form method="POST" action="{{ route('logout') }}" style="margin-top:10px;">
        @csrf
        <button type="submit" class="menu-item"
                style="width:100%; border:none; background:transparent; color:white; text-align:left;">
            <span class="menu-icon">🚪</span>
            <span>Keluar</span>
        </button>
    </form>
</div>


    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div>
                <h1>Dashboard</h1>
                <p style="color: #718096; margin-top: 5px;">Selamat datang kembali! 👋</p>
            </div>
            <div class="user-info">
                <div>
                    <div style="font-weight: 600;">Admin User</div>
                    <div style="font-size: 12px; color: #718096;">Administrator</div>
                </div>
                <div class="user-avatar">AU</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon blue">📊</div>
                </div>
                <div class="stat-value">{{ $total }}</div>
                <div class="stat-label">Total Pengaduan</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon yellow">⏳</div>
                </div>
                <div class="stat-value">{{ $baru }}</div>
                <div class="stat-label">Menunggu</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon blue">🔄</div>
                </div>
                <div class="stat-value">{{ $proses }}</div>
                <div class="stat-label">Dalam Proses</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon green">✅</div>
                </div>
                <div class="stat-value">{{ $selesai }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>

        <!-- Recent Complaints -->
        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">Pengaduan Terbaru</h2>
                <button class="btn btn-primary">+ Buat Pengaduan</button>
            </div>

            <table class="complaint-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Pelapor</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
@forelse($recentComplaints as $c)
    <tr>
        <td>#{{ $c->id }}</td>
        <td>{{ \Illuminate\Support\Str::limit($c->description, 35) }}</td>
        <td>{{ $c->category }}</td>
        <td>{{ $c->name }}</td>

        <td>
            @if($c->priority == 'tinggi')
                <span class="priority-badge priority-high">Tinggi</span>
            @elseif($c->priority == 'sedang')
                <span class="priority-badge priority-medium">Sedang</span>
            @else
                <span class="priority-badge priority-low">Rendah</span>
            @endif
        </td>

        <td>
            @if($c->status == 'baru')
                <span class="status-badge status-pending">Baru</span>
            @elseif($c->status == 'proses')
                <span class="status-badge status-progress">Proses</span>
            @else
                <span class="status-badge status-resolved">Selesai</span>
            @endif
        </td>

        <td>{{ $c->created_at->format('d M Y') }}</td>
    </tr>
@empty
    <tr>
        <td colspan="7" style="text-align:center; color:#777;">
            Belum ada pengaduan.
        </td>
    </tr>
@endforelse
</tbody>

            </table>
        </div>


    <script>
        // Menu click handler
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Chart animation on load
        window.addEventListener('load', function() {
            const bars = document.querySelectorAll('.chart-bar');
            bars.forEach((bar, index) => {
                bar.style.height = '0';
                setTimeout(() => {
                    bar.style.transition = 'height 0.8s ease';
                    bar.style.height = bar.getAttribute('style').split('height: ')[1];
                }, index * 100);
            });
        });
    </script>
</body>
</html>