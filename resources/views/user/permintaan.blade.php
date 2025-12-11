<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Kegiatan User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* =============== CARD & BUTTON STYLE =============== */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        }

        .card-custom .card-header {
            background: #2f5b44;
            color: white;
            border-radius: 12px 12px 0 0;
            font-weight: 600;
        }

        .btn-green {
            background: #2f5b44;
            color: white;
        }

        .btn-green:hover {
            background: #1E7F53;
            color: white;
        }

        table th {
            background: #2f5b44;
            color: white;
        }
    </style>
</head>

<body>

{{-- ============ NAVBAR ============ --}}
@include('user.layout.navbar')


<div class="container mt-4">

    <div class="card card-custom mb-4">
        <div class="card-header">
            Ajukan Permintaan Kegiatan
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('user.permintaan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <select name="judul" class="form-control" required>
                        <option value="">-- Pilih Judul Kegiatan --</option>
                        <option value="Rapat">Rapat</option>
                        <option value="Kerja Bakti">Kerja Bakti</option>
                        <option value="Arisan">Arisan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jam</label>
                        <input type="time" name="jam" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>

                <button class="btn btn-green px-4">Kirim Permintaan</button>
            </form>

        </div>
    </div>


    <!-- ================= STATUS PERMINTAAN ================= -->
    <h4 class="mb-3">Status Permintaan Anda</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($permintaan as $p)
                <tr>
                    <td>{{ $p->judul }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>
                        @if($p->status == 'pending')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif($p->status == 'diterima')
                            <span class="badge bg-success">Diterima</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</body>
</html>
