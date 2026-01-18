<!doctype html>
<html>
<head>
    <title>Buat Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-3">Buat Laporan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="card p-3">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" required value="{{ old('nim') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category" class="form-select" required>
                <option value="">-- pilih kategori --</option>
                <option value="wifi">WiFi</option>
                <option value="ac">AC</option>
                <option value="kebersihan">Kebersihan</option>
                <option value="listrik">Listrik</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control" required value="{{ old('location') }}" placeholder="Gedung / Ruangan">
        </div>

        <div class="mb-3">
            <label class="form-label">Prioritas</label>
            <select name="priority" class="form-select" required>
                <option value="rendah">Rendah</option>
                <option value="sedang" selected>Sedang</option>
                <option value="tinggi">Tinggi</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto (opsional)</label>
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
        <a href="{{ route('complaints.index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>

</body>
</html>
