<!-- resources/views/panitia/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Panitia - EventCity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Smart City: EventCity</span>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h3>Halo, Panitia!</h3>
                <p class="text-muted">Pantau status pengajuan acara kamu di sini.</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="/event/baru" class="btn btn-success">+ Ajukan Acara Baru</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Acara</th>
                            <th>Lokasi</th>
                            <th>Kuota</th>
                            <th>Status Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myEvents as $event)
                        <tr>
                            <td><strong>{{ $event->title }}</strong></td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->quota }} Orang</td>
                            <td>
                                @if($event->status == 1)
                                    <span class="badge bg-success">Disetujui Tora</span>
                                @else
                                    <span class="badge bg-warning text-dark">Menunggu (Pending)</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada acara yang diajukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>