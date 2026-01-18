<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Campus - Sistem Pengaduan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        .nav-link:hover {
            background: rgba(255,255,255,0.2);
        }

        .nav-link.active {
            background: rgba(255,255,255,0.3);
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 80px auto 30px;
            padding: 30px;
        }

        /* Page Header */
        .page-header {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .page-header h1 {
            color: #1e3a8a;
            font-size: 32px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #64748b;
            font-size: 16px;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-left: 4px solid #3b82f6;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(59,130,246,0.15);
        }

        .stat-card h3 {
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .stat-number {
            color: #1e3a8a;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 13px;
        }

        /* Content Section */
        .content-box {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }

        .content-title {
            color: #1e3a8a;
            font-size: 22px;
            font-weight: 700;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59,130,246,0.3);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #475569;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        /* Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table thead {
            background: #f1f5f9;
        }

        .data-table th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #1e3a8a;
            border-bottom: 2px solid #3b82f6;
            font-size: 14px;
            text-transform: uppercase;
        }

        .data-table td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
        }

        .data-table tbody tr:hover {
            background: #f8fafc;
        }

        /* Status Badges */
        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            text-align: center;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-process {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-resolved {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Priority Badges */
        .priority-high {
            background: #fee2e2;
            color: #dc2626;
        }

        .priority-medium {
            background: #fef3c7;
            color: #d97706;
        }

        .priority-low {
            background: #e0e7ff;
            color: #4f46e5;
        }

        /* Action Buttons */
        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            margin: 0 3px;
            transition: all 0.2s;
        }

        .btn-view {
            background: #dbeafe;
            color: #1e40af;
        }

        .btn-view:hover {
            background: #bfdbfe;
        }

        .btn-edit {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-edit:hover {
            background: #fde68a;
        }

        .btn-delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        /* Search and Filter */
        .filter-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }

        .filter-select {
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            background: white;
            transition: all 0.3s;
        }

        .filter-select:focus {
            outline: none;
            border-color: #3b82f6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
            }

            .container {
                padding: 15px;
                margin-top: 70px;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .content-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .data-table {
                font-size: 12px;
            }

            .data-table th,
            .data-table td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                🎓 Smart Campus
            </div>
            <div class="navbar-menu">
                <a href="#" class="nav-link active">Dashboard</a>
                <a href="#" class="nav-link">Pengaduan</a>
                <a href="#" class="nav-link">Laporan</a>
                <a href="#" class="nav-link">Pengaturan</a>
                <a href="#" class="nav-link">Keluar</a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Dashboard Sistem Pengaduan</h1>
            <p>Kelola dan pantau semua pengaduan kampus secara real-time</p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Pengaduan</h3>
                <div class="stat-number">
                    <?php 
                    // Contoh koneksi ke database
                    // $total = DB::table('complaints')->count();
                    $total = 156; // Dummy data
                    echo $total;
                    ?>
                </div>
                <div class="stat-label">Semua pengaduan yang masuk</div>
            </div>

            <div class="stat-card">
                <h3>Menunggu</h3>
                <div class="stat-number" style="color: #d97706;">
                    <?php 
                    // $pending = DB::table('complaints')->where('status', 'pending')->count();
                    $pending = 32;
                    echo $pending;
                    ?>
                </div>
                <div class="stat-label">Belum ditindaklanjuti</div>
            </div>

            <div class="stat-card">
                <h3>Dalam Proses</h3>
                <div class="stat-number" style="color: #3b82f6;">
                    <?php 
                    // $process = DB::table('complaints')->where('status', 'process')->count();
                    $process = 45;
                    echo $process;
                    ?>
                </div>
                <div class="stat-label">Sedang ditangani</div>
            </div>

            <div class="stat-card">
                <h3>Selesai</h3>
                <div class="stat-number" style="color: #10b981;">
                    <?php 
                    // $resolved = DB::table('complaints')->where('status', 'resolved')->count();
                    $resolved = 79;
                    echo $resolved;
                    ?>
                </div>
                <div class="stat-label">Berhasil diselesaikan</div>
            </div>
        </div>

        <!-- Complaints Table -->
        <div class="content-box">
            <div class="content-header">
                <h2 class="content-title">Daftar Pengaduan</h2>
                <a href="#" class="btn btn-primary">+ Tambah Pengaduan</a>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="search-box">
                    <input type="text" placeholder="🔍 Cari pengaduan...">
                </div>
                <select class="filter-select">
                    <option value="">Semua Status</option>
                    <option value="pending">Menunggu</option>
                    <option value="process">Dalam Proses</option>
                    <option value="resolved">Selesai</option>
                    <option value="rejected">Ditolak</option>
                </select>
                <select class="filter-select">
                    <option value="">Semua Kategori</option>
                    <option value="fasilitas">Fasilitas</option>
                    <option value="akademik">Akademik</option>
                    <option value="it">IT & Jaringan</option>
                    <option value="kebersihan">Kebersihan</option>
                </select>
            </div>

            <!-- Data Table -->
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Judul Pengaduan</th>
                        <th>Kategori</th>
                        <th>Pelapor</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Contoh data dari database
                    // $complaints = DB::table('complaints')->orderBy('created_at', 'desc')->get();
                    
                    // Dummy data untuk contoh
                    $complaints = [
                        [
                            'id' => 1,
                            'date' => '2026-01-18',
                            'title' => 'AC Rusak di Ruang Kuliah A301',
                            'category' => 'Fasilitas',
                            'reporter' => 'Budi Santoso',
                            'priority' => 'high',
                            'status' => 'process'
                        ],
                        [
                            'id' => 2,
                            'date' => '2026-01-17',
                            'title' => 'WiFi Tidak Stabil di Perpustakaan',
                            'category' => 'IT & Jaringan',
                            'reporter' => 'Siti Aminah',
                            'priority' => 'medium',
                            'status' => 'pending'
                        ],
                        [
                            'id' => 3,
                            'date' => '2026-01-16',
                            'title' => 'Lampu Mati di Koridor Lantai 2',
                            'category' => 'Fasilitas',
                            'reporter' => 'Ahmad Hidayat',
                            'priority' => 'low',
                            'status' => 'resolved'
                        ],
                        [
                            'id' => 4,
                            'date' => '2026-01-15',
                            'title' => 'Kebersihan Toilet Perlu Ditingkatkan',
                            'category' => 'Kebersihan',
                            'reporter' => 'Rina Wati',
                            'priority' => 'medium',
                            'status' => 'process'
                        ],
                        [
                            'id' => 5,
                            'date' => '2026-01-15',
                            'title' => 'Proyektor Tidak Berfungsi di Lab Komputer',
                            'category' => 'Fasilitas',
                            'reporter' => 'Dedi Prasetyo',
                            'priority' => 'high',
                            'status' => 'pending'
                        ],
                        [
                            'id' => 6,
                            'date' => '2026-01-14',
                            'title' => 'Pintu Rusak di Gedung B Lantai 3',
                            'category' => 'Fasilitas',
                            'reporter' => 'Lisa Anggraini',
                            'priority' => 'medium',
                            'status' => 'resolved'
                        ],
                    ];

                    // Loop data pengaduan
                    foreach($complaints as $complaint):
                        // Tentukan class badge berdasarkan status
                        $statusClass = 'badge-' . $complaint['status'];
                        $statusText = [
                            'pending' => 'Menunggu',
                            'process' => 'Proses',
                            'resolved' => 'Selesai',
                            'rejected' => 'Ditolak'
                        ];

                        // Tentukan class priority
                        $priorityClass = 'priority-' . $complaint['priority'];
                        $priorityText = [
                            'high' => 'Tinggi',
                            'medium' => 'Sedang',
                            'low' => 'Rendah'
                        ];
                    ?>
                    <tr>
                        <td><strong>#<?php echo str_pad($complaint['id'], 3, '0', STR_PAD_LEFT); ?></strong></td>
                        <td><?php echo date('d M Y', strtotime($complaint['date'])); ?></td>
                        <td><strong><?php echo $complaint['title']; ?></strong></td>
                        <td><?php echo $complaint['category']; ?></td>
                        <td><?php echo $complaint['reporter']; ?></td>
                        <td>
                            <span class="badge <?php echo $priorityClass; ?>">
                                <?php echo $priorityText[$complaint['priority']]; ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge <?php echo $statusClass; ?>">
                                <?php echo $statusText[$complaint['status']]; ?>
                            </span>
                        </td>
                        <td>
                            <button class="action-btn btn-view">👁️ Lihat</button>
                            <button class="action-btn btn-edit">✏️ Edit</button>
                            <button class="action-btn btn-delete">🗑️ Hapus</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Search functionality
        document.querySelector('.search-box input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.data-table tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Filter functionality
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', function() {
                // Implement filter logic here
                console.log('Filter changed:', this.value);
            });
        });
    </script>
</body>
</html>