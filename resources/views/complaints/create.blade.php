@extends('layouts.app')

@section('content')

<style>
    .page-header {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }

    .page-header h2 {
        color: #1e3a8a;
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .page-header p {
        color: #64748b;
        margin: 0;
        font-weight: 500;
    }

    .content-box {
        background: white;
        border-radius: 12px;
        padding: 26px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .form-group label {
        display: block;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .input, .select, .textarea {
        width: 100%;
        padding: 12px 14px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        transition: 0.25s;
        background: white;
    }

    .input:focus, .select:focus, .textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
    }

    .textarea { min-height: 120px; resize: vertical; }

    .alert {
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 18px;
        font-weight: 600;
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-row {
        display: flex;
        gap: 12px;
        margin-top: 18px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 22px;
        border: none;
        border-radius: 10px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.25s;
        text-decoration: none;
        font-size: 14px;
        display: inline-block;
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

    .btn-secondary {
        background: #e2e8f0;
        color: #334155;
    }
    .btn-secondary:hover {
        background: #cbd5e1;
    }

    @media (max-width: 900px) {
        .form-grid { grid-template-columns: 1fr; }
    }
</style>

{{-- Header --}}
<div class="page-header">
    <h2>Buat Laporan</h2>
    <p>Silakan isi form pengaduan fasilitas kampus.</p>
</div>

{{-- Error --}}
@if ($errors->any())
    <div class="alert">
        <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Form --}}
<div class="content-box">
    <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="input" required value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" class="input" required value="{{ old('nim') }}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="input" required value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="phone" class="input" required value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="category" class="select" required>
                    <option value="">-- pilih kategori --</option>
                    <option value="wifi" {{ old('category')=='wifi' ? 'selected' : '' }}>WiFi</option>
                    <option value="ac" {{ old('category')=='ac' ? 'selected' : '' }}>AC</option>
                    <option value="kebersihan" {{ old('category')=='kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                    <option value="listrik" {{ old('category')=='listrik' ? 'selected' : '' }}>Listrik</option>
                    <option value="lainnya" {{ old('category')=='lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="location" class="input" required
                       value="{{ old('location') }}" placeholder="Gedung / Ruangan">
            </div>

            <div class="form-group">
                <label>Prioritas</label>
                <select name="priority" class="select" required>
                    <option value="rendah" {{ old('priority')=='rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="sedang" {{ old('priority','sedang')=='sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="tinggi" {{ old('priority')=='tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            <div class="form-group">
                <label>Foto (opsional)</label>
                <input type="file" name="photo" class="input" accept="image/*">
            </div>
        </div>

        <div class="form-group" style="margin-top:18px;">
            <label>Deskripsi</label>
            <textarea name="description" class="textarea" required>{{ old('description') }}</textarea>
        </div>

        <div class="btn-row">
            <button type="submit" class="btn btn-primary">Kirim Laporan</button>
            <a href="{{ route('complaints.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection
