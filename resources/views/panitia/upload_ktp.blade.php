<!-- resources/views/panitia/upload_ktp.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Upload KTP Panitia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Verifikasi Identitas Panitia</h4>
        </div>
        <div class="card-body">
            <p class="text-muted">Silakan unggah foto KTP Anda agar Admin (Tora) dapat memverifikasi akun Anda.</p>
            
            <form action="/panitia/upload-ktp" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pilih Foto KTP (JPG/PNG, Max 2MB)</label>
                    <input type="file" name="ktp_image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Unggah Sekarang</button>
            </form>
        </div>
    </div>
</body>
</html>