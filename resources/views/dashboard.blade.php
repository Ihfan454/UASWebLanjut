@extends('layouts.app')

@section('content')

<style>
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

    .page-header p { color: #64748b; font-size: 16px; }

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

    .stat-label { color: #94a3b8; font-size: 13px; }

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

    .btn-primary { background: #3b82f6; color: white; }
    .btn-primary:hover {
        background: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59,130,246,0.3);
    }

    /* Table */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .data-table thead { background: #f1f5f9; }

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

    .data-table tbody tr:hover { background: #f8fafc; }

    /* Status Badges */
    .badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        text-align: center;
    }

    .badge-pending { background: #fef3c7; color: #92400e; }
    .badge-process { background: #dbeafe; color: #1e40af; }
    .badge-resolved { background: #d1fae5; color: #065f46; }

    /* Priority Badges */
    .priority-high { background: #fee2e2; color: #dc2626; }
    .priority-medium { background: #fef3c7; color: #d97706; }
    .priority-low { background: #e0e7ff; color: #4f46e5; }

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
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit { background: #fef3c7; color: #92400e; }
    .btn-edit:hover { background: #fde68a; }

    .btn-delete { background: #fee2e2; color: #991b1b; }
    .btn-delete:hover { background: #fecaca; }

    /* Search */
    .filter-bar {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .search-box { flex: 1; min-width: 250px; }
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

    @media (max-width: 768px) {
        .stats-container { grid-template-columns: 1fr; }
        .content-header { flex-direction: column; gap: 15px; align-items: flex-start; }
        .data-table { font-size: 12px; }
        .data-table th, .data-table td { padding: 10px; }
    }
</style>


<!-- Page Header -->
<div class="page-header">
    <h1>Dashboard Sistem Pengaduan</h1>
    <p>Kelola dan pantau semua pengaduan kampus secara real-time</p>
</div>

<!-- Statistics Cards -->
<div class="stats-container">
    <div class="stat-card">
        <h3>Total Pengaduan</h3>
        <div class="stat-number">{{ $total }}</div>
        <div class="stat-label">Semua pengaduan yang masuk</div>
    </div>

    <div class="stat-card">
        <h3>Menunggu</h3>
        <div class="stat-number" style="color: #d97706;">{{ $pending }}</div>
        <div class="stat-label">Belum ditindaklanjuti</div>
    </div>

    <div class="stat-card">
        <h3>Dalam Proses</h3>
        <div class="stat-number" style="color: #3b82f6;">{{ $process }}</div>
        <div class="stat-label">Sedang ditangani</div>
    </div>

    <div class="stat-card">
        <h3>Selesai</h3>
        <div class="stat-number" style="color: #10b981;">{{ $resolved }}</div>
        <div class="stat-label">Berhasil diselesaikan</div>
    </div>
</div>

<!-- Complaints Table -->
<div class="content-box">
    <div class="content-header">
        <h2 class="content-title">Daftar Pengaduan</h2>
        <a href="{{ route('complaints.create') }}" class="btn btn-primary">+ Tambah Pengaduan</a>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="search-box">
            <input id="searchInput" type="text" placeholder="🔍 Cari pengaduan...">
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Pelapor</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody id="complaintTable">
            @forelse($complaints as $c)
                <tr>
                    <td><strong>#{{ str_pad($c->id, 3, '0', STR_PAD_LEFT) }}</strong></td>
                    <td>{{ $c->created_at->format('d M Y') }}</td>
                    <td><strong>{{ \Illuminate\Support\Str::limit($c->description, 40) }}</strong></td>
                    <td>{{ $c->category }}</td>
                    <td>{{ $c->name }}</td>

                    <td>
                        @if($c->priority == 'tinggi')
                            <span class="badge priority-high">Tinggi</span>
                        @elseif($c->priority == 'sedang')
                            <span class="badge priority-medium">Sedang</span>
                        @else
                            <span class="badge priority-low">Rendah</span>
                        @endif
                    </td>

                    <td>
                        @if($c->status == 'baru')
                            <span class="badge badge-pending">Menunggu</span>
                        @elseif($c->status == 'proses')
                            <span class="badge badge-process">Proses</span>
                        @else
                            <span class="badge badge-resolved">Selesai</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('complaints.edit', $c->id) }}" class="action-btn btn-edit">✏️ Edit</a>

                        <form action="{{ route('complaints.destroy', $c->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete"
                                onclick="return confirm('Hapus laporan ini? (hanya boleh jika status selesai)')">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; color:#64748b;">
                        Belum ada pengaduan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#complaintTable tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>

@endsection
