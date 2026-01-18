<!doctype html>
<html>
<head>
    <title>Update Status Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-3">Update Status Laporan</h2>

    <div class="card mb-3">
        <div class="card-body">
            <p class="mb-1"><b>Pelapor:</b> {{ $complaint->name }} ({{ $complaint->nim }})</p>
            <p class="mb-1"><b>Email / HP:</b> {{ $complaint->email }} / {{ $complaint->phone }}</p>
            <p class="mb-1"><b>Kategori:</b> {{ $complaint->category }}</p>
            <p class="mb-1"><b>Lokasi:</b> {{ $complaint->location }}</p>
            <p class="mb-1"><b>Prioritas:</b> {{ $complaint->priority }}</p>
            <p class="mb-1"><b>Deskripsi:</b><br>{{ $complaint->description }}</p>

            @if($complaint->photo)
                <p class="mt-2">
                    <a href="{{ asset('storage/'.$complaint->photo) }}" target="_blank"
                       class="btn btn-sm btn-outline-dark">
                        Lihat Foto
                    </a>
                </p>
            @endif
        </div>
    </div>

    <form action="{{ route('complaints.update', $complaint->id) }}" method="POST" class="card p-3">
        @csrf
        @method('PUT')

        <label class="form-label"><b>Status</b></label>
        <select name="status" class="form-select" required>
            <option value="baru" {{ $complaint->status == 'baru' ? 'selected' : '' }}>baru</option>
            <option value="proses" {{ $complaint->status == 'proses' ? 'selected' : '' }}>proses</option>
            <option value="selesai" {{ $complaint->status == 'selesai' ? 'selected' : '' }}>selesai</option>
        </select>

        <div class="mt-3">
            <button class="btn btn-primary" type="submit">Update</button>
            <a href="{{ route('complaints.index') }}" class="btn btn-secondary ms-2">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>
