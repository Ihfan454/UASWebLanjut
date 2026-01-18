@extends('layouts.app')

@section('content')

<style>
    .page-header {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .page-header h2 {
        color: #1e3a8a;
        font-size: 30px;
        font-weight: 800;
        margin: 0;
    }

    .btn {
        padding: 12px 22px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }
    .btn-primary:hover {
        background: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(59,130,246,0.35);
    }

    .alert {
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 18px;
        font-weight: 600;
    }
    .alert-success { background: #d1fae5; color: #065f46; }
    .alert-danger  { background: #fee2e2; color: #991b1b; }

    .content-box {
        background: white;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        border-radius: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 950px;
    }

    thead {
        background: #0f172a;
        color: white;
    }

    th, td {
        padding: 14px 14px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
        font-size: 14px;
    }

    tbody tr:hover {
        background: #f8fafc;
    }

    .muted {
        color: #64748b;
        font-size: 12px;
        margin-top: 4px;
        line-height: 1.4;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        display: inline-block;
        text-transform: lowercase;
    }

    .bg-danger { background: #fee2e2; color: #dc2626; }
    .bg-warning { background: #fef3c7; color: #92400e; }
    .bg-secondary { background: #e2e8f0; color: #475569; }

    .bg-info { background: #cffafe; color: #0e7490; }
    .bg-primary { background: #dbeafe; color: #1d4ed8; }
    .bg-success { background: #d1fae5; color: #065f46; }

    .btn-sm {
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
    }

    .btn-outline {
        background: transparent;
        border: 2px solid #0f172a;
        color: #0f172a;
    }
    .btn-outline:hover {
        background: #0f172a;
        color: white;
    }

    .btn-warning {
        background: #fbbf24;
        color: #1f2937;
        border: none;
    }
    .btn-warning:hover { filter: brightness(0.96); }

    .btn-danger {
        background: #ef4444;
        color: white;
        border: none;
    }
    .btn-danger:hover { filter: brightness(0.95); }

    .aksi {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
</style>


{{-- Header --}}
<div class="page-header">
    <h2>Daftar Laporan</h2>
    <a href="{{ route('complaints.create') }}" class="btn btn-primary">+ Buat Laporan</a>
</div>

{{-- Alerts --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

{{-- Table --}}
<div class="content-box">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th style="width:70px;">ID</th>
                    <th>Pelapor</th>
                    <th style="width:120px;">Kategori</th>
                    <th style="width:160px;">Lokasi</th>
                    <th style="width:110px;">Prioritas</th>
                    <th style="width:110px;">Status</th>
                    <th style="width:100px;">Foto</th>
                    <th style="width:210px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($complaints as $c)
                    <tr>
                        <td>{{ $c->id }}</td>

                        <td>
                            <div style="font-weight:800; font-size:15px;">{{ $c->name }}</div>
                            <div class="muted">
                                NIM: {{ $c->nim }} <br>
                                {{ $c->email }} | {{ $c->phone }}
                            </div>
                        </td>

                        <td>{{ $c->category }}</td>
                        <td>{{ $c->location }}</td>

                        <td>
                            @if($c->priority == 'tinggi')
                                <span class="badge bg-danger">tinggi</span>
                            @elseif($c->priority == 'sedang')
                                <span class="badge bg-warning">sedang</span>
                            @else
                                <span class="badge bg-secondary">rendah</span>
                            @endif
                        </td>

                        <td>
                            @if($c->status == 'baru')
                                <span class="badge bg-info">baru</span>
                            @elseif($c->status == 'proses')
                                <span class="badge bg-primary">proses</span>
                            @else
                                <span class="badge bg-success">selesai</span>
                            @endif
                        </td>

                        <td>
                            @if($c->photo)
                                <a class="btn-sm btn-outline"
                                   href="{{ asset('storage/'.$c->photo) }}" target="_blank">
                                    Lihat
                                </a>
                            @else
                                <span class="muted">-</span>
                            @endif
                        </td>

                        <td>
                            <div class="aksi">
                                <a href="{{ route('complaints.edit', $c->id) }}"
                                   class="btn-sm btn-warning">
                                    Update Status
                                </a>

                                <form action="{{ route('complaints.destroy', $c->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-sm btn-danger"
                                            onclick="return confirm('Yakin hapus laporan ini? (hanya bisa jika status selesai)')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center; color:#64748b; padding:20px;">
                            Belum ada laporan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
