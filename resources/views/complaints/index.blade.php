<!doctype html>
<html>
<head>
    <title>Daftar Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Daftar Laporan</h2>
        <a href="{{ route('complaints.create') }}" class="btn btn-primary">+ Buat Laporan</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Pelapor</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th style="width:170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $c)
                            <tr>
                                <td>{{ $c->id }}</td>

                                <td>
                                    <div><b>{{ $c->name }}</b></div>
                                    <small class="text-muted">
                                        NIM: {{ $c->nim }} <br>
                                        {{ $c->email }} | {{ $c->phone }}
                                    </small>
                                </td>

                                <td>{{ $c->category }}</td>
                                <td>{{ $c->location }}</td>

                                <td>
                                    @if($c->priority == 'tinggi')
                                        <span class="badge bg-danger">tinggi</span>
                                    @elseif($c->priority == 'sedang')
                                        <span class="badge bg-warning text-dark">sedang</span>
                                    @else
                                        <span class="badge bg-secondary">rendah</span>
                                    @endif
                                </td>

                                <td>
                                    @if($c->status == 'baru')
                                        <span class="badge bg-info text-dark">baru</span>
                                    @elseif($c->status == 'proses')
                                        <span class="badge bg-primary">proses</span>
                                    @else
                                        <span class="badge bg-success">selesai</span>
                                    @endif
                                </td>

                                <td>
                                    @if($c->photo)
                                        <a class="btn btn-sm btn-outline-dark"
                                           href="{{ asset('storage/'.$c->photo) }}" target="_blank">
                                            Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('complaints.edit', $c->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Update Status
                                    </a>

                                    <form action="{{ route('complaints.destroy', $c->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin hapus laporan ini? (hanya bisa jika status selesai)')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Belum ada laporan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>
