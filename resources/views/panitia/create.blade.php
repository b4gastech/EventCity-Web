<!-- resources/views/panitia/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Acara Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Form Pengajuan Acara - Modul Panitia</h2>
    <hr>

    <form action="/event/store" method="POST">
        @csrf <!-- Wajib ada di Laravel untuk keamanan -->
        
        <div class="mb-3">
            <label class="form-label">Judul Acara</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi (Alamat Lengkap)</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kuota Peserta</label>
            <input type="number" name="quota" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Acara</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan Acara</button>
    </form>
</body>
</html>