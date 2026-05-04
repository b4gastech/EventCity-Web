<!-- resources/views/panitia/create.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Acara Baru - EventCity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Form Pengajuan Acara - Modul Panitia</h2>
            </div>
            <div class="card-body">
                <p class="text-muted small">Lengkapi data di bawah untuk mengajukan acara ke sistem Smart City. Data akan diverifikasi oleh Admin (Tora).</p>
                <hr>

                <!-- Menampilkan Error Validasi jika ada yang terlewat -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- PENTING: Harus pakai enctype="multipart/form-data" agar bisa upload POSTER -->
                <form action="/event/store" method="POST" enctype="multipart/form-data">
                    @csrf 

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Judul Acara</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Festival UMKM Cerdas" value="{{ old('title') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori Acara</label>
                            <select name="category" class="form-control" required>
                                <option value="Edukasi" {{ old('category') == 'Edukasi' ? 'selected' : '' }}>Edukasi</option>
                                <option value="Kesehatan" {{ old('category') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="Hiburan" {{ old('category') == 'Hiburan' ? 'selected' : '' }}>Hiburan</option>
                                <option value="Olahraga" {{ old('category') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pelaksanaan</label>
                            <input type="date" name="event_date" class="form-control" value="{{ old('event_date') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi (Alamat Lengkap)</label>
                        <input type="text" name="location" class="form-control" placeholder="Nama Jalan atau Gedung" value="{{ old('location') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kuota Peserta</label>
                            <input type="number" name="quota" class="form-control" placeholder="0" value="{{ old('quota') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Poster Acara (Gambar)</label>
                            <input type="file" name="poster" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Acara</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Jelaskan detail acaramu...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Fitur Geo-Location untuk Smart City -->
                    <div class="row border rounded p-3 bg-white mx-0 mb-4 shadow-sm">
                        <p class="mb-2"><strong><i class="bi bi-geo-alt"></i> Koordinat Lokasi (Untuk Peta Mobile)</strong></p>
                        <div class="col-md-6">
                            <label class="small text-muted">Latitude</label>
                            <input type="text" name="latitude" class="form-control form-control-sm" placeholder="-6.123456" value="{{ old('latitude') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted">Longitude</label>
                            <input type="text" name="longitude" class="form-control form-control-sm" placeholder="106.123456" value="{{ old('longitude') }}">
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Ajukan Acara Sekarang</button>
                        <a href="/panitia/dashboard" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>